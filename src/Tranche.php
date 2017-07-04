<?php
declare(strict_types=1);

namespace Invest;

use Invest\Exception\InvestmentAmountTooLarge;

class Tranche
{
    const PRECISION = 2;

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
     * @var Investment[]
     */
    private $investments = [];

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

    /**
     * @param Investment $investment
     *
     * @return void
     * 
     * @throws InvestmentAmountTooLarge
     */
    public function addInvestment(Investment $investment)
    {
        $this->validateInvestmentDoesNotBreachMax($investment);
        $this->investments[] = $investment;
    }

    /**
     * @return Investment[]
     */
    public function getInvestments()
    {
        return $this->investments;
    }

    /**
     * @param Investment $investment
     *
     * @return void
     *
     * @throws InvestmentAmountTooLarge
     */
    private function validateInvestmentDoesNotBreachMax(Investment $investment)
    {
        if (bccomp(
                bcadd((string)$this->getTotalInvestmentAmount(), (string)$investment->amount(), static::PRECISION),
                (string)$this->maximumInvestmentAmount,
                static::PRECISION
            ) === 1
        ) {
            throw new InvestmentAmountTooLarge("Investment breached maximum amount");
        }
    }

    /**
     * @return float
     */
    public function getTotalInvestmentAmount(): float
    {
        $totalInvestmentAmount = 0;
        foreach ($this->investments as $investment) {
            $totalInvestmentAmount = bcadd(
                (string)$totalInvestmentAmount,
                (string)$investment->amount(),
                static::PRECISION
            );
        }

        return (float)$totalInvestmentAmount;
    }

}
