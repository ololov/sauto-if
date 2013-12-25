<?php

    include('global.properties');

    $title = $_title;
    $mainmenuindex = 3;
    $content_tmpl = 'index_content';
    include('getarticles.php');

    $maincontent_tmpl = 'contenthot';

    include('index.tmpl');

?>