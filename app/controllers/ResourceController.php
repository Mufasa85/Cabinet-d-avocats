<?php

namespace App\controllers;

use Service\FileStorage;
use Helper\Log\Logger;

class ResourceController
{
    /**
     * Serves files from the /resources directory
     * Route: GET /resources/<filename>
     * 
     * Examples:
     * - /resources/avatars/avatar_3_xxx.png -> images/avatars/avatar_3_xxx.png
     * - /resources/images/avatars/avatar_3_xxx.png -> images/avatars/avatar_3_xxx.png
     */
    public function serve($params)
    {
        // Parse the URI directly to get the file path
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        Logger::debug('ResourceController: URI', ['uri' => $uri]);

        // Remove the base path (/resources/)
        $file = preg_replace('#^/resources/?#', '', $uri);
        Logger::debug('ResourceController: file extracted', ['file' => $file]);

        // Security: prevent directory traversal
        $file = str_replace(['..', '\\', '%00', "\0"], '', $file);

        // Remove leading/ending slashes
        $file = trim($file, '/');

        // Check if this is a directory listing request
        if (empty($file) || $file === 'images' || $file === 'documents') {
            return $this->browse($file);
        }

        // Determine the correct relative path inside resources
        // If file already starts with "images/" or "documents/", use it directly
        // Otherwise, assume it's under images/ (for avatars, article covers, etc.)
        if (str_starts_with($file, 'images/') || str_starts_with($file, 'documents/')) {
            $relativePath = $file;
        } else {
            // Assume it's an avatar or other image stored directly
            // e.g., "avatars/avatar_3_xxx.png" -> "images/avatars/avatar_3_xxx.png"
            $relativePath = 'images/' . ltrim($file, '/');
        }

        Logger::debug('ResourceController: relativePath', ['relativePath' => $relativePath]);

        $absolutePath = FileStorage::absolutePath($relativePath);
        Logger::debug('ResourceController: absolutePath', ['absolutePath' => $absolutePath]);

        // Check if file exists - if not, try alternatives
        if (!is_file($absolutePath)) {
            Logger::debug('ResourceController: file not found at primary path, trying alternatives', ['absolutePath' => $absolutePath]);

            // If the file path already contains "images/", try the direct path without "images/"
            if (str_starts_with($relativePath, 'images/')) {
                $altPath = substr($relativePath, 7); // Remove "images/"
                $altAbsolutePath = FileStorage::absolutePath($altPath);
                Logger::debug('ResourceController: trying without images/', ['altPath' => $altPath, 'altAbsolutePath' => $altAbsolutePath]);

                if (is_file($altAbsolutePath)) {
                    $absolutePath = $altAbsolutePath;
                    Logger::info('ResourceController: found file at alt path', ['path' => $altAbsolutePath]);
                }
            }

            // If still not found, try images/avatars/ prefix with the original file
            if (!is_file($absolutePath)) {
                $altPath = 'images/avatars/' . ltrim($file, '/');
                $altAbsolutePath = FileStorage::absolutePath($altPath);
                Logger::debug('ResourceController: trying images/avatars/', ['altPath' => $altPath, 'altAbsolutePath' => $altAbsolutePath]);

                if (is_file($altAbsolutePath)) {
                    $absolutePath = $altAbsolutePath;
                    Logger::info('ResourceController: found file at avatars path', ['path' => $altAbsolutePath]);
                }
            }

            // If still not found, try avatars/ prefix directly
            if (!is_file($absolutePath)) {
                $altPath = 'avatars/' . ltrim($file, '/');
                $altAbsolutePath = FileStorage::absolutePath($altPath);
                Logger::debug('ResourceController: trying avatars/', ['altPath' => $altPath, 'altAbsolutePath' => $altAbsolutePath]);

                if (is_file($altAbsolutePath)) {
                    $absolutePath = $altAbsolutePath;
                    Logger::info('ResourceController: found file at root avatars path', ['path' => $altAbsolutePath]);
                }
            }

            // Final check
            if (!is_file($absolutePath)) {
                Logger::warning('ResourceController: file not found', [
                    'file' => $file,
                    'relativePath' => $relativePath,
                    'checked_paths' => [
                        FileStorage::absolutePath($relativePath),
                        FileStorage::absolutePath(substr($relativePath, 7)),
                        FileStorage::absolutePath('images/avatars/' . $file),
                        FileStorage::absolutePath('avatars/' . $file)
                    ]
                ]);
                http_response_code(404);
                echo 'File not found: ' . htmlspecialchars($relativePath);
                return;
            }
        }

        // Get MIME type
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($absolutePath);
        Logger::info('ResourceController: serving file', ['path' => $absolutePath, 'mime' => $mime]);

        // Set headers
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($absolutePath));
        header('Cache-Control: max-age=86400'); // Cache for 1 day

        // Output file
        readfile($absolutePath);
        exit;
    }

    /**
     * Browse files in the resources directory
     * Route: GET /resources or GET /resources/images or GET /resources/documents
     */
    public function browse(?string $path = null)
    {
        $baseDir = FileStorage::root();
        $targetDir = $baseDir;

        if ($path === 'images') {
            $targetDir = $baseDir . '/images';
        } elseif ($path === 'documents') {
            $targetDir = $baseDir . '/documents';
        }

        // Security: ensure we're within the resources directory
        $realPath = realpath($targetDir);
        $realBase = realpath($baseDir);

        if ($realPath === false || strpos($realPath, $realBase) !== 0) {
            http_response_code(403);
            echo 'Access denied';
            return;
        }

        $items = [];

        if (is_dir($targetDir)) {
            $files = scandir($targetDir);
            foreach ($files as $file) {
                if ($file === '.' || $file === '..') continue;

                $filePath = $targetDir . '/' . $file;
                $relativePath = str_replace($baseDir . '/', '', $filePath);
                $isDir = is_dir($filePath);

                $items[] = [
                    'name' => $file,
                    'path' => $relativePath,
                    'url' => '/resources/' . $relativePath,
                    'is_dir' => $isDir,
                    'size' => $isDir ? null : filesize($filePath),
                    'modified' => date('Y-m-d H:i:s', filemtime($filePath)),
                    'type' => $isDir ? 'folder' : $this->getFileType($file)
                ];
            }
        }

        // Determine current section
        $section = match ($path) {
            'images' => 'Images',
            'documents' => 'Documents',
            default => 'Resources'
        };

        // Output as JSON if requested
        if (isset($_GET['format']) && $_GET['format'] === 'json') {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'path' => $path ?? '/',
                'section' => $section,
                'items' => $items
            ]);
            return;
        }

        // Output HTML page
        $this->renderBrowsePage($section, $path ?? '', $items);
    }

    /**
     * Render the browse page HTML
     */
    private function renderBrowsePage(string $section, string $currentPath, array $items): void
    {
        header('Content-Type: text/html; charset=utf-8');

        // Calculate breadcrumbs
        $breadcrumbs = [];
        $breadcrumbs[] = ['name' => 'Resources', 'path' => ''];

        if ($currentPath === 'images') {
            $breadcrumbs[] = ['name' => 'Images', 'path' => 'images'];
        } elseif ($currentPath === 'documents') {
            $breadcrumbs[] = ['name' => 'Documents', 'path' => 'documents'];
        }

        // Group items by type
        $folders = array_filter($items, fn($item) => $item['is_dir']);
        $files = array_filter($items, fn($item) => !$item['is_dir']);

        // Sort
        usort($folders, fn($a, $b) => strcmp($a['name'], $b['name']));
        usort($files, fn($a, $b) => strcmp($a['name'], $b['name']));

        $allItems = array_merge($folders, $files);

        // Build breadcrumbs HTML
        $breadcrumbsHtml = '';
        foreach ($breadcrumbs as $i => $crumb) {
            if ($i > 0) {
                $breadcrumbsHtml .= '<span class="breadcrumb-sep">/</span>';
            }
            if ($crumb['path'] === $currentPath) {
                $breadcrumbsHtml .= '<span class="breadcrumb">' . htmlspecialchars($crumb['name']) . '</span>';
            } else {
                $breadcrumbsHtml .= '<span class="breadcrumb"><a href="/resources/' . htmlspecialchars($crumb['path']) . '">' . htmlspecialchars($crumb['name']) . '</a></span>';
            }
        }

        // Build items grid
        $itemsHtml = '';
        if (empty($allItems)) {
            $itemsHtml = '<div class="empty">
                <div class="empty-icon">📭</div>
                <p>Aucun fichier trouvé dans ce répertoire</p>
            </div>';
        } else {
            $gridItems = [];
            foreach ($allItems as $item) {
                $icon = $this->getItemIcon($item['type'], $item['is_dir']);
                $size = $item['size'] ? $this->formatFileSize($item['size']) : '';
                $gridItems[] = '<div class="item" onclick="location.href=\'' . $item['url'] . '\'">
                    <span class="item-icon">' . $icon . '</span>
                    <div class="item-name">' . htmlspecialchars($item['name']) . '</div>
                    <div class="item-info">
                        <span>' . $item['type'] . '</span>
                        ' . ($size ? '<span>' . $size . '</span>' : '') . '
                        <span>' . $item['modified'] . '</span>
                    </div>
                </div>';
            }
            $itemsHtml = '<div class="grid">' . implode('', $gridItems) . '</div>';
        }

        // Output complete HTML page
        echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Resources - ' . htmlspecialchars($section) . '</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); min-height: 100vh; color: #e0e0e0; }
        .container { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
        header { margin-bottom: 30px; }
        h1 { font-size: 2.5rem; color: #e94560; margin-bottom: 10px; }
        .subtitle { color: #888; font-size: 1.1rem; }
        .breadcrumbs { display: flex; gap: 10px; margin-bottom: 20px; font-size: 0.9rem; }
        .breadcrumb { color: #888; }
        .breadcrumb a { color: #e94560; text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb-sep { color: #555; }
        .stats { display: flex; gap: 20px; margin-bottom: 20px; font-size: 0.9rem; color: #888; }
        .stat { background: rgba(255,255,255,0.05); padding: 10px 15px; border-radius: 8px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; }
        .item { background: rgba(255,255,255,0.05); border-radius: 12px; padding: 20px; transition: all 0.3s ease; cursor: pointer; border: 1px solid transparent; }
        .item:hover { background: rgba(255,255,255,0.1); border-color: #e94560; transform: translateY(-5px); }
        .item-icon { font-size: 3rem; margin-bottom: 15px; display: block; text-align: center; }
        .item-name { font-size: 1rem; word-break: break-all; margin-bottom: 10px; text-align: center; }
        .item-info { font-size: 0.8rem; color: #888; text-align: center; }
        .item-info span { display: block; margin: 5px 0; }
        .empty { text-align: center; padding: 60px 20px; color: #888; }
        .empty-icon { font-size: 4rem; margin-bottom: 20px; }
        .api-info { margin-top: 40px; background: rgba(255,255,255,0.05); border-radius: 12px; padding: 25px; }
        .api-info h3 { color: #e94560; margin-bottom: 15px; }
        .api-info p { margin-bottom: 10px; color: #aaa; }
        .api-info code { background: rgba(0,0,0,0.3); padding: 3px 8px; border-radius: 4px; font-size: 0.9rem; }
        .nav-links { display: flex; gap: 15px; margin-bottom: 20px; }
        .nav-link { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: rgba(255,255,255,0.05); border-radius: 8px; color: #e0e0e0; text-decoration: none; transition: all 0.3s ease; }
        .nav-link:hover { background: rgba(233,69,96,0.2); color: #e94560; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📁 Resources Browser</h1>
            <p class="subtitle">Accédez aux fichiers du cabinet d\'avocats</p>
        </header>
        
        <nav class="nav-links">
            <a href="/resources" class="nav-link">🏠 Accueil</a>
            <a href="/resources/images" class="nav-link">🖼️ Images</a>
            <a href="/resources/documents" class="nav-link">📄 Documents</a>
        </nav>
        
        <div class="breadcrumbs">
            ' . $breadcrumbsHtml . '
        </div>
        
        <div class="stats">
            <div class="stat">📂 ' . htmlspecialchars($section) . '</div>
            <div class="stat">Dossiers: ' . count($folders) . '</div>
            <div class="stat">Fichiers: ' . count($files) . '</div>
        </div>
        
        ' . $itemsHtml . '
        
        <div class="api-info">
            <h3>🔌 API Endpoints</h3>
            <p><code>GET /resources</code> - Liste tous les fichiers (HTML)</p>
            <p><code>GET /resources?format=json</code> - Liste tous les fichiers (JSON)</p>
            <p><code>GET /resources/{path}</code> - Accède à un fichier spécifique</p>
            <p><code>GET /resources/images</code> - Browse le dossier images</p>
            <p><code>GET /resources/documents</code> - Browse le dossier documents</p>
        </div>
    </div>
</body>
</html>';
    }

    /**
     * Get file type from extension
     */
    private function getFileType(string $filename): string
    {
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        return match ($ext) {
            'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp', 'ico' => 'image',
            'pdf' => 'pdf',
            'doc', 'docx', 'odt' => 'word',
            'xls', 'xlsx', 'csv' => 'excel',
            'txt', 'md' => 'text',
            'zip', 'rar', '7z', 'tar', 'gz' => 'archive',
            'mp3', 'wav', 'ogg' => 'audio',
            'mp4', 'avi', 'mov', 'webm' => 'video',
            default => 'file'
        };
    }

    /**
     * Get icon for item type
     */
    private function getItemIcon(string $type, bool $isDir): string
    {
        if ($isDir) return '📁';

        return match ($type) {
            'image' => '🖼️',
            'pdf' => '📄',
            'word' => '📝',
            'excel' => '📊',
            'text' => '📃',
            'archive' => '📦',
            'audio' => '🎵',
            'video' => '🎬',
            default => '📎'
        };
    }

    /**
     * Format file size
     */
    private function formatFileSize(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;

        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
