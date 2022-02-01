<?php

require_once 'vendor/classes/Application.php';
$config = require __DIR__ . '/config/config.php';
(new Application( $config ))->run();

