<?php
declare(strict_types=1);

namespace spec\Invest;

use Invest\Tranche;
use Invest\TrancheInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrancheSpec extends ObjectBehavior
{
    function let()
    {
        // Arrange
        $this->beConstructedWith('A', (float)3, 1000.00);
    }

    function it_implements_the_correct_interface()
    {
        // Assert
        $this->shouldImplement(TrancheInterface::class);
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
}
