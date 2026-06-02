<?php

/**
 * Router PHP pour le serveur PHP intégré
 * Usage: php -S 0.0.0.0:8000 -t public router.php
 */

// Log que le router est exécuté
file_put_contents('php://stderr', "ROUTER.PHP EXECUTED!\n");
file_put_contents('php://stderr', "Request URI: " . ($_SERVER['REQUEST_URI'] ?? 'N/A') . "\n");

// Handle resources directory - serve files via PHP
if (preg_match('#^/resources/(.*)$#', $_SERVER['REQUEST_URI'], $matches)) {
    file_put_contents('php://stderr', "MATCHED /resources/ pattern!\n");
    $file = trim($matches[1], '/');

    // Security: prevent directory traversal
    $file = str_replace(['..', '\\', '%00', "\0"], '', $file);

    // Get the resources directory path (one level up from public)
    $resourcesRoot = dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'resources';

    // Build absolute path - the file path from URL is relative to resources/
    // e.g., /resources/images/avatars/xxx.png -> resources/images/avatars/xxx.png
    $relativePath = str_replace('/', DIRECTORY_SEPARATOR, $file);
    $absolutePath = $resourcesRoot . DIRECTORY_SEPARATOR . $relativePath;

    // Normalize path separators for Windows
    $absolutePath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $absolutePath);

    // Debug: uncomment to see what's being checked
    // file_put_contents('php://stderr', "Checking: $absolutePath\n");

    // Try the direct path first
    $foundPath = null;
    if (is_file($absolutePath)) {
        $foundPath = $absolutePath;
    }

    // If not found and path starts with images/, try without images/
    if (!$foundPath && str_starts_with($relativePath, 'images' . DIRECTORY_SEPARATOR)) {
        $altPath = $resourcesRoot . DIRECTORY_SEPARATOR . substr($relativePath, 7);
        $altPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $altPath);
        if (is_file($altPath)) {
            $foundPath = $altPath;
        }
    }

    // If not found and it's an avatar-style filename, try images/avatars/
    if (!$foundPath) {
        $filename = basename($file);
        $avatarPath = $resourcesRoot . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'avatars' . DIRECTORY_SEPARATOR . $filename;
        $avatarPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $avatarPath);
        if (is_file($avatarPath)) {
            $foundPath = $avatarPath;
        }
    }

    // If not found, try avatars/ directly (without images/)
    if (!$foundPath) {
        $filename = basename($file);
        $directAvatarPath = $resourcesRoot . DIRECTORY_SEPARATOR . 'avatars' . DIRECTORY_SEPARATOR . $filename;
        $directAvatarPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $directAvatarPath);
        if (is_file($directAvatarPath)) {
            $foundPath = $directAvatarPath;
        }
    }

    if ($foundPath) {
        // Get MIME type
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($foundPath);

        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($foundPath));
        header('Cache-Control: max-age=86400');

        readfile($foundPath);
        return true;
    }

    // File not found
    http_response_code(404);
    header('Content-Type: text/plain');
    echo 'File not found: ' . $absolutePath;
    return true;
}

// Continue with normal routing via index.php
return false;
