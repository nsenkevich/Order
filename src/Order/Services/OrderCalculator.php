<?php

namespace Order\Services;

use Order\Entities\Order;

class OrderCalculator
{

    /**
     * @var Order 
     */
    private $order;

    const PRODUCT_AMOUNT_2_FOR_3 = 3;
    const PRODUCT_AMOUNT_50_OFF = 2;
    const PRODUCT_CATEGORY_SHAMPOO = 'Shampoo';
    const PRODUCT_CATEGORY_CONDITIONER = 'Conditioner';

    /**
     * @param Order $order
     */
    public function __construct(Order $order = NULL)
    {
        $this->order = $order;
    }

    /**
     * @todo refactor
     * @return boolean|Order
     */
    public function applyPromotio2for3()
    {
        $products = $this->order->getProducts();

        if (count($products) < self::PRODUCT_AMOUNT_2_FOR_3) {
            return FALSE;
        }

        //get number discounts
        $numberDiscounts = floor(count($products) / self::PRODUCT_AMOUNT_2_FOR_3);

        //sort object by lowest price
        uasort($products, function($a, $b) {
            return strcmp($a->getPrice(), $b->getPrice());
        });

        //apply discounts
        for ($index = 0; $index < $numberDiscounts; $index++) {
            $products[$index]->setPrice(0);
        }

        //recalculate total
        $total = 0;
        foreach ($products as $product) {
            $total += $product->getPrice();
        }

        $this->order->setTotal($total);
        return $this->order;
    }

    /**
     * @todo refactor
     * @return boolean
     */
    public function applyPromotio50off()
    {
        $products = $this->order->getProducts();

        if (count($products) < self::PRODUCT_AMOUNT_50_OFF) {
            return FALSE;
        }

        $conditioner = array();
        $shampoo = array();
        $default = array();
        foreach ($products as $product) {
            switch ($product->getCategory()->getName()) {
                case self::PRODUCT_CATEGORY_SHAMPOO:
                    $shampoo[] = $product;
                    break;
                case self::PRODUCT_CATEGORY_CONDITIONER:
                    $conditioner[] = $product;
                    break;
                default:
                    $default[] = $product;
                    break;
            }
        }

        // get lovest value if 2 shamp. and 3 cond. get 2 if 3 shamp. and 2 cond. get 2
        $numberDiscounts = min(count($shampoo), count($conditioner));

        //discount
        for ($index = 0; $index < $numberDiscounts; $index++) {
            $productToDiscount = $conditioner[$index];
            $discountedPrice = round($productToDiscount->getPrice() / 2, 2);
            $productToDiscount->setPrice($discountedPrice);
        }

        //get all products
        $productsDiscounted = array_merge($shampoo, $default, $conditioner);

        //recalculate total
        $total = 0;
        foreach ($productsDiscounted as $product) {
            $total += $product->getPrice();
        }

        $this->order->setTotal($total);
        return $this->order;
    }

    /**
     * @param Order $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

}
