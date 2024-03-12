<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php
    // Старт сессии
    session_start();

    // Проверка выбранной темы или установка темы по умолчанию
    if (!isset($_SESSION['theme'])) {
        $_SESSION['theme'] = 'Light'; // Тема по умолчанию
    }

    // Выбор соответствующего CSS файла для темы
    $themeCSS = ($_SESSION['theme'] == 'Dark') ? 'dark.css' : (
                 ($_SESSION['theme'] == 'Light') ? 'light.css' : (
                 ($_SESSION['theme'] == 'Pink') ? 'pink.css' : (
                 ($_SESSION['theme'] == 'Purpure') ? 'purpure.css' : 'green.css')));

    echo "<link rel='stylesheet' type='text/css' href='$themeCSS'>";
?>


  
</head>

<body>

    <?php
    // объявляем переменные и устанавливаем пустые значения
    $nameErr = "";
    $name = "";
    $results_displayed = false;
    $correct_ansver = 0;

    function calculateCheckboxPoints($selectedOptions, $correctOptions)
    {
        $correctPoints = +2.5; // Баллы за правильный вариант
        $incorrectPoints = -2.5; // Баллы за неправильный вариант

        // Проверка, что выбран хотя бы один вариант (правильный или неправильный)
        if (count($selectedOptions) > 0) {
            // Подсчет баллов
            $points = 0;
            foreach ($selectedOptions as $option) {
                if (in_array($option, $correctOptions)) {
                    $points += $correctPoints;
                } else {
                    $points += $incorrectPoints;
                }
            }

            // Если общая сумма баллов отрицательна, присвоим 0
            return max(0, $points);
        }

        return 0; // Если ничего не выбрано, возвращаем 0
    }

    // Функция для определения баллов за вопрос с radio
    function calculateRadioPoints($selectedOption, $correctOption)
    {
        $correctPoints = 5; // Баллы за правильный вариант

        // Проверка, что выбран вариант
        if (!empty($selectedOption) && $selectedOption == $correctOption) {
            return $correctPoints;
        }

        return 0; // Если ничего не выбрано или выбран неправильный вариант, возвращаем 0
    }




    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Введите имя";
        } else {
            $name = test_input($_POST["name"]);
            // проверяем, содержит ли имя только буквы и пробелы
            if (!preg_match("/^(([a-zA-Z' -]{3,20})|([а-яА-ЯЁёІіЇїҐґЄє' -]{3,20}))$/u", $name)) {
                $nameErr = "Имя должно содержать только буквы и пробелы";
            }
        }


        // Вычисление баллов для вопросов с checkbox
        $pointsCheckbox = calculateCheckboxPoints($_POST['test5'], ['бамбуковый медведь', 'Морская выдра']);
        $pointsRadio3 = calculateCheckboxPoints($_POST['test6'], ['JavaScript', 'Python', 'Java']);
        $pointsRadio5 = calculateCheckboxPoints($_POST['test4'], ['Мурчание', 'Вылизывание шерсти']);


        // Вычисление баллов для вопросов с radio
        $pointsRadio1 = calculateRadioPoints($_POST['test1'], 'Elephant');
        $pointsRadio2 = calculateRadioPoints($_POST['test2'], 'Snake');
        $pointsRadio4 = calculateRadioPoints($_POST['test3'], 'Indians');



        $totalPoints = $pointsCheckbox + $pointsRadio1 + $pointsRadio2 + $pointsRadio3 + $pointsRadio4 + $pointsRadio5;


        // Store total points in a text file
        $separator = ',';
        file_put_contents("total_points.txt", $totalPoints . $separator, FILE_APPEND);

        // Read all scores from the text file
        $scoresArray = [];
        if (file_exists("total_points.txt")) {
            $scoresString = file_get_contents("total_points.txt");
            $scoresArray = explode($separator, $scoresString, -1);
        }


        // Calculate average score
        $averageScore = count($scoresArray) > 0 ? array_sum($scoresArray) / count($scoresArray) : 0;


        $resultMessage = "";
        if ($totalPoints > $averageScore) {
            $resultMessage = "$name, хороший результат. Средний балл: $averageScore";
        } else {
            $resultMessage = "$name, результат не самый лучший. Средний балл: $averageScore";
        }
    }

    // Проверка выбора темы пользователя и установка переменной сессии
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["theme"])) {
            $_SESSION['theme'] = $_POST["theme"];
        }
    }



    ?>

    <div class="header">
        <h1> Пройти тест </h1>
    </div>
    <br> <br>

    <div class="block">


        <!-- Добавление формы выбора темы -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="theme">Выберите тему:
                <select name="theme">
                    <option value="Dark" <?php if ($_SESSION['theme'] == 'Dark') echo 'selected'; ?>>Dark</option>
                    <option value="Light" <?php if ($_SESSION['theme'] == 'Light') echo 'selected'; ?>>Light</option>
                    <option value="Pink" <?php if ($_SESSION['theme'] == 'Pink') echo 'selected'; ?>>Pink</option>
                    <option value="Purpure" <?php if ($_SESSION['theme'] == 'Purpure') echo 'selected'; ?>>Purpure</option>
                    <option value="Green" <?php if ($_SESSION['theme'] == 'Green') echo 'selected'; ?>>Green</option>
                </select>
                <input type="submit" name="applyTheme" value="Применить">

            </label>
        </form>
        <br>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name"> Имя:
                <input type="text" name="name" value="<?php echo $name; ?>">
                <span class="error">* <?php echo $nameErr; ?></span>
                <br> <br>

            </label>

            <h3>Какие животные занесены в красную книгу ?</h3>
            <div class="group">
                <input type="checkbox" name="test5[]" value="бамбуковый медведь"> - бамбуковый медведь<br>
                <input type="checkbox" name="test5[]" value="Американский журавль"> - Американский журавль<br>
                <input type="checkbox" name="test5[]" value="Слон"> - Слон<br>
                <input type="checkbox" name="test5[]" value="Морская выдра"> - Морская выдра<br>
            </div>

            <h3>Какое животное не умеет чихать ?</h3>
            <div class="group">
                <input type="radio" name="test1" value="Dog"> - Собака<br>
                <input type="radio" name="test1" value="Elephant"> - Слон<br>
                <input type="radio" name="test1" value="Rabbit"> - Кролик<br>
                <input type="radio" name="test1" value="Cat"> - Кошка<br>

            </div>

            <h3>Какое животное видит мир в черно - белых цветах ?</h3>

            <div class="group">
                <input type="radio" name="test2" value="dog"> - Собака<br>
                <input type="radio" name="test2" value="Owl"> - Сова<br>
                <input type="radio" name="test2" value="Cheetah"> - Гепард<br>
                <input type="radio" name="test2" value="Snake"> - Змея<br>
            </div>

            <h3>Топ 3 языка программирования:</h3>
            <div class="group">
                <input type="checkbox" name="test6[]" value="C++"> - C++<br>
                <input type="checkbox" name="test6[]" value="PHP"> - PHP<br>
                <input type="checkbox" name="test6[]" value="JavaScript"> - JavaScript<br>
                <input type="checkbox" name="test6[]" value="Python"> - Python<br>
                <input type="checkbox" name="test6[]" value="Java"> - Java<br>
                <input type="checkbox" name="test6[]" value="C"> - C<br>
            </div>


            <h3>Какому народу приписывается изобретение шахмат ?</h3>

            <div class="group">
                <input type="radio" name="test3" value="Chinese"> - Китайцы<br>
                <input type="radio" name="test3" value="Egyptians"> - Египтяне<br>
                <input type="radio" name="test3" value="Indians"> - Индийцы<br>
                <input type="radio" name="test3" value="Greeks"> - Греки<br>
            </div>


            <h3>Какие действия помогают котам снять сресс ?</h3>

            <div class="group">
                <input type="checkbox" name="test4[]" value="Мурчание"> - Мурчание<br>
                <input type="checkbox" name="test4[]" value="Кушать"> - Кушать<br>
                <input type="checkbox" name="test4[]" value="Вылизывание шерсти"> - Вылизывание шерсти<br>
                <input type="checkbox" name="test4[]" value="Бег"> - Бег<br>
            </div>
            <br>
            <input type="submit" value="Отправить">
        </form>


        <?php

        echo "<p>$resultMessage</p>";
        echo "<p>Total Points: $totalPoints</p>";

        ?>
    </div>



</body>

</html>