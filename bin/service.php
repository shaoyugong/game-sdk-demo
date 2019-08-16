<?php
use Game\Sdk\Register;

define('BASE_PATH', __DIR__ . '/../');

require BASE_PATH . 'vendor/autoload.php';

$file = BASE_PATH . 'config.yal';

if (isset($argv[1]) && $argv[1] == '-c' && $argv[2]) {
    $file = $argv[2];
}

if (!is_file($file)) {
    echo <<<EOF
Error: This "{$file}" is not a file;

EOF;
    exit;
}

$content = file_get_contents($file);
$config  = \Symfony\Component\Yaml\Yaml::parse($content);

$env = Register::EVNIRONMENT_PRODUCE;

if (isset($argv[3]) && $argv[3]) {
    switch ($argv[3]) {
        case '--dev':
            $env = Register::EVNIRONMENT_DEV;
            break;
        case '--local':
            $env = Register::EVNIRONMENT_LOCAL;
            break;
    }
}

Register::instance($config, $env)->connnect();