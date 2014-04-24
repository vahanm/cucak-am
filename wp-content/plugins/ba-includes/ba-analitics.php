<?php

global $analitics_times;
global $analitics_counts;
$analitics_times = Array();
$analitics_counts = Array();

function analitics_begin($name) {
    global $analitics_times;
    global $analitics_counts;
    
    if(!isset($analitics_times[$name]))
        $analitics_times[$name] = 0;
    
    if(!isset($analitics_counts[$name]))
        $analitics_counts[$name] = 0;
    
    $analitics_times[$name] -= microtime(true);
    $analitics_counts[$name] += 1;
}

function analitics_end($name) {
    global $analitics_times;
    global $analitics_counts;
    
    if(!isset($analitics_times[$name]))
        $analitics_times[$name] = 0;
    
    $analitics_times[$name] += microtime(true);
}

function analitics_print() {
    global $analitics_times;
    global $analitics_counts;
    
    ?>
    <style>
        #analitics_result {
            position: fixed;
            left: 5px;
            top: 30px;
            background-color: orange;
            z-index: 10000000;
            padding: 3px;
            cursor: default;
        }
        
        #analitics_result td {
            padding: 0px 4px 0px 4px;
            text-align: center;
            max-width: 300px;
            min-width: 20px;
            border-top: 1px solid #fff;
            overflow: auto;
            max-height: 50px;
        }
        
        #analitics_result th {
            padding: 0px 4px 0px 4px;
        }
    </style>
    <div id="analitics_result">
        <h1>Analitics</h1>
        <div>Memory usage: <?php echo number_format(memory_get_usage(true), 0, '', ',') ?></div>
        <table>
            <tr><th>N</th><th>Name</th><th>Time</th><th>Count</th></tr>
        <?php
        $index = 1;
        
        foreach($analitics_times as $name => $value) {
            if($value > 0.1 || true) {
                echo '<tr><td>' . $index . '</td><td>' . $name . '</td><td>' . number_format($value, 3, '.', '') . '</td><td>' . $analitics_counts[$name] . '</td></tr>';
                $index ++;
            }
        }
    
        ?>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $( "#analitics_result" ).draggable();
        });
    </script>
    <?php
}

function add_client_to_db($sender = 'base') {
    global $wpdb;
    $table_name = $wpdb->prefix . "clients";

    $user_id =  get_current_user_id();
    
    if ($user_id == 1 || $user_id == 12)
        return;
    
    $ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
    $host = $_SERVER['HTTP_HOST'];
    $request_url = $_SERVER['REQUEST_URI'];

    $language = WPLANG;
    $referer = $_SERVER['HTTP_REFERER'];
    
    $opts = array('http' =>
                  array(
                    'timeout' => 1
                  )
                );
    $context  = stream_context_create($opts);
    //$user_agent_json = file_get_contents('http://' . 'www.useragentstring.com/?uas=' . urlencode($user_agent) . '&getJSON=all', false, $context);
    
    $agent_type = '';
    $agent_name = '';
    $agent_version = '';
    $os_type = '';
    $os_name = '';
    
    if(isset($user_agent_json) && strlen($user_agent_json) > 10) {
        $agent = json_decode($user_agent_json);
        if(isset($agent) && $agent->agent_type != 'unknown') {
            $agent_type = $agent->agent_type;
            $agent_name = $agent->agent_name;
            $agent_version = $agent->agent_version;
            $os_type = $agent->os_type;
            $os_name = $agent->os_name;
        }
    }
    
    if (   strpos($user_agent, 'pingdom') !== false
        || strpos($user_agent, 'Googlebot') !== false
        || strpos($user_agent, 'Mediapartners-Google') !== false
        || strpos($user_agent, 'Mail.RU_Bot') !== false
        || strpos($user_agent, 'YandexBot') !== false
        || strpos($user_agent, 'bingbot') !== false
        || strpos($user_agent, 'msnbot') !== false
        || strpos($user_agent, 'AhrefsBot') !== false
        || strpos($user_agent, 'Twitterbot') !== false
        || strpos($user_agent, 'DCPbot') !== false
        || strpos($user_agent, 'Ezooms') !== false
        || strpos($user_agent, 'MJ12bot') !== false
        || strpos($user_agent, 'ShowyouBot') !== false
        || strpos($user_agent, 'UnwindFetchor') !== false
        || strpos($user_agent, 'msnbot') !== false
        || strpos($user_agent, 'WebQL') !== false
        || strpos($user_agent, 'Y!TunnelPro') !== false
    )
        return;
    
    //if ($agent_type != 'Browser')
    //    return;
    //'$data_server', '$data_cookie', '$data_request', '$param_author', '$param_post', '$param_cat', '$param_search'

    $data_request = ba_tool_to_sql_json($_REQUEST);
    $data_cookie = ba_tool_to_sql_json($_COOKIE);
    $data_server = ba_tool_to_sql_json($_SERVER);

    $param_author = arg($_REQUEST, 'author', 0);
    $param_post = arg($_REQUEST, 'p', 0);
    $param_cat = arg($_REQUEST, 'cat', 0);
    $param_search = ''; //arg($_REQUEST, 's', '');
    
    $wp_query	=	"
                    INSERT INTO `$table_name`
                        (`date`, `user_id`, `ip`, `language`, `sender`, `host`, `commandline`, `referer`, `agent`, `agent_type`, `agent_name`, `agent_version`, `os_type`, `os_name`, `data_server`, `data_cookie`, `data_request`, `param_author`, `param_post`, `param_cat`, `param_search`)
                    VALUES (now(), '$user_id', '$ip', '$language', '$sender', '$host', '$request_url', '$referer', '$user_agent', '$agent_type', '$agent_name', '$agent_version', '$os_type', '$os_name', '$data_server', '$data_cookie', '$data_request', '$param_author', '$param_post', '$param_cat', '$param_search');
                    ";
                

    $wpdb->query($wp_query);
}

function ba_tool_to_sql_json($object) {
    $result = json_encode($object);
    if ($result) {
        $result = str_replace("'", "''", $result);
    }
    return $result;
}