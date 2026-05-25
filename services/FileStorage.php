<?php

namespace Service;

class FileStorage
{
    private const MAX_BYTES = 5 * 1024 * 1024;
    private const ALLOWED_PDF = ['application/pdf'];
    private const ALLOWED_IMAGES = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

    public static function root(): string
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . 'resources';
    }

    public static function url(string $relativePath): string
    {
        $relativePath = ltrim(str_replace('\\', '/', $relativePath), '/');
        return \Router\Router::route('/resources/' . $relativePath);
    }

    /**
     * @return array{fichier: string, taille: int, mime: string}
     */
    public static function storeUpload(array $file, string $subdir, ?string $prefix = null): array
    {
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            throw new \RuntimeException('Échec du téléversement du fichier.');
        }

        if (($file['size'] ?? 0) > self::MAX_BYTES) {
            throw new \RuntimeException('Le fichier dépasse la taille maximale de 5 Mo.');
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']) ?: ($file['type'] ?? '');
        $isImageDir = str_starts_with(str_replace('\\', '/', $subdir), 'images/');
        $allowed = $isImageDir ? self::ALLOWED_IMAGES : self::ALLOWED_PDF;
        if (!in_array($mime, $allowed, true)) {
            throw new \RuntimeException($isImageDir ? 'Format d\'image non autorisé.' : 'Seuls les fichiers PDF sont acceptés.');
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExt = $isImageDir ? ['jpg', 'jpeg', 'png', 'webp', 'gif'] : ['pdf'];
        if (!in_array($ext, $allowedExt, true)) {
            throw new \RuntimeException('Extension de fichier non autorisée.');
        }

        $targetDir = self::root() . DIRECTORY_SEPARATOR . trim($subdir, '/\\');
        if (!is_dir($targetDir) && !mkdir($targetDir, 0755, true)) {
            throw new \RuntimeException('Impossible de créer le dossier de stockage.');
        }

        $safeName = ($prefix ? preg_replace('/[^a-z0-9_-]/i', '_', $prefix) . '_' : '')
            . bin2hex(random_bytes(8)) . '.' . $ext;

        $absolute = $targetDir . DIRECTORY_SEPARATOR . $safeName;
        if (!move_uploaded_file($file['tmp_name'], $absolute)) {
            throw new \RuntimeException('Impossible d\'enregistrer le fichier.');
        }

        $relative = trim($subdir, '/\\') . '/' . $safeName;

        return [
            'fichier' => $relative,
            'taille' => (int) $file['size'],
            'mime' => $mime,
        ];
    }

    public static function absolutePath(string $relativePath): string
    {
        $relativePath = str_replace(['..', '\\'], ['', '/'], $relativePath);
        return self::root() . DIRECTORY_SEPARATOR . ltrim($relativePath, '/');
    }

    public static function delete(string $relativePath): void
    {
        $path = self::absolutePath($relativePath);
        if (is_file($path)) {
            unlink($path);
        }
    }
}
