<?php

session_start();
header('Content-Type: text/html; charset=utf-8');

include ('mysql.php');

if (isset($_GET['logout']))
{
	if (isset($_SESSION['user_id']))
		unset($_SESSION['user_id']);
		
	setcookie('login', '', 0, "/");
	setcookie('password', '', 0, "/");
	echo '<h1>Ви успішно вийшли</h1><a href="login.php">увійти знову</a><br/><a href="index.php">перейти на головну сторінку сайту</a>';
	exit;
}

if (isset($_SESSION['user_id']))
{
	// юзер уже залогинен, перекидываем его отсюда на закрытую страницу
	
	echo '<h1>Ви уже увійшли на сайт</h1><a href="promoeditor.php">приступити до адміністрування</a><br/><a href="login.php?logout">вийти</a>';
	exit;

}



if (!empty($_POST))
{
	$login = (isset($_POST['login'])) ? mysql_real_escape_string($_POST['login']) : '';
	
	$query = "SELECT `salt`
				FROM `users`
				WHERE `login`='{$login}'
				LIMIT 1";
	$sql = mysql_query($query) or die(mysql_error());
	
	if (mysql_num_rows($sql) == 1)
	{
		$row = mysql_fetch_assoc($sql);
		
		// итак, вот она соль, соответствующая этому логину:
		$salt = $row['salt'];
		
		// теперь хешируем введенный пароль как надо и повторям шаги, которые были описаны выше:
		$password = md5(md5($_POST['password']) . $salt);
		
		// и пошло поехало...

		// делаем запрос к БД
		// и ищем юзера с таким логином и паролем

		$query = "SELECT `id`
					FROM `users`
					WHERE `login`='{$login}' AND `password`='{$password}'
					LIMIT 1";
		$sql = mysql_query($query) or die(mysql_error());

		// если такой пользователь нашелся
		if (mysql_num_rows($sql) == 1)
		{
			// то мы ставим об этом метку в сессии (допустим мы будем ставить ID пользователя)

			$row = mysql_fetch_assoc($sql);
			$_SESSION['user_id'] = $row['id'];
			
			
			// если пользователь решил "запомнить себя"
			// то ставим ему в куку логин с хешем пароля
			
			$time = 86400; // ставим куку на 24 часа
			
			if (isset($_POST['remember']))
			{
				setcookie('login', $login, time()+$time, "/");
				setcookie('password', $password, time()+$time, "/");
			}
			
			// и перекидываем его на закрытую страницу
			echo '<h1>Вітаємо! Ви успішно увійшли на сайт.</h1><a href="promoeditor.php">приступити до адміністрування</a><br/><a href="login.php?logout">вийти</a>';
			exit;

			// не забываем, что для работы с сессионными данными, у нас в каждом скрипте должно присутствовать session_start();
		}
		else
		{
			die('невірний пароль <a href="login.php">Увійти ще раз</a>');
		}
	}
	else
	{
		die('користувач не знайдений в базі даних <a href="login.php">Увійти ще раз</a>');
	}
}

print '
<form action="login.php" method="post">
	<table>
		<tr>
			<td>Логін:</td>
			<td><input type="text" name="login" /></td>
		</tr>
		<tr>
			<td>Пароль:</td>
			<td><input type="password" name="password" /></td>
		</tr>
		<tr>
			<td>Запам&apos;ятати:</td>
			<td><input type="checkbox" name="remember" checked/></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Вхід" /></td>
		</tr>
	</table>
</form>
';

?>
<!-- Login Admin content template -->