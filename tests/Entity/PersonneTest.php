<?php

namespace Tests\Entity;

use App\Entity\Person;
use App\Entity\Wallet;
use PHPUnit\Framework\TestCase;

class PersonneTest extends TestCase
{

    public function testPersonne(): void
    {
        $personne = new Person("John Doe", "EUR");
        $this->assertEquals("John Doe", $personne->getName());
        $this->assertEquals("EUR", $personne->getWallet()->getCurrency());
    }

    public function testPersonne2(): void
    {
        $personne = new Person("John Doe", "EUR");
        $personne->setName("Jane Doe");
        $this->assertEquals("Jane Doe", $personne->getName());
    }

    public function testPersonne3(): void
    {
        $personne = new Person("John Doe", "EUR");
        $personne->setWallet(new Wallet("USD"));
        $this->assertEquals("USD", $personne->getWallet()->getCurrency());
    }

    public function testPersonne4(): void
    {
        $personne = new Person("John Doe", "EUR");
        $personne->setWallet(new Wallet("USD"));
        $personne->getWallet()->addFund(100);
        $this->assertEquals(100.0, $personne->getWallet()->getBalance());
    }

    public function testPersonne5(): void
    {
        $personne = new Person("John Doe", "EUR");
        $personne->setWallet(new Wallet("USD"));
        $personne->getWallet()->addFund(100);
        $personne->getWallet()->removeFund(50);
        $this->assertEquals(50.0, $personne->getWallet()->getBalance());
    }



}
