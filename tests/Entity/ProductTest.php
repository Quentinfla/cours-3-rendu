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
        self::$product = new Product("Product 1", ["EUR"=>100.0, "USD"=>200.0], "food");
        self::$product2 = new Product("Product 2", ["EUR", "USD"], "food");
        self::$product3 = new Product("Product 3", ["EUR"=>100.0, "USD"=>200], "food"); // sans type
        self::$product4 = new Product("Product 4", ["EUR"=>100.0, "USD"=>200], "food");
        self::$product5 = new Product("Product 5", ["EUR"=>100.0, "USD"=>200], "tech");
        self::$product6 = new Product("Product 6", ["EUR"=>100.0, "USD"=>200], "tech");


    }

    public function testCreateProductSetTypeError() : void {
        $this->expectException(\TypeError::class);
        $product = new Product("Product 3", ["EUR"=>100.0, "USD"=>200], 1);
    }

    public function testCreateProductSetPricesError() : void {
        $this->expectException(\TypeError::class);
        $product = new Product("Product 3", ["EUR"=>-52, "USD"=>-1], "food");
    }

    public function testCreateProductGetPriceError() : void {
        $this->expectException(\TypeError::class);
        $product = new Product("Product 3", ["YEN"=>100.0], "food");
        $product->getPrice("YEN");
    }

    public function testCreateProductGetPriceErrorCurrencyNotAvalaible() : void {
        $this->expectException(\Exception::class);
        $product = new Product("Product 3", ["EUR"=>100.0], "food");
        $product->getPrice("USD");
    }

    public function testCreateProductNormal() : void {
        $product = new Product("Product 1", ["EUR"=>100.0, "USD"=>200.0], "food");
        $this->assertEquals("Product 1", $product->getName());
        $this->assertEquals(["EUR"=>100.0, "USD"=>200.0], $product->getPrices());
        $this->assertEquals("food", $product->getType());
    }

    public function testGetPriceNormal() : void {
        $this->assertEquals("Product 1", self::$product->getName());
        $this->assertEquals(100.0, self::$product->getPrice("EUR"));
        $this->assertEquals(200.0, self::$product->getPrice("USD"));
        $this->assertEquals("food", self::$product->getType());
    }

    public function testCreateProductSansPrix() : void {
            $this->assertEquals("Product 2", self::$product2->getName());
//            $this->assertEquals([], self::$product2->getPrices());
//            $this->assertNull(self::$product2->getPrices());
            $this->expectException(\Exception::class);
            $this->assertCount(0, self::$product2->getPrices(), 'Prices should be an empty array');
            $this->assertEquals("food", self::$product2->getType());

    }

    public function testCreateProductSansType() : void {
//        $product = new Product("Product 2", [["EUR"=>100], ["USD"=>200]]);
        $this->assertEquals("Product 3", self::$product3->getName());
        $this->assertEquals(100.0, self::$product3->getPrices()[0]);
        $this->assertEquals(200, self::$product3->getPrices()[1]);
//        $this->assertEquals(new \Exception(), self::$product3->getType());
    }

    public function testGetTVAFood() : void {
//        $product = new Product("Product 4", [["EUR"=>100], ["USD"=>200]], "food");
        $this->assertEquals(0.1, self::$product4->getTVA());
    }

    public function testGetTVAOtherType() : void {
//        $product = new Product("Product 4", [["EUR"=>100], ["USD"=>200]], "tech");
        $this->assertEquals(0.2, self::$product5->getTVA());
    }

    // méthode pour tester setPrice
    public function testSetPrices() : void {
//        $product = new Product("Product 5", [["EUR"=>100], ["USD"=>200]], "tech");
        self::$product5->setPrices([["EUR"=>200.0], ["USD"=>300]]);
        $this->assertEquals(200.0, self::$product5->getPrices()[0]);
    }

    public function testGetPrice() : void {
//        $product = new Product("Product 6", [["EUR"=>100], ["USD"=>200]], "tech");
        $this->assertEquals(100.0, self::$product6->getPrice("EUR"));
    }

    public function testListCurrencies() : void {
        $this->assertEquals(["EUR", "USD"], self::$product->listCurrencies());
    }
}
