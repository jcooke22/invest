<?php

namespace Invest;

use DateTime;

/**
 * Class Loan
 */
class Loan
{
    /**
     * @var DateTime
     */
    private $startDate;
    
    /**
     * @var DateTime
     */
    private $endDate;

    /**
     * @var TrancheInterface[]
     */
    private $tranches;
    

    /**
     * Loan constructor.
     * @param DateTime $startDate
     * @param DateTime $endDate
     */
    public function __construct(DateTime $startDate, DateTime $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return DateTime
     */
    public function startDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @return DateTime
     */
    public function endDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * @param $tranche
     * 
     * @return void
     */
    public function addTranche(TrancheInterface $tranche)
    {
        $this->tranches[] = $tranche;
    }

    /**
     * @return array
     */
    public function getTranches(): array
    {
        return $this->tranches;
    }

    /**
     * @return bool
     */
    public function isOpen(): bool
    {
        return time() >= $this->startDate->getTimestamp() && time() <= $this->endDate->getTimestamp();
    }
}
