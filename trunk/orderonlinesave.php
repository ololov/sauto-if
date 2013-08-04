<?php

    include('global.properties');
    include ('mysql.php');

        $title = 'online';
        $descr = (isset($_POST['descr'])) ? mysql_real_escape_string($_POST['descr']) : '';
        $query = "INSERT
                    INTO `orders`
                    SET
                        `title`='{$title}',
                        `descr`='{$descr}'";
        $result = 'ok';
        $sql = mysql_query($query) or ($result = 'error');
        $order_id = mysql_insert_id();
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'orderonline.php?result='.$result.'&order_id='.$order_id;
        header("Location: http://$host$uri/$extra");
        exit;

?>