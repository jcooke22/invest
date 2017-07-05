<?php

namespace spec\Invest\Service;

use DateTime;
use Invest\Investment;
use Invest\Investor;
use Invest\Loan;
use Invest\Service\Reporting;
use Invest\Tranche;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ReportingSpec extends ObjectBehavior
{
    // @todo - Extend these test cases to cover more logical branches
    
    public function getMatchers()
    {
        return [
            'matchTheValues' => function ($subject, $key) {
                $valid = true; 
                foreach ($subject as $subjects) {
                    $valid = array_key_exists($key, $subjects);
                }
                return $valid;
            }
        ];
    }
    
    function it_returns_the_report_array(
        Loan $loan,
        Tranche $trancheA,
        Tranche $trancheB,
        Investment $investmentOne,
        Investment $investmentTwo,
        Investor $investorOne,
        Investor $investorTwo
    ) {
        // Arrange
        $loan->getTranches()->willReturn([$trancheA, $trancheB]);
        $trancheA->monthlyInterestRate()->willReturn(3.00);
        $trancheA->getInvestments()->willReturn([$investmentOne]);
        $trancheB->monthlyInterestRate()->willReturn(6.00);
        $trancheB->getInvestments()->willReturn([$investmentTwo]);
        $investmentOne->amount()->willReturn(1000.00);
        $investmentOne->investor()->willReturn($investorOne);
        $investmentOne->startDate()->willReturn(new DateTime('2015-10-01'));
        $investmentTwo->amount()->willReturn(500.00);
        $investmentTwo->investor()->willReturn($investorTwo);
        $investmentTwo->startDate()->willReturn(new DateTime('2015-10-01'));

        // Act / Assert
        $this->generateInvestmentReport(
            $loan,
            new DateTime('2015-10-01'),
            new DateTime('2015-10-31')
        )->shouldMatchTheValues('investor');
    }
}
