<?php
declare(strict_types=1);

namespace spec\Invest;

use Invest\Exception\InvestmentAmountTooLarge;
use Invest\Investment;
use Invest\Loan;
use Invest\Tranche;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrancheSpec extends ObjectBehavior
{
    function let()
    {
        // Arrange
        $this->beConstructedWith('A', (float)3, 1000.00);
    }

    function it_exposes_the_name()
    {
        // Act / Assert
        $this->name()->shouldReturn("A");
    }

    function it_exposes_the_monthly_interest_rate()
    {
        // Act / Assert
        $this->monthlyInterestRate()->shouldReturn((float)3);
    }

    function it_exposes_the_maximum_investment_amount()
    {
        // Act / Assert
        $this->maximumInvestmentAmount()->shouldReturn(1000.00);
    }

    function it_exposes_the_loan(Loan $loan)
    {
        // Act / Assert
        $this->setLoan($loan);
        $this->getLoan()->shouldReturn($loan);
    }

    function it_exposes_investments(
        Investment $investmentOne,
        Investment $investmentTwo
    ) {
        // Arrange
        $investmentOne->amount()->willReturn(999.10);
        $investmentTwo->amount()->willReturn(0.90);

        // Act / Assert
        $this->addInvestment($investmentOne);
        $this->addInvestment($investmentTwo);
        $this->getInvestments()->shouldReturn([$investmentOne, $investmentTwo]);
    }

    function it_throws_an_exception_if_the_investment_breaches_the_maximum_amount(
        Investment $investmentOne,
        Investment $investmentTwo
    ) {
        // Arrange
        $investmentOne->amount()->willReturn(999.10);
        $investmentTwo->amount()->willReturn(0.91);

        // Act / Assert
        $this->addInvestment($investmentOne);
        $this->shouldThrow(InvestmentAmountTooLarge::class)->during('addInvestment', [$investmentTwo]);
    }
}
