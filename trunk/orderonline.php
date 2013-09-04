<?php

    include('global.properties');
    include('mysql.php');

    $title = $_title;

    $mainmenuindex = 10;
    $order_index = 0;
    $result = $_GET['result'];
    $error = $_GET['error'];
    $order_id = $_GET['order_id'];
    $key = $_GET['key'];
    $order_title = $_order_id[$order_index];
    $returnurl = $_order_url[$order_index];
    $formorder = 'formorder.tmpl';
    $formorderdetails = 'formorderonline.tmpl';
    $content_tmpl = 'short_content';
    $maincontent_tmpl = 'contentorder';

    include('index.tmpl');

?>