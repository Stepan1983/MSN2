Теперь при авторизации пользователя в $_SESSION['status'] запишем статус пользователя из базы данных:

<?php
	if (password_verify($_POST['password'], $hash)) {
		$_SESSION['auth'] = true;
		$_SESSION['id'] = $user['id'];
		$_SESSION['status'] = $user['status']; // записываем статус
	}
?>

Пусть теперь у нас на сайте есть какая-то страница, к который имеют доступ только админы. Сделаем так, чтобы только админы видели контент этой страницы:

<?php
	if (!empty($_SESSION['auth']) and $_SESSION['status'] === 'admin') {
		// покажем контент страницы только админам
	}
?>

Также нам необходимо внести изменения в нашу регистрацию. Теперь при регистрации пользователя мы должны в INSERT запросе указывать его статус.

При начальной регистрации все пользователи нашего сайта получают самый низший статус, то есть в нашем случае 'user':

<?php
	$query = "INSERT INTO users
		SET login='$login', password='$password', 'status'='user'";
?>
Статусы повыше раздает администратор. Он в админке видит список пользователей и может любого сделать, к примеру, администратором.

Как на сайте в таком случае появится первый администратор? Вариант следующий: зарегистрировать обычного пользователя и через PhpMyAdmin сделать его админом.


Сейчас мы храним статусы наших пользователей в той же таблице, где и самих пользователей. Это, однако, неправильно - у нас получается не нормализованная таблица, ведь слова 'user' и 'admin' повторяются много раз.

Необходимо выполнить нормализацию - вынесем наши статусы в отдельную таблицу statuses:

id	name
1	user
2	admin
А в таблице users сделаем колонку status_id. Теперь при регистрации мы в колонку status_id будем записывать id статуса из таблицы statuses:

<?php
	$query = "INSERT INTO users
		SET login='$login', password='$password', status_id='1'";
?>
Самые сложные изменения произойдут при авторизации: для того, чтобы получить статус пользователя, нужно будет выполнить LEFT JOIN:

<?php
	$login = $_POST['login'];
	
	// Получаем юзера по логину и джойним статус:
	$query = "SELECT *, statuses.name as status FROM users
		LEFT JOIN statuses
	ON users.status_id=statuses.id WHERE login='$login'";
	
	$result = mysqli_query($link, $query);
	$user = mysqli_fetch_assoc($result);
	
	if (!empty($user)) {
		$hash = $user['password'];
		
		if (password_verify($_POST['password'], $hash)) {
			$_SESSION['auth'] = true;
			$_SESSION['status'] = $user['status']; // статус
		} else {
			
		}
	} else {
		
	}
?>