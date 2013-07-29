<?php

    include('global.properties');

    $title = $_title;
    
    $mainmenuindex = 10;
    $ot = $_GET['order'];
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
    case 'autopartner':
        $mainmenuindex = 40;
        break;
    }
    $order_index = $mainmenuindex / 10 - 1;

    $content_tmpl = 'short_content';
    $maincontent_tmpl = 'contentuc';

    include('index.tmpl');

?>