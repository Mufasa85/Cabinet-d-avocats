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
}
