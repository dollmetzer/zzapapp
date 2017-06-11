<?php
/**
 * Bootstrap file
 *
 * Loads and runs the application
 *
 * @author Dirk Ollmetzer <dirk.ollmetzer@ollmetzer.com>
 * @copyright (c) 2006-2017, Dirk Ollmetzer
 * @package Application
 */

namespace Application;

// include composer packages
include realpath(__DIR__ . '/../vendor/autoload.php');

// load configuration
include __DIR__ . '/config.php';

// set timezone and encoding
date_default_timezone_set(TIMEZONE);
mb_internal_encoding("UTF-8");

// load and run the application
$app = new \dollmetzer\zzaplib\Application($config);
$app->run();