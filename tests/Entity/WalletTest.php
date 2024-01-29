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

    /**
     * @throws \Exception
     */
    public function testSetBalance(): void
    {
        $wallet = new Wallet("EUR");
        $wallet->setBalance(100.0);
        $this->assertEquals(100.0, $wallet->getBalance());
    }

    /**
     * @throws \Exception
     */
    public function testSetCurrency(): void
    {
        $wallet = new Wallet("EUR");
        $wallet->setCurrency("USD");
        $this->assertEquals("USD", $wallet->getCurrency());
    }

    /**
     * @throws \Exception
     */
    public function testAddFund(): void
    {
        $wallet = new Wallet("EUR");
        $wallet->addFund(100.0);
        $this->assertEquals(100.0, $wallet->getBalance());
    }

    /**
     * @throws \Exception
     */
    public function testRemoveFund(): void
    {
        $wallet = new Wallet("EUR");
        $wallet->addFund(100.0);
        $wallet->removeFund(50.0);
        $this->assertEquals(50.0, $wallet->getBalance());
    }

    public function testInvalidBalance(): void
    {
        $this->expectException(\Exception::class);
        $wallet = new Wallet("EUR");
        $wallet->setBalance(-10.0);
    }

    public function testInvalidCurrency(): void
    {
        $this->expectException(\Exception::class);
        $wallet = new Wallet("EUR");
        $wallet->setCurrency("GBP");
    }

    public function testRemoveInvalidFund(): void
    {
        $this->expectException(\Exception::class);
        $wallet = new Wallet("EUR");
        $wallet->removeFund(50.0);
    }

    public function testAddInvalidFund(): void
    {
        $this->expectException(\Exception::class);
        $wallet = new Wallet("EUR");
        $wallet->addFund(-50.0);
    }

    public function testRemoveInvalidFundException(): void
    {
        $this->expectException(\Exception::class);
        $wallet = new Wallet("EUR");
        $wallet->removeFund(-50.0);
    }


}
