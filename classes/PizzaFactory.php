<?php

namespace Classes;

use PDO;

class PizzaFactory extends Pizza
{
    public function getSaucePrice(int $sauce_id):array {

        $this->con->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
        $order = $this->con->prepare("SELECT * FROM bkvwbc_sauce WHERE id = ?");
        $order->execute(array($sauce_id));
        return $order->fetchAll();

    }

    public function Order(int $pizza_id, int $size_id): array
    {

        $this->con->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
        $order = $this->con->prepare("SELECT bkvwbc_pizza.name, bkvwbc_size.size, price_usd FROM bkvwbc_price INNER JOIN bkvwbc_pizza on pizza_id = bkvwbc_pizza.id INNER JOIN bkvwbc_size on size_id = bkvwbc_size.id WHERE pizza_id = ? AND size_id = ?");
        $order->execute(array($pizza_id,$size_id));
        return $order->fetchAll();
    }

}