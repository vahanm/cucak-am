<?php

//getting subdomain -- BEGIN

$url = $_SERVER['HTTP_HOST'];

$parsedUrl = parse_url($url);

$host = explode('.', $parsedUrl['path']);

$subdomains = array_reverse (array_slice($host, 0, count($host) - 2 ));

//getting subdomain -- END




