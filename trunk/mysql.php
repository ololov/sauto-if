<?php

    mysql_connect("localhost", "sauto_web", "9731") or die (mysql_error());
    mysql_select_db("sauto_sauto") or die (mysql_error());

    mysql_query("set character_set_client	='utf8'");
    mysql_query("set character_set_results	='utf8'");
    mysql_query("set collation_connection	='utf8_general_ci'");
	
	
	// ���� ������� ��������� ��������������� �������� �� ������
	// http://phpfaq.ru/slashes
	
    function slashes(&$el)
	{
		if (is_array($el))
			foreach($el as $k=>$v)
				slashes($el[$k]);
		else $el = stripslashes($el); 
    }
	
	if (ini_get('magic_quotes_gpc'))
	{
	    slashes($_GET);
	    slashes($_POST);    
	    slashes($_COOKIE);
	}



?>