<?php
/**
 * E X A M P L E   C O N F I G U R A T I O N
 * -----------------------------------------
 *
 * @author Dirk Ollmetzer <dirk.ollmetzer@ollmetzer.com>
 * @copyright (c) 2006-2022, Dirk Ollmetzer
 * @package Application
 */

// URL Settings - skip, if called by console script
define('URL_BASE', 'localhost/zzapapp3');
define('URL_MEDIA', 'localhost/zzapapp3');
define('URL_REWRITE', true);
define('URL_HTTPS', false);

// Path Settings
define('PATH_BASE', realpath(__DIR__ . '/..') . '/');
define('PATH_APP', PATH_BASE . 'app/');
define('PATH_DATA', PATH_BASE . 'data/');
define('PATH_HTDOCS', PATH_BASE . 'htdocs/');
define('PATH_LOGS', PATH_BASE . 'logs/');
define('PATH_TMP', PATH_BASE . 'tmp/');

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

// Set encoding (not on live cloud system)
mb_internal_encoding("UTF-8");

return [
    'title' => 'zzapapp3',
    'themes' => array(
        'frontend'
    ),
    'languages' => array(
        'de',
        'en'
    ),
    'db' => array(
        'master' => array(
            'dsn' => 'mysql:host=localhost;dbname=zzapapp3',
            'user' => 'root',
            'pass' => 'root'
        )
    ),
    'database' => array(
        'dsn' => 'mysql:host=localhost;dbname=zzapapp3',
        'user' => 'dbusername',
        'password' => 'dbuserpassword'
    ),
    'countries' => array(
        'at',
        'de',
        'ch',
        'dk',
        'se',
        'no',
        'fi'
    ),
];
