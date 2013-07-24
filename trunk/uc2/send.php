<?php 
$to  = "Zoreslav &lt;gzoreslav@gmail.com>, " ; 
$to .= "Zoreslav &lt;zor.g@email.ru>"; 

$subject = "SAUTO - iCars order #001"; 

$message = ' 
<html> 
    <head> 
        <title>SAUTO - iCars order #001</title> 
    </head> 
    <body> 
        <h1>SAUTO - iCars order #001</h1>
        <p>Будь-ласка купіть мені ці запчастікі! :)</p> 
    </body> 
</html>'; 

$headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
$headers .= "From: SAUTO <birthday@example.com>\r\n"; 

mail($to, $subject, $message, $headers); 
?>