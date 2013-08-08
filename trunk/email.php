<?php

$message =
'<html>
    <head>
        <meta charset="utf-8">
        <title>SAUTO - Замовлення #'.$order.'</title>
    </head> 
    <body> 
        <table width="600px;" style="width: 600px;">
        <tr>
        <td>
        <img src="http://www.sauto.if.ua/styles/images/logo.png"/>
        <table style="background-color: #eee">
            <tr style="background-color: #e74c3c; color: white; margin: 0; padding: 0; font-size: 16px; font-weight: bold;">
                <td colspan="2" style="padding: 3px;"><b>Замовлення #'.$order.'</b></td>
            </tr>
            <tr>
                <td style="padding: 3px;">Замовник:</td>
                <td style="padding: 3px;">'.$nickname.'</td>
            </tr>
            <tr>
                <td style="padding: 3px;">e-mail:</td>
                <td style="padding: 3px;">'.$email.'</td>
            </tr>
            <tr>
                <td style="padding: 3px;">Телефон:</td>
                <td style="padding: 3px;">'.$phone.'</td>
            </tr>
            <tr>
                <td style="padding: 3px;">Замовлення:</td>
                <td style="padding: 3px;">(див. вкладенний файл '.$filename.') abo <a href="http://www.sauto.if.ua/orders/'.$filename.'">скачати</a></td>
            </tr>
            <tr>
                <td style="padding: 3px;">Примітки щодо замовлення:</td>
                <td style="padding: 3px;">'.$descr.'</td>
            </tr>
        </table>
        <p>Замовлено '.$cur_date.'</p>
        <p>Детально на сайті <a href="#">буде згодом</a></p>
        <p><strong>Відгук замовника про сайт SAUTO:</strong></p>
        <p>'.$review.'</p>
        <hr/>
        <p>&copy; SAUTO 2013</p>
        </td>
        </tr>
        </table>
    </body> 
</html>';

?>
