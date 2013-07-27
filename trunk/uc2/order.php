<?php

    include('global.properties');

    $title = $_title;
    
    $mainmenuindex = 10;

    switch ($ot) {
    case 'online':
        $mainmenuindex = 10;
        break;
    case 'icars':
        $mainmenuindex = 20;;
        break;
    case 'polcar':
        $mainmenuindex = 30;
        break;
    case 'polcar':
        $mainmenuindex = 40;
        break;
    }

    $content_tmpl = 'short_content';
    $maincontent_tmpl = 'contentorder';

    include('index.tmpl');

?>