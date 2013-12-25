<?php

    $get_all = true;
    include('getarticles.php');
    $filearticles = file_get_contents($file);
    $newfilearticles = 'article'.($count+1).'|Нова стаття|0\n'.$filearticles;
    file_put_contents('articles/config/articleslist.properties', $newfilearticles);

    header("Location: http://sauto.if.ua/articleseditor.php");

    ?>