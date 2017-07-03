<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given /^there is a loan which starts on "([^"]*)" and ends on "([^"]*)"$/
     */
    public function thereIsALoanWhichStartsOnAndEndsOn($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given /^the loan has a tranche named "([^"]*)" with an interest rate of "([^"]*)"% and an investment limit of £"([^"]*)"$/
     */
    public function theLoanHasATrancheNamedWithAnInterestRateOfAndAnInvestmentLimitOf£($arg1, $arg2, $arg3)
    {
        throw new PendingException();
    }

    /**
     * @Given /^there is an investor named "([^"]*)" who has £"([^"]*)" in their virtual wallet$/
     */
    public function thereIsAnInvestorNamedWhoHas£InTheirVirtualWallet($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When /^the investor named "([^"]*)" tries to invest £"([^"]*)" in tranche "([^"]*)" on "([^"]*)"$/
     */
    public function theInvestorNamedTriesToInvest£InTrancheOn($arg1, $arg2, $arg3, $arg4)
    {
        throw new PendingException();
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
