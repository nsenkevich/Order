<?php

namespace Order\Entities;

use Order\Utils\XmlElement;
use Order\Entities\Order;

class OrderFactory
{

    /**
     * @param XmlElement $xml
     * @return Order
     */
    public function create(XmlElement $xml)
    {
        $order = new Order($xml->getValue('total'));
        $xmlProducts = $xml->products;
        foreach ($xmlProducts->product as $xmlProduct) {
            $product = new Product(
                (string) $xmlProduct->attributes()->title, (string) $xmlProduct->attributes()->price, new Category($xmlProduct->getValue('category'))
            );
            $order->addProduct($product);
        }

        return $order;
    }

}
