<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Invest\Investment;
use Invest\Investor;
use Invest\Loan;
use Invest\Tranche;
use Invest\VirtualWallet;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var Loan
     */
    private $loan;

    /**
     * @var Investor[]
     */
    private $investors = [];

    /**
     * @var Tranche[]
     */
    private $tranches = [];

    /**
     * FeatureContext constructor.
     */
    public function __construct()
    {
    }

    /**
     * @Given /^there is a loan which starts on "([^"]*)" and ends on "([^"]*)"$/
     */
    public function thereIsALoanWhichStartsOnAndEndsOn($startTime, $endTime)
    {
        $this->loan = new Loan(new DateTime($startTime), new DateTime($endTime), new DateTime('2015-11-01'));
    }

    /**
     * @Given /^the loan has a tranche named "([^"]*)" with an interest rate of "([^"]*)"% and an investment limit of £"([^"]*)"$/
     */
    public function theLoanHasATrancheNamedWithAnInterestRateOfAndAnInvestmentLimitOf£($name, $rate, $limit)
    {
        $this->tranches[$name] = new Tranche($name, (float)$rate, $limit);
        $this->loan->addTranche($this->tranches[$name]);
    }

    /**
     * @Given /^there is an investor named "([^"]*)" who has £"([^"]*)" in their virtual wallet$/
     */
    public function thereIsAnInvestorNamedWhoHas£InTheirVirtualWallet($name, $amount)
    {
        $this->investors[$name] = new Investor($name, (new VirtualWallet())->add((float)$amount));
    }

    /**
     * @When /^the investor named "([^"]*)" tries to invest £"([^"]*)" in tranche "([^"]*)" on "([^"]*)"$/
     */
    public function theInvestorNamedTriesToInvest£InTrancheOn($investorName, $amount, $trancheName, $date)
    {
        new Investment(
            $this->investors[$investorName], $this->tranches[$trancheName], $amount, new DateTime($date)
        );
    }

    /**
     * @Given /^the accounts clerk runs the investment calculation report on for the period "([^"]*)" \- "([^"]*)"$/
     */
    public function theAccountsClerkRunsTheInvestmentCalculationReportOnForThePeriod($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then /^the investor named "([^"]*)" was "([^"]*)" to successfully invest$/
     */
    public function theInvestorNamedWasToSuccessfullyInvest($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given /^the investment report indicates that investor "([^"]*)" earns £"([^"]*)"$/
     */
    public function theInvestmentReportIndicatesThatInvestorEarns£($arg1, $arg2)
    {
        throw new PendingException();
    }
}
