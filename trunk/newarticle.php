<?php

    $get_all = true;
    include('getarticles.php');
    $articlefile = 'article'.($count+1);
    $propfile = 'articles/config/articleslist.properties';
    $current = file_get_contents($propfile);
    $new = $articlefile.'|Нова стаття '.($count+1).'|0'.PHP_EOL.$current;
    file_put_contents($propfile, $new);
    file_put_contents('articles/'.$articlefile.'.htm', 'Повний опис нової статті '.($count+1));
    file_put_contents('articles/'.$articlefile.'_short.htm', 'Скорочений опис нової статті '.($count+1));

    header("Location: http://sauto.if.ua/articleseditor.php?articleindex=0");

    ?>