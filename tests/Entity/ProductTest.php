<?php

namespace Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testproduct1() : void {
        $product = new Product("Product 1", [100], "food");
        $this->assertEquals("Product 1", $product->getName());
        $this->assertEquals(100.0, $product->getPrices()[0]);
        $this->assertEquals("food", $product->getType());
    }

    public function testproduct2() : void {
        $product = new Product("Product 2", [100, 200], "food");
        $this->assertEquals("Product 2", $product->getName());
        $this->assertEquals(100, $product->getPrices()[0]);
        $this->assertEquals(200, $product->getPrices()[1]);
        $this->assertEquals("food", $product->getType());
    }

    // récupérer la tva d'un produit de type nourriture
    public function testproduct3() : void {
        $product = new Product("Product 3", [100, 200], "food");
        $this->assertEquals(0.1, $product->getTVA());
    }

    // récupérer la tva d'un produit d'un autre type
    public function testproduct4() : void {
        $product = new Product("Product 4", [100, 200], "tech");
        $this->assertEquals(0.2, $product->getTVA());
    }
}
