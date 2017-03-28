
<html>
    <head>
        <meta charset="utf-8">
    <title>Регистрация</title>
    </head>
    <body>
   <div align="center"><h2>Регистрация на сайте</h2>
    <form action="reg.php" method="post">
    <!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
<p>
    <label>Ваш логин:<br></label>
    <input name="login2" type="text" size="15" maxlength="15">
    </p>
<!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->
<p>
    <label>Ваш пароль:<br></label>
    <input name="password2" type="password" size="15" maxlength="15">
    </p>
<!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** --> 
<p>
    <input type="submit" name="submit2" value="Зарегистрироваться">
<!--**** Кнопочка (type="submit") отправляет данные на страничку save_user.php ***** --> 
</p></form>
    </body>
    </html>
    
   
    <?php $connection = mysqli_connect('localhost', 'root', '', 'sql') or die(mysqli_error()); ?>
<?php if (isset($_POST['submit2'])) // Отлавливаем нажатие на кнопку отправить 
{
if (empty($_POST['login2']))  // Условие - если поле логин пустое
{
echo "<script>alert('Поле логин не заполненно');</script>"; // Выводим сообщение об ошибке
}          
elseif (empty($_POST['password2'])) // Иначе если поле с паролем пустое
{
echo "<script>alert('Поле логин не заполненно');</script>"; // Выводим сообщение об ошибке
}                      
else // Иначе если поля не пустые
{
$login2 = $_POST['login2']; // Присваиваем переменной значение из поля с логином             
$password2 = $_POST['password2']; // Присваиваем другой переменной значение из поля с паролем
$query = "INSERT INTO `users` (login, password) VALUES ('$login2', '$password2')"; // Создаем переменную с запросом к базе данных на отправку нового юзера
$result = mysqli_query($connection, $query) or die(mysql_error()); // Отправляем переменную с запросом в базу данных 
echo "<div align='center'>Регистрация прошла успешно!</div>"; // Сообщаем что все получилось
}
} ?>