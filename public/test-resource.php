<?php

echo "=== Test d'accès aux ressources ===\n\n";

// Simuler le chemin du router
$resourcesRoot = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'resources';
$file = 'logo.txt';

$absolutePath = $resourcesRoot . DIRECTORY_SEPARATOR . $file;

echo "Resources Root: $resourcesRoot\n";
echo "File: $file\n";
echo "Absolute Path: $absolutePath\n";
echo "File exists: " . (is_file($absolutePath) ? 'OUI' : 'NON') . "\n";

if (is_file($absolutePath)) {
    echo "Content: " . file_get_contents($absolutePath) . "\n";
}

echo "\n--- Test avatar ---\n";
$avatarFile = 'images/avatars/avatar_3_2cb62eac0e321694.png';
$avatarPath = $resourcesRoot . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $avatarFile);
echo "Avatar Path: $avatarPath\n";
echo "Avatar exists: " . (is_file($avatarPath) ? 'OUI' : 'NON') . "\n";

echo "\n=== Instructions ===\n";
echo "Démarrez le serveur avec:\n";
echo "php -S 0.0.0.0:8000 -t public router.php\n\n";
echo "Puis accédez à:\n";
echo "http://localhost:8000/resources/logo.txt\n";
echo "http://localhost:8000/resources/images/avatars/avatar_3_2cb62eac0e321694.png\n";
