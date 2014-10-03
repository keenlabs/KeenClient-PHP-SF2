<?php

error_reporting(-1);

if (!file_exists(dirname(__DIR__) . '/composer.lock')) {
    die("Dependencies must be installed using composer:\n\nphp composer.phar install\n\n"
        ."See http://getcomposer.org for help with installing composer\n");
}

$loader = require dirname(__DIR__) . '/vendor/autoload.php';
$loader->addPsr4('KeenIO\\Bundle\\KeenIOBundle\\Tests\\', __DIR__);
