<?php

namespace spec\Invest;

use Invest\Investment;
use Invest\Investor;
use Invest\Tranche;
use Invest\VirtualWallet;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InvestorSpec extends ObjectBehavior
{
    function let(VirtualWallet $virtualWallet)
    {
        // Arrange
        $this->beConstructedWith('1', $virtualWallet);
    }

    function it_exposes_the_name()
    {
        // Act / Assert
        $this->name()->shouldReturn('1');
    }

    function it_exposes_the_virtual_wallet($virtualWallet)
    {
        // Act / Assert
        $this->virtualWallet()->shouldReturn($virtualWallet);
    }

    function it_exposes_the_investments(
        Investment $investmentOne,
        Investment $investmentTwo
    ) {
        // Act
        $this->addInvestment($investmentOne);
        $this->addInvestment($investmentTwo);
        
        // Assert
        $this->getInvestments()->shouldReturn([$investmentOne, $investmentTwo]);
    }

}
