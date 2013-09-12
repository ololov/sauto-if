<?php

    $get_all = true;
    include('getarticles.php');
    $current = file_get_contents('articles/config/articleslist.properties');
    $new = 'article'.($count+1).'|Нова стаття|0'.PHP_EOL.$current;
    file_put_contents('articles/config/articleslist.properties', $new);

    header("Location: http://sauto.if.ua/articleseditor.php");

    ?>