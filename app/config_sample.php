<?php
/**
 * Sample configuration
 *
 * @author Dirk Ollmetzer <dirk.ollmetzer@ollmetzer.com>
 * @copyright (c) 2006-2017, Dirk Ollmetzer
 * @package Application
 */

// URL Settings
define('URL_BASE', 'zzapapp');
define('URL_MEDIA', 'zzapapp');
define('URL_REWRITE', true);
define('URL_HTTPS', false);

// Path Settings
define('PATH_BASE', realpath(__DIR__ . '/..') . '/');
define('PATH_APP', PATH_BASE . 'app/');
define('PATH_DATA', PATH_BASE . 'data/');
define('PATH_HTDOCS', PATH_BASE . 'htdocs/');
define('PATH_LOGS', PATH_BASE . 'logs/');

// External Services

// Application Settings
define('TIMEZONE', 'Europe/Berlin');
define('DEBUG_CLI', false);
define('DEBUG_API', false);
define('DEBUG_REQUEST', true);
define('DEBUG_SESSION', true);
define('DEBUG_CONTENT', true);
define('DEBUG_PERFORMANCE', true);
define('DEBUG_DB', true);

$config = array(
    'title' => 'zzap app',
    'themes' => array(
        'frontend',
        'backend'
    ),
    'languages' => array(
        'de',
        'en'
    ),
    'db' => array(
        'master' => array(
            'dsn' => 'mysql:host=localhost;dbname=zzapapp',
            'user' => 'dbusername',
            'pass' => 'dbuserpassword'
        )
    ),
    'quicklogin' => false,
    'register' => array(
        'selfregister' => true,
        'mailcheck' => true,
        'separate_handle' => true,
        'invitation' => false,
    ),
    'mail' => array(
        'admin' => 'your.mail@yourdomain.com',
        'from' => 'your name <your.mail@yourdomain.com>',
        'replyto' => 'your name <your.mail@yourdomain.com>',
    ),
);