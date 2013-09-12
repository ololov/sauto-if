<?php

    $filearticles = file('articles/config/articleslist.properties');
    $count = count($filearticles);
    $articles = array();
    $articles_title = array();
    $j = 0;
    for ($i = 0; $i < $count; $i++) {
        $string = trim($filearticles[$i]);
        $items = explode("|", $string);
        $file   = $items[0];
        $atitle  = $items[1];
        $active = $items[2];
        if ($active == 1) {
            $articles[$j] = $file;
            $articles_title[$j] = $atitle;
            $j++;
        }
    }

?>