<?php

namespace Order\Entities;

class Product
{

    /**
     * @var string 
     */
    private $title;

    /**
     * @var string 
     */
    private $price;

    /**
     * @var array 
     */
    private $category;

    /**
     * 
     * @param string $title
     * @param string $price
     * @param string $category
     */
    public function __construct($title, $price, $category)
    {
        $this->setTitle($title);
        $this->setPrice($price);
        $this->setCategory($category);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

}
