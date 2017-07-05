<?php

namespace Invest;

use DateTime;
use Invest\Exception\InvestorInsufficientBalance;
use Invest\Exception\LoanClosed;
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
     * @var DateTime
     */
    private $startDate;

    /**
     * Investment constructor.
     * @param Investor $investor
     * @param Tranche $tranche
     * @param float $amount
     * @param DateTime $startDate
     */
    public function __construct(Investor $investor, Tranche $tranche, float $amount, DateTime $startDate = null)
    {
        try {
            $investor->virtualWallet()->subtract($amount);
        } catch (VirtualWalletInsufficientBalance $e) {
            throw new InvestorInsufficientBalance($e->getMessage());
        }
        
        if (!$tranche->getLoan()->isOpen()) {
            throw new LoanClosed(sprintf('Cannot invest in tranche %s because it is closed', $tranche->name()));
        }
        
        $this->investor = $investor;
        $this->tranche = $tranche;
        $this->amount = $amount;
        $this->startDate = !is_null($startDate) ? $startDate : new DateTime();
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
    
    /**
     * @return DateTime
     */
    public function startDate(): DateTime 
    {
        return $this->startDate;
    }
}
