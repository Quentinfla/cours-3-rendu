<?php

namespace Tests\Entity;

use App\Entity\Person;
use App\Entity\Wallet;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class PersonneTest extends TestCase
{

    protected static $personne;
    protected static $personne2;
    protected static $personne3;

    public static function setUpBeforeClass(): void
    {
        self::$personne = new Person("John Doe", "EUR");
        self::$personne2 = new Person("Jane Doe", "EUR");
        self::$personne3 = new Person("John Doe", "USD");
    }

    public function testGetCurrencyPersonne(): void
    {
        $this->assertEquals("John Doe", self::$personne->getName());
        $this->assertEquals("EUR", self::$personne->getWallet()->getCurrency());
    }

    public function testSetNamePersonne(): void
    {
        self::$personne->setName("Jane Doe");
        $this->assertEquals("Jane Doe", self::$personne->getName());
    }

    public function testSetWalletPersonne(): void
    {
        $personne = new Person("John Doe", "EUR");
        $personne->setWallet(new Wallet("USD"));
        $this->assertEquals("USD", $personne->getWallet()->getCurrency());
    }

    public function testAddFundPersonne(): void
    {
        $personne = new Person("John Doe", "EUR");
        $personne->setWallet(new Wallet("USD"));
        $personne->getWallet()->addFund(100);
        $this->assertEquals(100.0, $personne->getWallet()->getBalance());
    }

    public function testRemoveFundPersonne(): void
    {
        $personne = new Person("John Doe", "EUR");
        $personne->setWallet(new Wallet("USD"));
        $personne->getWallet()->addFund(100);
        $personne->getWallet()->removeFund(50);
        $this->assertEquals(50.0, $personne->getWallet()->getBalance());
    }

    public function testHasFund(): void
    {
        $this->assertFalse(self::$personne->hasFund());
        self::$personne->getWallet()->addFund(50);
        $this->assertTrue(self::$personne->hasFund());
    }

    /**
     * @throws \Exception
     */
    public function testTransfertFund(): void
    {
        self::$personne->getWallet()->addFund(100);
        self::$personne2->getWallet()->addFund(50);

        self::$personne->transfertFund(30, self::$personne2);

        $this->assertEquals(70.0, self::$personne->getWallet()->getBalance());
        $this->assertEquals(80.0, self::$personne2->getWallet()->getBalance());
    }

    public function testTransfertFundDifferentCurrencies(): void
    {
        $this->expectException(\Exception::class);
        self::$personne->transfertFund(30, self::$personne3);
    }

    public function testDivideWallet(): void
    {
        self::$personne->getWallet()->addFund(100);
        self::$personne2->getWallet()->addFund(50);

        self::$personne->divideWallet([self::$personne, self::$personne2]);

        $this->assertEquals(75.0, self::$personne->getWallet()->getBalance());
        $this->assertEquals(75.0, self::$personne2->getWallet()->getBalance());
    }

    public function testBuyProduct(): void
    {
        $product = new Product("Laptop", ["EUR" => 800], "tech");

        self::$personne->getWallet()->addFund(1000);
        self::$personne->buyProduct($product);

        $this->assertEquals(200.0, self::$personne->getWallet()->getBalance());
    }

    public function testBuyProductInvalidCurrency(): void
    {
        $this->expectException(\Exception::class);
        $product = new Product("Laptop", ["USD" => 800], "tech");

        self::$personne->getWallet()->addFund(1000);
        self::$personne->buyProduct($product);
    }
}
