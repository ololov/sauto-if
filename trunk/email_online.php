<?php

$message =
'<html>
    <head>
        <meta charset="utf-8">
        <title>SAUTO - Замовлення #'.$order.'</title>
    </head> 
    <body> 
        <table width="450px;" style="width: 450px;">
        <tr>
        <td>
        <img src="http://www.sauto.if.ua/styles/images/logo.png"/>
        <table style="background-color: #eee; width: 450px;">
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
                <td style="padding: 3px;">Назва запчастини:</td>
                <td style="padding: 3px;">'.$detail.'</td>
            </tr>
            <tr>
                <td style="padding: 3px;">Марка та модель авто:</td>
                <td style="padding: 3px;">'.$auto.'</td>
            </tr>
            <tr>
                <td style="padding: 3px;">Рік випуску:</td>
                <td style="padding: 3px;">'.$autoyear.'</td>
            </tr>
            <tr>
                <td style="padding: 3px;">VIN-код:</td>
                <td style="padding: 3px;">'.$vin.'</td>
            </tr>
            <tr>
                <td style="padding: 3px;">Номер кузова:</td>
                <td style="padding: 3px;">'.$autobodyno.'</td>
            </tr>
            <tr>
                <td style="padding: 3px;">Примітки щодо замовлення:</td>
                <td style="padding: 3px;">'.$descr.'</td>
            </tr>
        </table>
        <p>Замовлено '.$cur_date.'</p>
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
