<?php
declare(strict_types=1);

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
     * @var Tranche[]
     */
    private $tranches;
    
    /**
     * @var DateTime|null
     */
    private $currentTimeOverride;

    /**
     * Loan constructor.
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param DateTime|null $currentTimeOverride
     */
    public function __construct(DateTime $startDate, DateTime $endDate, DateTime $currentTimeOverride = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->currentTimeOverride = $currentTimeOverride;
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
    public function addTranche(Tranche $tranche)
    {
        $this->tranches[] = $tranche;
        $tranche->setLoan($this);
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
        $currentTime = !is_null($this->currentTimeOverride) ? $this->currentTimeOverride->getTimestamp() : time();
        return $currentTime >= $this->startDate->getTimestamp() && $currentTime <= $this->endDate->getTimestamp();
    }
}
