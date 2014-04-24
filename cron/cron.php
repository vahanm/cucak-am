<?php
// /usr/bin/php -q /home/parapam/public_html/cucak.am/cron/update-user-rates.php
// /usr/bin/php -q /home/parapam/public_html/cucak.am/cron/update-search-indexes.php

define('CRON_BR', "\n\r -> ");

echo CRON_BR, 'Cron Job', CRON_BR, CRON_BR, 'BEGIN', CRON_BR;

require_once(dirname(__FILE__) . '/../wp-config.php');

// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$jobs = array(
    (object)array( 'path' => 'update-user-rates.php'),
    (object)array( 'path' => 'update-search-indexes.php'),
    (object)array( 'path' => 'update-search-autocomplete.php'),
    );

foreach($jobs as $job) {
    echo CRON_BR, CRON_BR, 'JOB Started: ', date('Y-m-d H:i:s');
    
    $started = microtime(true);
    
    include $job->path;
    
    $diff = microtime(true) - $started;
    
    echo CRON_BR, 'JOB Completed: ', date('Y-m-d H:i:s'), ' ( ', number_format($diff, 2, '.', ' '), 'sec )';
}

echo CRON_BR, CRON_BR, 'END';

add_client_to_db('Cron/Main (1h)');
