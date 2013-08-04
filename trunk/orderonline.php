<?php

    include('global.properties');
    include ('mysql.php');

    $title = $_title;

    $mainmenuindex = 10;
    $order_index = 0;
    $content_tmpl = 'short_content';
    $maincontent_tmpl = 'contentorderonline';
    $action = $_POST['action'];
    if ($action == 'save') {
        $title = 'online';
        $descr = (isset($_POST['descr'])) ? mysql_real_escape_string($_POST['descr']) : '';
        $query = "INSERT
                    INTO `orders`
                    SET
                        `title`='{$title}',
                        `descr`='{$descr}'";
        $result = true;
        $sql = mysql_query($query) or ($result = false);
        $order_id = mysql_insert_id();
        $maincontent_tmpl = 'contentorderresult';
    }
    $order_index = 0;

    include('index.tmpl');

?>