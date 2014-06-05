<?php
namespace Order\Entities;

class Order {

  /**
   * @var array
   */
  private $products = array();
  
  /**
   * @var string 
   */
  private $total;
  
  /**
   * @param array $products
   */
  public function __construct($total, array $products = array())
  {
    $this->setTotal($total);
    $this->setProducts($products);
  }

  /**
   * @return []Product
   */
  public function getProducts()
  {
    return $this->products;
  }

  /**
   * @param array $products
   */
  public function setProducts(array $products)
  {
    $this->products = $products;
  }

  
  /**
   * @param Product $product
   */
  public function addProduct(Product $product)
  {
    $this->products[] = $product;
  }

  /**
   * @return string
   */
  public function getTotal()
  {
    return $this->total;
  }

  /**
   * @param string $total
   */
  public function setTotal($total)
  {
    $this->total = $total;
  }
  
  /**
   * @param Product $product
   */
  public function remove(Product $product)
  {
    $index = array_search($product, $this->products);
    unset($this->products[$index]);
  }
  
}

