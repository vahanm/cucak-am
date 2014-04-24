<?php

function get_results_from_google($term) {
    $query = urlencode($term);
    $url = "https://www.googleapis.com/customsearch/v1element?key=AIzaSyCVAXiUzRYsML1Pv6RwSG1gunmMikTzQqY&cx=014403902121870007033:xlqzxierfdc&q={$query}";
    $json = file_get_contents($url);
    $obj = json_decode($json);
        
    $result = array();
    
    foreach ($obj->results as $item) {
        $result[] = (object)array(
                    'source'    => 'google',
                    'label'     => "{$item->titleNoFormatting}",
                    'value'     => "{$item->titleNoFormatting}",
                    );
    }
    
    return $result;
}