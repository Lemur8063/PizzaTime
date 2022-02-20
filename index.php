<?php

namespace Classes;


require_once 'vendor/autoload.php';


$db = Db::getInstance();
$con = $db->getConnection();

$pizza = new PizzaFactory($con);
$pizzas = $pizza->getPizzas();
$sizes = $pizza->getSizes();
$sauces = $pizza->getSauces();

?>


<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pizza Time</title>
</head>
<style>
    #success {
        display: none;
        flex-direction: column;
        border: 1px solid black;
        padding: 10px;
        width: 180px;
        margin-top: 10px;
    }

    #success span:not(:last-child) {
        margin-bottom: 5px;
    }

    #success span:first-child {
        text-align: center;
        font-size: 20px;
    }

</style>
<body>

<form id="checkout" action="" method="">
    <select name="pizza">
        <?php foreach ($pizzas as $pizza) { ?>

            <option value="<?php echo $pizza['id'] ?>"><?php echo $pizza['name'] ?></option>

        <?php } ?>

    </select>
    <select name="size">
        <?php foreach ($sizes as $size) { ?>

            <option value="<?php echo $size['id'] ?>"><?php echo $size['size'] . ' см.' ?></option>

        <?php } ?>
    </select>
    <select name="sauce">
        <?php foreach ($sauces as $sauce) { ?>

            <option value="<?php echo $sauce['id'] ?>"><?php echo $sauce['name'] ?></option>

        <?php } ?>
    </select>
    <input type="submit" value="Заказать">

    <div id="success"></div>
    <div id="error"></div>

</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {

        $('#checkout').submit(function (e) {

            let data = {};
            e.preventDefault();
            let $form = $(this);
            $form.find('select').each(function () {
                data[this.name] = $(this).val();
            });
            $.ajax({
                url: 'send.php',
                type: "POST",
                dataType: "json",
                data: $form.serialize(),
                success: function (response) {
                    $("#success").html(response.result);
                    if (response.status === "ок") {
                        let result = JSON.parse(JSON.stringify(response));
                        $('#success').html(result.message).css('display', 'flex');
                    }
                },
                error: function () {
                    $('#error').html('Ошибка');
                },
            });
        })
    })
</script>

</body>
</html>