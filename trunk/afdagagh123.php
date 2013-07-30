<?
session_start();
header('Content-Type: text/html; charset=utf-8');

include ('mysql.php');

/*
** Функция для генерации соли, используемоей в хешировании пароля
** возращает 3 случайных символа
*/

function GenerateSalt($n=3)
{
	$key = '';
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyz.,*_-=+';
	$counter = strlen($pattern)-1;
	for($i=0; $i<$n; $i++)
	{
		$key .= $pattern{rand(0,$counter)};
	}
	return $key;
}

if (empty($_POST))
{
	?>
	
	<h3>Реєстрація нового адміністратора</h3>
	
	<form action="afdagagh123.php" method="post">
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
				<td></td>
				<td><input type="submit" value="Зареєструватись" /></td>
			</tr>
		</table>
	</form>
	
	
	<?php
}
else
{
	// обрабатывае пришедшие данные функцией mysql_real_escape_string перед вставкой в таблицу БД
	
	$login = (isset($_POST['login'])) ? mysql_real_escape_string($_POST['login']) : '';
	$password = (isset($_POST['password'])) ? mysql_real_escape_string($_POST['password']) : '';
	
	
	// проверяем на наличие ошибок (например, длина логина и пароля)
	
	$error = false;
	$errort = '';
	
	if (strlen($login) < 2)
	{
		$error = true;
		$errort .= 'Длина логина должна быть не менее 2х символов.<br />';
	}
	if (strlen($password) < 6)
	{
		$error = true;
		$errort .= 'Длина пароля должна быть не менее 6 символов.<br />';
	}
	
	// проверяем, если юзер в таблице с таким же логином
	$query = "SELECT `id`
				FROM `users`
				WHERE `login`='{$login}'
				LIMIT 1";
	$sql = mysql_query($query) or die(mysql_error());
	if (mysql_num_rows($sql)==1)
	{
		$error = true;
		$errort .= 'Пользователь с таким логином уже существует в базе данных, введите другой.<br />';
	}
	
	
	// если ошибок нет, то добавляем юзаре в таблицу
	
	if (!$error)
	{
		// генерируем соль и пароль
		
		$salt = GenerateSalt();
		$hashed_password = md5(md5($password) . $salt);
		
		$query = "INSERT
					INTO `users`
					SET
						`login`='{$login}',
						`password`='{$hashed_password}',
						`salt`='{$salt}'";
		$sql = mysql_query($query) or die(mysql_error());
		
		
		print '<h4>Вітаємо, Ви успішно зареєстровані!</h4><a href="login.php">А тепер увійдіть на сайт</a>';
	}
	else
	{
		print '<h4>Помилки</h4>' . $errort . '<a href="afdagagh123.php">Спробувати ще раз</a>';
	}
}

?>

