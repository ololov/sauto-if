<?php

    $propfile = 'articles/config/articleslist.properties';
    $content = '';

    if (isset($_POST['count']) {
        //update all articles
        $count = $_POST['count'];
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
    } else {
        //update one article
        $get_all = true;
        include('getarticles.php');
        $articleindex = $_GET['articleindex'];
        for ($i = 0; $i < $count; $i++) {
            $articlefile  = $articles[$i];
            if ($i == $articleindex) {
                $articletitle = $_POST['articletitle'];
                if ($_POST['articleactive'.$i] == "1") {
                    $articleactive = 1;
                } else {
                    $articleactive = 0;
                }
            }
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
    }

    ?>