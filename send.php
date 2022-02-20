<?php

namespace Classes;

require_once 'vendor/autoload.php';

if (isset($_POST['pizza']) && isset($_POST['size']) && isset($_POST['sauce'])) {

    $msg_box = "";
    $status = "";
    $errors = array();
    if ($_POST['pizza'] == "") $errors[] = "Пустое поле Pizza";
    if ($_POST['size'] == "") $errors[] = "Пустое поле Size";
    if ($_POST['sauce'] == "") $errors[] = "Пустое поле Sauce";


    if (empty($errors)) {


        $db = Db::getInstance();
        $con = $db->getConnection();

        $pizza = new PizzaFactory($con);
        $order = $pizza->Order($_POST['pizza'], $_POST['size']);
        $saucePrice = $pizza->getSaucePrice($_POST['sauce']);
        $pizzaPrice = $order[0]['price_usd'];
        $priceCalculate = new PriceCalculate();
        $priceCalculate->saucePrice = $saucePrice[0]['price_usd'];
        $priceCalculate->pizzaPrice = $pizzaPrice;
        $priceCalculate->calculatePrice();
        $orderPrice = $priceCalculate->convertPrice();


        $msg_box = "<span>Ваш чек:</span><span>Пицца: " . $order[0]['name'] . "</span><span>Размер: " . $order[0]['size'] . "</span><span>Соус: " . $saucePrice[0]['name'] . "</span><span>Итоговая сумма: " . $orderPrice . "</span>";
        $status = "ок";
    } else {
        $msg_box = "";
        $status = "no";
        foreach ($errors as $error) {
            $msg_box .= "<style>.messages{margin-bottom: 20px;}</style><span style='color: red;'>$error</span><br>";
        }
    }
    echo json_encode(array(
        'result' => $msg_box,
        'status' => $status
    ));

}