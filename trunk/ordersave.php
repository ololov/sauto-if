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

function mail_to($to, $from, $subj, $text, $files=null){
    $boundary = md5(uniqid(time()));
    $headers[] ="MIME-Version: 1.0";
    $headers[] ="Content-Type: multipart/mixed;boundary=\"$boundary\"; type=\"text/html;\"";
    $headers[] ="From: ".$from;
    $headers[] ="Reply-To: ".$from;
    $headers[] ="Return-Path: ".$from;
    $headers[] ="X-Mailer: PHP/" . phpversion();

    $multipart[]= "--".$boundary;
    $multipart[]= "Content-Type: text/html; charset=utf-8";
    $multipart[]= "Content-Transfer-Encoding: Quot-Printed";
    $multipart[]= ""; // раздел между заголовками и телом html-части
    $multipart[]= $text;
    $multipart[]= "";

    if ((is_array($files))&&(!empty($files)))
        {
        foreach($files as $filename => $filecontent)
            {
            $multipart[]="--".$boundary;
            $multipart[]= "Content-Type: application/octet-stream; name=\"".$filename."\"";
            $multipart[]= "Content-Transfer-Encoding: base64";
            $multipart[]= "Content-Disposition: attachment; filename=\"".$filename."\"";
            $multipart[]= "";
            $multipart[]= chunk_split(base64_encode($filecontent));
            }
    }

    $multipart[]= "--$boundary--";
    $multipart[]= "";
    $headers=implode("\r\n", $headers);
    $multipart=implode("\r\n", $multipart);
    if (mb_detect_encoding($subj, "UTF-8")==FALSE)
    $subj= mb_encode_mimeheader($subj,"UTF-8", "B", "\n");

    return mail($to, $subj, $multipart, $headers);
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

        $uploaddir = 'orders/';
        $uploader_count = $_POST['uploader_count'];
        $files = array();
        for ($i = 0; $i < $uploader_count; $i++ ) {
            //$files[] = $uploaddir.$order."___".$_POST['uploader_'.$i.'_name'];
            if (rename('uploads/'.$_POST['uploader_'.$i.'_name'], $uploaddir.$order."___".$_POST['uploader_'.$i.'_name'])) {
                $files[$order."___".$_POST['uploader_'.$i.'_name']] = file_get_contents($uploaddir.$order."___".$_POST['uploader_'.$i.'_name']);;
            } else {
                $error = $error.'[02] неможливо завантажити файл "'.$filename.'"';
                $result = 'error';
                redirect($result, $order_id, $error);
            }
        }



        //init mailing data

        $to = "gzoreslav@gmail.com, sauto@mail.ua"; 
        $from="SAUTO <order@sauto.if.ua>";
        $subj = "SAUTO - замовлення #".$order; 
        $cur_date = date('r');
        //$message -> email template
        include('email.php');

        $boundary = "--".md5(uniqid(time())); 

//$path_to_file=dirname(__FILE__).DIRECTORY_SEPARATOR."text.txt";
//$files = array('text.txt' => file_get_contents($path_to_file));

        //send email to the order service

        if (mail_to($to, $from, $subj, $message, $files)) {
        } else {
            $error = $error.'[04] неможливо обробити замовлення';
            $result = 'error';
            redirect($result, $order_id, $error);
        }

        //redirect to the order page
        redirect($result, $order_id, $error);

?>