<?php

namespace Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    protected static $product;
    protected static $product2;
    protected static $product3;
    protected static $product4;
    protected static $product5;
    protected static $product6;

    public static function setUpBeforeClass(): void
    {
        self::$product = new Product("Product 1", [["EUR"=>100], ["USD"=>200]], "food");
        self::$product2 = new Product("Product 2", [["EUR"=>100], ["USD"=>200]], "food");
        self::$product3 = new Product("Product 3", [["EUR"=>100], ["USD"=>200]], "food");
        self::$product4 = new Product("Product 4", [["EUR"=>100], ["USD"=>200]], "food");
        self::$product5 = new Product("Product 5", [["EUR"=>100], ["USD"=>200]], "food");
        self::$product6 = new Product("Product 6", [["EUR"=>100], ["USD"=>200]], "food");
    }

    public function testCreateProductNormal() : void {
        $product = new Product("Product 2", [["EUR"=>100], ["USD"=>200]], "food");
        $this->assertEquals("Product 2", $product->getName());
        $this->assertEquals(100, $product->getPrices()[0]);
        $this->assertEquals(200, $product->getPrices()[1]);
        $this->assertEquals("food", $product->getType());
    }

    public function testCreateProductSansPrix() : void {
        $product = new Product("Product 2", [["EUR"], ["USD"]], "food");
        $this->assertEquals("Product 2", $product->getName());
        $this->assertEquals([], $product->getPrices());
        $this->assertEquals("food", $product->getType());
    }

    public function testCreateProductSansType() : void {
        $product = new Product("Product 2", [["EUR"=>100], ["USD"=>200]]);
        $this->assertEquals("Product 2", $product->getName());
        $this->assertEquals(100, $product->getPrices()[0]);
        $this->assertEquals(200, $product->getPrices()[1]);
        $this->assertEquals("other", $product->getType());
    }

    public function testGetTVAFood() : void {
        $product = new Product("Product 3", [["EUR"=>100], ["USD"=>200]], "food");
        $this->assertEquals(0.1, $product->getTVA());
    }

    public function testGetTVAOtherType() : void {
        $product = new Product("Product 4", [["EUR"=>100], ["USD"=>200]], "tech");
        $this->assertEquals(0.2, $product->getTVA());
    }

    // méthode pour tester setPrice
    public function testSetPrices() : void {
        $product = new Product("Product 5", [["EUR"=>100], ["USD"=>200]], "tech");
        $product->setPrices([["EUR"=>200], ["USD"=>300]]);
        $this->assertEquals(300, $product->getPrices()[0]);
    }

    public function testGetPrice() : void {
        $product = new Product("Product 6", [["EUR"=>100], ["USD"=>200]], "tech");
        $this->assertEquals(100.0, $product->getPrice("EUR"));
    }
}
