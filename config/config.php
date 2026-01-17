<?php

// Charger les variables d'environnement
if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($key, $value) = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

return [
    // Base de données
    'db_host' => $_ENV['DB_HOST'] ?? 'localhost',
    'db_name' => $_ENV['DB_NAME'] ?? 'job_dating',
    'db_user' => $_ENV['DB_USER'] ?? 'root',
    'db_pass' => $_ENV['DB_PASS'] ?? '',

    // Application
    'app_name' => $_ENV['APP_NAME'] ?? 'Job Dating Framework',
    'app_env' => $_ENV['APP_ENV'] ?? 'development',
    'app_url' => $_ENV['APP_URL'] ?? 'http://localhost',

    // Sécurité
    'session_lifetime' => 120, // minutes
    'csrf_token_name' => '_csrf_token',

    // Paths
    'view_path' => __DIR__ . '/../app/views',
    'log_path' => __DIR__ . '/../logs',
];