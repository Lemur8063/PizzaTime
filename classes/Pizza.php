<?php

namespace Classes;

abstract class Pizza
{

    /**
     * Pizza constructor.
     * @param $con
     */
    public function __construct($con)
    {
        $this->con = $con;
    }


    /**
     * @return array
     */
    public function getPizzas(): array
    {
        return $this->con->query('SELECT * FROM `bkvwbc_pizza`')->fetchAll();
    }

    /**
     * @return array
     */
    public function getSizes(): array
    {
        return $this->con->query('SELECT * FROM `bkvwbc_size`')->fetchAll();
    }

    /**
     * @return array
     */
    public function getSauces(): array
    {
        return $this->con->query('SELECT * FROM `bkvwbc_sauce`')->fetchAll();
    }

    abstract public function Order(int $pizza_id, int $size_id):array;

}