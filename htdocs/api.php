<?php

namespace Application;

// include composer packages
include realpath(__DIR__ . '/../vendor/autoload.php');

// set timezone and encoding
date_default_timezone_set(TIMEZONE);
mb_internal_encoding("UTF-8");

$app = new \dollmetzer\zzaplib\Api(__DIR__ . '/../app/config.php');
$app->run();
