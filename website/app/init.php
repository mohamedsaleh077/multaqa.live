<?php
// Include all the core files
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';
require_once 'vendor/autoload.php';

// session start
use Random\RandomException;

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

$config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/configs.ini', true);

session_set_cookie_params([
    'lifetime' => $config['lifetime'],
    'domain' => $config['host'],
    'path' => '/',
    'secure' => $config['secure'],
    'httponly' => true
]);

session_start();

// session_rege nerate_id(true);
function regenerateSessionId(): void
{
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
    try {
        $_SESSION["CSRF_TOKEN"] = bin2hex(random_bytes(32));
    } catch (RandomException) {

    }
}

if (!isset($_SESSION['last_regeneration'])) {
    regenerateSessionId();
} else {
    $interval = 60 * 30;
    if (time() - $_SESSION['last_regeneration'] >= $interval) {
        regenerateSessionId();
    }
}