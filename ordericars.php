<?php

    include('global.properties');
    include('mysql.php');

    $title = $_title;

    $mainmenuindex = 20;
    $order_index = 1;
    $result = $_GET['result'];
    $error = $_GET['error'];
    $order_id = $_GET['order_id'];
    $order_title = $_order_id[$order_index];
    $returnurl = $_order_url[$order_index];
    $formorder = 'formorder.tmpl';
    $formorderdetails = 'formorderpartner.tmpl';
    $content_tmpl = 'short_content';
    $maincontent_tmpl = 'contentorder';
    $online = false;


    include('index.tmpl');

?>