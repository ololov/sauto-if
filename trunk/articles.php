<?php

    include('global.properties');

    $title = $_title;
    $mainmenuindex = 5;
    $content_tmpl = 'short_content';
    include('getarticles.php');

    $maincontent_tmpl = 'contentarticles';

    include('index.tmpl');

?>