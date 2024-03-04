<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forma</title>
</head>

<body>

    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
        <fieldset>
            <legend>
                Заказ пиццы
            </legend>
            <br>
            <label for="amounght">Количество пицц:</label>
            <input type="number" id="amounght" name="amounght" min="1" value="1" required>
            <br><br>
            <label for="type"> Tип пиццы: </label>
            <select id="type" name="type" required>
                <option value="margarita">Маргарита</option>
                <option value="pepperoni">Пепперони</option>
                <option value="vegetarian">Вегетарианская</option>
            </select>
            <br> <br>
            <label for="pizzaSize">Размер пиццы:</label>
            <select id="pizzaSize" name="pizzaSize" required>
                <option value="small">Маленькая</option>
                <option value="medium">Средняя</option>
                <option value="large">Большая</option>
            </select>
            <br><br>
            <div id="buttons" style="display: flex; flex-direction: row;
gap: 10px; margin-top: 10px;">
                <input type="submit" value="Отправить" />
                <input type="reset" value="Удалить" />
            </div>

        </fieldset>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $amounght = $_POST["amounght"];
        $type = $_POST["type"];
        $pizzaSize = $_POST["pizzaSize"];

        $outputString = "Заказано  $amounght пицц(ы) типа  $type  размером $pizzaSize";

        echo $outputString;
    }

    ?>
</body>

</html>