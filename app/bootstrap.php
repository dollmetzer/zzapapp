<?php
/**
 * Bootstrap file
 *
 * Loads and runs the application
 *
 * @author Dirk Ollmetzer <dirk.ollmetzer@ollmetzer.com>
 * @copyright (c) 2006-2019, Dirk Ollmetzer
 * @package Application
 */

namespace Application;

use \dollmetzer\zzaplib\Application;

// include composer packages
include realpath(__DIR__ . '/../vendor/autoload.php');

// load configuration
//include __DIR__ . '/config.php';

// set timezone
//date_default_timezone_set(TIMEZONE);

// load and run the application
$app = new Application(__DIR__ . '/config.php');
$app->run();
