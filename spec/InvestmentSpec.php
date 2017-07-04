<?php

namespace spec\Invest;

use Invest\Exception\InvestorInsufficientBalance;
use Invest\Exception\VirtualWalletInsufficientBalance;
use Invest\Investment;
use Invest\Investor;
use Invest\Tranche;
use Invest\VirtualWallet;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InvestmentSpec extends ObjectBehavior
{
    function let(
        Investor $investor,
        Tranche $tranche,
        VirtualWallet $virtualWallet
    ) {
        // Arrange
        $virtualWallet->subtract(10000.21)->willReturn($virtualWallet);
        $investor->virtualWallet()->willReturn($virtualWallet);
        $this->beConstructedWith($investor, $tranche, 10000.21);
    }

    function it_exposes_the_investor($investor)
    {
        // Act / Assert
        $this->investor()->shouldReturn($investor);
    }
    
    function it_exposes_the_tranche($tranche)
    {
        // Act / Assert
        $this->tranche()->shouldReturn($tranche);
    }
    
    function it_exposes_the_amount()
    {
        // Act / Assert
        $this->amount()->shouldReturn(10000.21);
    }
    
    function it_throws_an_exception_if_the_invester_virtual_wallet_has_an_insufficient_balance(
        Investor $investor,
        Tranche $tranche,
        VirtualWallet $virtualWallet
    ){
        // Arrange
        $virtualWallet->subtract(10000.21)->willThrow(VirtualWalletInsufficientBalance::class);
        $investor->virtualWallet()->willReturn($virtualWallet);
        $this->beConstructedWith($investor, $tranche, 10000.21);
        
        // Act / Assert
        $this->shouldThrow(InvestorInsufficientBalance::class)->duringInstantiation();
    }
    
}
