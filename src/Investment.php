<?php

namespace Invest;

use Invest\Exception\InvestorInsufficientBalance;
use Invest\Exception\VirtualWalletInsufficientBalance;

class Investment
{
    /**
     * @var Investor
     */
    private $investor;
    
    /**
     * @var Tranche
     */
    private $tranche;
    
    /**
     * @var float
     */
    private $amount;

    /**
     * Investment constructor.
     * @param Investor $investor
     * @param Tranche $tranche
     * @param float $amount
     * 
     * @throws InvestorInsufficientBalance
     */
    public function __construct(Investor $investor, Tranche $tranche, float $amount)
    {
        try {
            $investor->virtualWallet()->subtract($amount);
        } catch (VirtualWalletInsufficientBalance $e) {
            throw new InvestorInsufficientBalance($e->getMessage());
        }
        $this->investor = $investor;
        $this->tranche = $tranche;
        $this->amount = $amount;
    }

    /**
     * @return Investor
     */
    public function investor(): Investor
    {
        return $this->investor;
    }

    /**
     * @return Tranche
     */
    public function tranche(): Tranche
    {
        return $this->tranche;
    }

    /**
     * @return float
     */
    public function amount(): float 
    {
        return $this->amount;
    }
}
