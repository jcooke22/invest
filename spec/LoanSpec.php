<?php

namespace spec\Invest;

use DateTime;
use Invest\Loan;
use Invest\TrancheInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LoanSpec extends ObjectBehavior
{
    function it_exposes_the_start_date()
    {
        // Arrange
        $startDate = new DateTime('yesterday');
        $endDate = new DateTime('tomorrow');
        $this->beConstructedWith($startDate, $endDate);

        // Act / Assert
        $this->startDate()->shouldReturn($startDate);
    }

    function it_exposes_the_end_date()
    {
        // Arrange
        $startDate = new DateTime('yesterday');
        $endDate = new DateTime('tomorrow');
        $this->beConstructedWith($startDate, $endDate);

        // Act / Assert
        $this->endDate()->shouldReturn($endDate);
    }

    function it_exposes_the_tranches(
        TrancheInterface $trancheOne,
        TrancheInterface $trancheTwo
    ) {
        // Arrange
        $startDate = new DateTime('yesterday');
        $endDate = new DateTime('tomorrow');
        $this->beConstructedWith($startDate, $endDate);

        // Act
        $this->addTranche($trancheOne);
        $this->addTranche($trancheTwo);

        // Assert
        $this->getTranches()->shouldReturn([$trancheOne, $trancheTwo]);
    }
    
    function it_exposes_the_open_state_correctly() {
        // Arrange
        $this->beConstructedWith(new DateTime('-1 month'), new DateTime('+1 month'));

        // Act / Assert
        $this->isOpen()->shouldReturn(true);
    }
    
    function it_exposes_the_closed_state_correctly() {
        // Arrange
        $this->beConstructedWith(new DateTime('-2 month'), new DateTime('-1 month'));

        // Act / Assert
        $this->isOpen()->shouldReturn(false);
    }
}
