<?php

    include('global.properties');

    $title = $_title;
    $mainmenuindex = 3;
    $content_tmpl = 'index_content';
    $articles = file('articles/config/articleslist.properties');
    $count = count($articles);
    for ($i = 0; $i < $count; $i++) {
        $articles[$i] = trim($articles[$i]);
    }
    $maincontent_tmpl = 'framehot';

    include('index.tmpl');

?>