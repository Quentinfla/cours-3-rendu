<?php

namespace Tests\Entity;

use App\Entity\Wallet;
use PHPUnit\Framework\TestCase;

class WalletTest extends TestCase
{

    public function testGetCurrency(): void
    {
        $wallet = new Wallet("EUR");
        $this->assertEquals("EUR", $wallet->getCurrency());
    }

    public function testSetBalance(): void
    {
        $wallet = new Wallet("EUR");
        $wallet->setBalance(100.0);
        $this->assertEquals(100.0, $wallet->getBalance());
    }

    public function testSetCurrency(): void
    {
        $wallet = new Wallet("EUR");
        $wallet->setCurrency("USD");
        $this->assertEquals("USD", $wallet->getCurrency());
    }

    public function testAddFund(): void
    {
        $wallet = new Wallet("EUR");
        $wallet->addFund(100.0);
        $this->assertEquals(100.0, $wallet->getBalance());
    }

    public function testRemoveFund(): void
    {
        $wallet = new Wallet("EUR");
        $wallet->addFund(100.0);
        $wallet->removeFund(50.0);
        $this->assertEquals(50.0, $wallet->getBalance());
    }


}
