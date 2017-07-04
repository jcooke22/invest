<?php

namespace Invest;

/**
 * Class Investor
 */
class Investor
{
    /**
     * @var string
     */
    private $name;
    
    /**
     * @var VirtualWallet
     */
    private $virtualWallet;

    /**
     * @var Investment[]
     */
    private $investments;

    /**
     * Investor constructor.
     * @param string $name
     * @param VirtualWallet $virtualWallet
     */
    public function __construct(string $name, VirtualWallet $virtualWallet)
    {
        $this->name = $name;
        $this->virtualWallet = $virtualWallet;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return VirtualWallet
     */
    public function virtualWallet(): VirtualWallet
    {
        return $this->virtualWallet;
    }

    /**
     * @param Investment $investment
     * 
     * @return void
     */
    public function addInvestment(Investment $investment)
    {
        $this->investments[] = $investment;
    }

    /**
     * @return Investment[]
     */
    public function getInvestments()
    {
        return $this->investments;
    }
}
