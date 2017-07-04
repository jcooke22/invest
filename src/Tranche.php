<?php
declare(strict_types=1);

namespace Invest;

class Tranche
{
    /**
     * @var string
     */
    private $name;
    
    /**
     * @var float
     */
    private $monthlyInterestRate;
    
    /**
     * @var float
     */
    private $maximumInvestmentAmount;
    
    /**
     * @var Loan
     */
    private $loan;

    /**
     * Tranche constructor.
     * @param string $name
     * @param float $monthlyInterestRate
     * @param float $maximumInvestmentAmount
     */
    public function __construct(string $name, float $monthlyInterestRate, float $maximumInvestmentAmount)
    {
        $this->name = $name;
        $this->monthlyInterestRate = $monthlyInterestRate;
        $this->maximumInvestmentAmount = $maximumInvestmentAmount;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function monthlyInterestRate(): float
    {
        return $this->monthlyInterestRate;
    }

    /**
     * @return float
     */
    public function maximumInvestmentAmount(): float 
    {
        return $this->maximumInvestmentAmount;
    }

    /**
     * @param Loan $loan
     */
    public function setLoan(Loan $loan)
    {
        $this->loan = $loan;
    }

    /**
     * @return Loan
     */
    public function getLoan()
    {
        return $this->loan;
    }
}
