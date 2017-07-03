<?php
declare(strict_types=1);

namespace spec\Invest;

use Invest\Exception\VirtualWalletInsufficientBalance;
use Invest\VirtualWallet;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VirtualWalletSpec extends ObjectBehavior
{
    function it_exposes_a_value()
    {
        // Arrange
        $this->add(12.34);
        $this->add(56.78);
        $this->subtract(11);
        $this->subtract(22);

        // Act / Assert
        $this->balance()->shouldReturn(36.12);
    }

    function it_throws_an_exception_when_trying_to_subtract_more_than_the_available_balance()
    {
        // Arrange
        $this->add(100.00);

        // Act / Assert
        $this->shouldThrow(VirtualWalletInsufficientBalance::class)->during('subtract', [100.01]);
    }
}
