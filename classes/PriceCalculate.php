<?php

namespace Classes;

use Interfaces\calculateInterface;

class  PriceCalculate implements calculateInterface {

    /**
     * @var string
     */
    private string $api = 'https://www.nbrb.by/api/exrates/rates/';

    /**
     * currency code to receive by api
     * @var int
     */
    public int $currencyCode = 431;
    /**
     * @var float
     */
    public float $pizzaPrice;

    /**
     * @param $price
     * @return float
     */

    public float $saucePrice;

    protected float $orderPrice;

    /**
     * @return float
     */
    public function calculatePrice(): float
    {
        return $this->orderPrice = $this->pizzaPrice + $this->saucePrice;
    }

    public function convertPrice(): float
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api.$this->currencyCode);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = json_decode(curl_exec($ch), $assoc=true);
        curl_close($ch);
        $price = $data['Cur_OfficialRate'];
        return $this->orderPrice = round($this->orderPrice = $this->orderPrice * $price,2);
    }

}