<?php

    include('global.properties');

    $title = $_title;
    $mainmenuindex = 5;
    $content_tmpl = 'short_content';
    $articles = file('articles/config/articleslist.properties');
    $count = count($articles);
    for ($i = 0; $i < $count; $i++) {
        $articles[$i] = trim($articles[$i]);
    }
    $maincontent_tmpl = 'contentarticles';

    include('index.tmpl');

?>