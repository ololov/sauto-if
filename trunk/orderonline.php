<?php

    include('global.properties');
    include ('mysql.php');

    $title = $_title;

    $mainmenuindex = 10;
    $order_index = 0;
    $result = $_GET['result'];
    $order_id = $_GET['order_id'];
    $content_tmpl = 'short_content';
    $maincontent_tmpl = 'contentorderonline';

    include('index.tmpl');

?>