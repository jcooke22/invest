<?php
declare(strict_types=1);

namespace Invest;

use Invest\Exception\VirtualWalletInsufficientBalance;

class VirtualWallet
{
    const PRECISION = 2;

    /**
     * @var float
     */
    private $balance = 0.00;

    /**
     * @param float $amount
     *
     * @return VirtualWallet
     */
    public function add(float $amount): self
    {
        $this->balance = (float)bcadd((string)$this->balance, (string)$amount, static::PRECISION);

        return $this;
    }

    /**
     * @param float $amount
     *
     * @return VirtualWallet
     *
     * @throws VirtualWalletInsufficientBalance
     */
    public function subtract(float $amount): self
    {
        if (bccomp(
                (string)bcsub((string)$this->balance, (string)$amount, static::PRECISION),
                (string)0,
                static::PRECISION
            ) === -1
        ) {
            throw new VirtualWalletInsufficientBalance(
                sprintf("Cannot subtract %s from balance %s", $amount, $this->balance)
            );
        }
        $this->balance = (float)bcsub((string)$this->balance, (string)$amount, static::PRECISION);

        return $this;
    }

    /**
     * @return float
     */
    public function balance(): float
    {
        return $this->balance;
    }
}
