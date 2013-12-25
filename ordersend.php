<?php

$to = "gzoreslav@gmail.com"; 
$order = "ICARS14";
$subject = "SAUTO - iCars order #".$order; 
$cur_date = date('r');
echo $cur_date;
$filename = "order-".$order.".txt";
$filepath = "orders/".$filename;
$message = ' 
<html> 
    <head> 
        <title>SAUTO - iCars order #'.$order.'</title> 
    </head> 
    <body> 
        <table style="border: 1px #333 solid; background-color: #eee">
            <tr>
                <td colspan="2" style="padding: 3px;"><b>Замовлення #'.$order.'</b></td>
            </tr>
            <tr>
                <td style="padding: 3px;">Партнер:</td>
                <td style="padding: 3px;">iCarc</td>
            </tr>
            <tr>
                <td style="padding: 3px;">Замовник:</td>
                <td style="padding: 3px;">Зореслав</td>
            </tr>
            <tr>
                <td style="padding: 3px;">e-mail:</td>
                <td style="padding: 3px;">gzoreslav@gmail.com</td>
            </tr>
            <tr>
                <td style="padding: 3px;">Телефон:</td>
                <td style="padding: 3px;">+380967516185</td>
            </tr>
            <tr>
                <td style="padding: 3px;">Замовлення:</td>
                <td style="padding: 3px;">(див. вкладенний файл '.$filename.') abo <a href="http://www.sauto.if.ua/uc2/orders/'.$filename.'">скачати</a></td>
            </tr>
            <tr>
                <td style="padding: 3px;">Примітки:</td>
                <td style="padding: 3px;">Просто перевірка чи працює висилання з файлом заатаченим</td>
            </tr>
        </table>
        <p>Замовлено '.$cur_date.'</p>
        <p>Детально на сайті <a href="http://www.sauto.if.ua/uc2/order_check?order='.$order.'">http://www.sauto.if.ua/uc2/order_check?order='.$order.'</a></p>
        <p>&copy; SAUTO 2013</p>
    </body> 
</html>'; 

$boundary = "--".md5(uniqid(time())); 

$mailheaders = "MIME-Version: 1.0;\r\n"; 
$mailheaders .="Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n"; 

$mailheaders .= "From: SAUTO <order@sauto.if.ua>\r\n"; 

$multipart = "--$boundary\r\n"; 
$multipart .= "Content-Type: text/html; charset=windows-1251\r\n";
$multipart .= "Content-Transfer-Encoding: base64\r\n";    
$multipart .= "\r\n";
$multipart .= chunk_split(base64_encode(iconv("utf8", "windows-1251", $message)));
/*
    $fp = fopen($filepath,"r"); 
        if (!$fp) 
        { 
            print "Не удается открыть файл22"; 
            exit(); 
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

$multipart .= $message_part;*/

if (mail($to,$subject,$multipart,$mailheaders)) { 
    echo "messege acepted for delivery"; 
} else { 
    echo "some error happen"; 
} 

/*if (time_nanosleep(5, 0)) {
        unlink($filepath);
}*/

?>