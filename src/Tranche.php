<?php
declare(strict_types=1);

namespace Invest;

class Tranche implements TrancheInterface
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
}
