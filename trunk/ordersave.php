<?php

    include('global.properties');
    include ('mysql.php');

        $order_title = (isset($_POST['order_title'])) ? mysql_real_escape_string($_POST['order_title']) : '';
        $nickname = (isset($_POST['nickname'])) ? mysql_real_escape_string($_POST['nickname']) : '';
        $phone = (isset($_POST['phone'])) ? mysql_real_escape_string($_POST['phone']) : '';
        $email = (isset($_POST['email'])) ? mysql_real_escape_string($_POST['email']) : '';
        $detail = (isset($_POST['detail'])) ? mysql_real_escape_string($_POST['detail']) : '';
        $auto = (isset($_POST['auto'])) ? mysql_real_escape_string($_POST['auto']) : '';
        $autoyear = (isset($_POST['autoyear'])) ? mysql_real_escape_string($_POST['autoyear']) : '';
        $autobodyno = (isset($_POST['autobodyno'])) ? mysql_real_escape_string($_POST['autobodyno']) : '';
        $vin = (isset($_POST['vin'])) ? mysql_real_escape_string($_POST['vin']) : '';
        $descr = (isset($_POST['descr'])) ? mysql_real_escape_string($_POST['descr']) : '';
        $review = (isset($_POST['review'])) ? mysql_real_escape_string($_POST['review']) : '';
        $query = "INSERT
                    INTO `orders`
                    SET
                        `title`='{$order_title}',
                        `nickname`='{$nickname}',
                        `phone`='{$phone}',
                        `email`='{$email}',
                        `detail`='{$detail}',
                        `auto`='{$auto}',
                        `autoyear`='{$autoyear}',
                        `autobodyno`='{$autobodyno}',
                        `vin`='{$vin}',
                        `descr`='{$descr}',
                        `review`='{$review}'";
        $result = 'ok';
        $sql = mysql_query($query) or ($result = 'error');
        $order_id = mysql_insert_id();
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $returnurl = $_POST['returnurl'];
        $extra = $returnurl.'.php?result='.$result.'&order_id='.$order_id;

$to = "gzoreslav@gmail.com"; 
$order = $order_title.'-'.$order_id;
$subject = "SAUTO - iCars order #".$order; 
$cur_date = date('r');
$message = $review; 

$boundary = "--".md5(uniqid(time())); 

$mailheaders = "MIME-Version: 1.0;\r\n"; 
$mailheaders .="Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n"; 

$mailheaders .= "From: SAUTO <order@sauto.if.ua>\r\n"; 

$multipart = "--$boundary\r\n"; 
$multipart .= "Content-Type: text/html; charset=windows-1251\r\n";
$multipart .= "Content-Transfer-Encoding: base64\r\n";    
$multipart .= "\r\n";
$multipart .= chunk_split(base64_encode(iconv("utf8", "windows-1251", $message)));

mail($to,$subject,$multipart,$mailheaders);

        header("Location: http://$host$uri/$extra");
        exit;

?>