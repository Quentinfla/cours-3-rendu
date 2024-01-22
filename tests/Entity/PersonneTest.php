<?php

namespace Tests\Entity;

use App\Entity\Person;
use App\Entity\Wallet;
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
//        $personne = new Person("John Doe", "EUR");
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



}
