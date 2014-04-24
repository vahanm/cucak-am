<?php

$userId = arg($_GET, 'author', 0);

$cats = getUserTopCategories($userId);

$index = 0;
global $categoriesMetroParams;

foreach ($cats as $cat) {
    $catId = $cat->catId;
    
    $catParams = $categoriesMetroParams[$catId];

    if ($index < 5) {
        helper_cat_sub($catParams['id'], __($catParams['title']), $catId, $catParams['backcolor'], $catParams['text'], $cat->postsCount);
    } else {
        helper_cat_sub($catParams['id'], __($catParams['title']), $catId, $catParams['backcolor'], $catParams['text'], $cat->postsCount);
    }
    
    $index++;
}
