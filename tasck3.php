<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>task3</title>
    <style>
        form {
            border-radius: 15px;
        }
    </style>

</head>

<body>

    <form>
        <fieldset>
            <legend>
                <h2> # Write comment</h2>
            </legend>
            <label name="name"> Name:
                <input type="text" name="name">
                <br> <br>
            <label name ="email"> Mail:
                <input type="email" name="email" >
            </label>
            <br> <br>
            <div id="message_info">
                <div>
                    <p><label for="comment">Ваш комментарий: </label></p>
                    <textarea id="comment" name="comment" cols="30" rows="10" class="comment"><?php echo isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : ''; ?></textarea>
                </div>
            </div>
            <label name="sel"> <input type="checkbox" name="sel"> Do you agree with data processing?</label>

            <div id="buttons" style="display: flex; flex-direction: row;
gap: 20px; margin-top: 10px;">
                <input type="submit" value="send" />
               
            </div>
        </fieldset>

    </form>


</body>

</html>