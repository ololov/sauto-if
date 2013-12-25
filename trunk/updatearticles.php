<?php

    $count = $_POST['count'];
    $propfile = 'articles/config/articleslist.properties';
    $content = '';
    for ($i = 0; $i < $count; $i++) {
        $articlefile  = $_POST['articlefile'.$i];
        $articletitle = $_POST['articletitle'.$i];
        if ($_POST['articleactive'.$i] == "1") {
            $articleactive = 1;
        } else {
            $articleactive = 0;
        }
        $content = $content.$articlefile.'|'.$articletitle.'|'.$articleactive.PHP_EOL;
    }
    file_put_contents($propfile, $content);

    header("Location: http://sauto.if.ua/articleseditor.php");

    ?>