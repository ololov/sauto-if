<?php

function redirect($result_, $order_id_, $error_)
{
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $returnurl = $_POST['returnurl'];
    $extra = $returnurl.'.php?result='.$result_.'&order_id='.$order_id_.'&error='.$error_;
    header("Location: http://$host$uri/$extra");
    exit;
}

    include('global.properties');
    include ('mysql.php');

        $error = '';
        $result = 'ok';

        // store data to database

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
        $sql = mysql_query($query) or ($result = 'error');
        if ($result == 'error') {
            $error = $error.'[01] помилка запису в базу даних';
            redirect($result, $order_id, $error);
        }
        //get order ID
        $order_id = mysql_insert_id();

        //upload order file to server

        $order = $order_title.'-'.$order_id;
        $filename = $order.".txt";

        $uploaddir = 'orders/';
        if (move_uploaded_file($_FILES['filename']['tmp_name'], $uploaddir . 
            $filename)) {
        } else {
            $error = $error.'[02] неможливо завантажити файл "'.$filename.'"';
            $result = 'error';
            redirect($result, $order_id, $error);
        }

        $filepath = $uploaddir.$filename;


        //send email to the order service

        $to = "gzoreslav@gmail.com, sauto@mail.ua"; 
        $subject = "SAUTO - замовлення #".$order; 
        $cur_date = date('r');
        //email template
        include('email.php');

        $boundary = "--".md5(uniqid(time())); 

        $mailheaders = "MIME-Version: 1.0;\r\n"; 
        $mailheaders .="Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n"; 

        $mailheaders .= "From: SAUTO <order@sauto.if.ua>\r\n"; 

        $multipart = "--$boundary\r\n"; 
        $multipart .= "Content-Type: text/html; charset=windows-1251\r\n";
        $multipart .= "Content-Transfer-Encoding: base64\r\n";    
        $multipart .= "\r\n";
        $multipart .= chunk_split(base64_encode(iconv("utf8", "windows-1251", $message)));

        $fp = fopen($filepath,"r"); 
        if (!$fp) {
            $error = $error.'[03] неможливо знайти файл "'.$filepath.'"';
            $result = 'error';
            redirect($result, $order_id, $error);
        }

        $file = fread($fp, filesize($filepath)); 
        fclose($fp);

        $message_part = "\r\n--$boundary\r\n"; 
        $message_part .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";  
        $message_part .= "Content-Transfer-Encoding: base64\r\n"; 
        $message_part .= "Content-Disposition: attachment; filename=\"$filename\"\r\n"; 
        $message_part .= "\r\n";
        $message_part .= chunk_split(base64_encode($file));
        $message_part .= "\r\n--$boundary--\r\n";

        $multipart .= $message_part;

        if (mail($to,$subject,$multipart,$mailheaders)) {
        } else {
            $error = $error.'[04] неможливо обробити замовлення';
            $result = 'error';
            redirect($result, $order_id, $error);
        }

        //redirect to the order page
        redirect($result, $order_id, $error);


?>