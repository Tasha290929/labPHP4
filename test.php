<h3>Ваше имя?</h3>
<form action='server.php' method='POST'>
   <input name='name' class = "<?php echo $class_name?>" placeholder='Введите имя' value="<?php if(isset($_POST['name'])) echo $_POST['name2'] ?>">
   <input type='hidden' name='checkbox' value='0'>
   <input type='checkbox' name='checkbox' value='1'> 
   <button type='submit' value='1'>Click Me!</button>
</form>
<h3>бывали ли Вы в Италии?</h3>
<form action='server.php' method='POST'>
   <input type='radio' name='lang' value='Да' id ='yes' checked> <!-- отмеченная кнопка -->
   <label for='yes'>Да</label>
   <input type='radio' name='lang' value='Нет' id ='no'> 
   <label for='no'>Нет</label>
   <button type='submit' value='1'>Click Me!</button>
</form>
<h3>Ваше образование?</h3>
<form action='server.php' method='POST'>
   <input type='radio' name='education' value='среднее' id ='average'> 
   <label for='no'>среднее</label>
   <input type='radio' name='education' value='высшее' id ='higher'> 
   <label for='no'>высшее</label>
   <input type='radio' name='education' value='незаконченное высшее' id ='incomplete'> 
   <label for='no'>незаконченное высшее</label>
   <button type='submit' value='1'>Click Me!</button>
</form>
<h3>Ваш пол?</h3>
<form action='server.php' method='POST'>
	<select name='sex'>
		<option value='1'>Муж</option>
		<option value='2'>Жен</option>
	</select>
	<button type='submit' value='1'>Click Me!</button>
</form>
<?php //SERVER.php--в файле сервер
 /*Спросите у пользователя имя с помощью формы. Сделайте чекбокс: если он отмечен, то поприветствуйте пользователя, если не отмечен - попрощайтесь с пользователем. 
Спросите у пользователя бывал ли он в Италии c помощью двух radio-кнопок. Выведите результат на экран. Сделайте так, чтобы по умолчанию один из вариантов был уже отмечен.
Спросите у пользователя его образование с помощью нескольких radio-кнопок. Варианты ответа сделайте такими: среднее, высшее, незаконченное высшее
  
Спросите у пользователя его образование с помощью выпадающего списка. Варианты ответа сделайте такими: среднее, высшее, незаконченное высшее
  
Спросите у пользователя его пол используя выпадающий список.
*/
if($_POST['checkbox']=='1') {
      echo 'Привет,  '.$_POST['name'].'<br>';
    }
if($_POST['checkbox']=='0'){
  echo 'Пока,  '.$_POST['name'].'<br>';
  }

$lang = $_POST['lang'];
echo $lang.'<br>';

$education = $_POST['education'];
echo $education.'<br>';

$sex = $_POST['sex'];
echo $sex.'<br>';
?>
<form action='Php5Tasks.php' method='POST' enctype="multipart/form-data">
  <input type="submit" value="Главная">
</form>