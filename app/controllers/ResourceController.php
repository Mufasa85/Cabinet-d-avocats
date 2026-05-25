<?php

namespace App\controllers;

use Service\FileStorage;

class ResourceController extends Controller
{
    public function serve(array $params): void
    {
        $file = $params['file'] ?? '';
        if ($file === '' || str_contains($file, '..')) {
            http_response_code(404);
            exit;
        }

        $path = FileStorage::absolutePath($file);
        if (!is_file($path)) {
            http_response_code(404);
            exit;
        }

        $mime = mime_content_type($path) ?: 'application/octet-stream';
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    }
}
