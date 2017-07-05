<?php

namespace Invest\Service;

use DateTime;
use Invest\Loan;

class Reporting
{
    const PRECISION = 2;

    /**
     * @param Loan $loan
     * @param DateTime $startDate
     * @param DateTime $endDate
     *
     * @return array
     */
    public function generateInvestmentReport(Loan $loan, DateTime $startDate, DateTime $endDate): array
    {
        // @todo - Refactor this into smaller private methods
        // @todo - Replace native PHP operators with BC Math operations to ensure no precision loss
        // @todo - Instead of returning an array, instead return a value object which better represents a report
        
        $report = [];
        foreach ($loan->getTranches() as $tranche) {
            foreach ($tranche->getInvestments() as $investment) {
                $reportLine = [];
                $reportLine['investor'] = $investment->investor();
                $reportLine['amount_earned'] = (
                        ($investment->amount() * ($tranche->monthlyInterestRate() / 100)) / cal_days_in_month(
                            CAL_GREGORIAN,
                            $startDate->format('n'),
                            $startDate->format('Y')
                        )) * (($endDate->diff($investment->startDate()))->d + 1);
                $reportLine['amount_earned'] = round($reportLine['amount_earned'], static::PRECISION);
                $report[] = $reportLine; 
                
            }
        }

        return $report;


    }
}
