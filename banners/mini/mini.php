<?php
require_once(dirname(__FILE__).'/../../wp-config.php');

global $wpdb;

/*
$word = $_GET['term'];

$wp_query	=	'   SELECT
                        s.key AS label, s.key AS value
                    FROM ' . $wpdb->prefix . 'search_keys s
                    WHERE s.key LIKE \'' . str_replace('\'', '\\\'', str_replace('\\', '\\\\', $word)) . '%\'
                    ORDER BY s.rate DESC
                    LIMIT 10;';

echo json_encode($wpdb->get_results($wp_query));
*/
?>

<div id="cucak-mini-banner" style="display: none;">

</div>