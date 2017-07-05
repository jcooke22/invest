<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Invest\Investment;
use Invest\Investor;
use Invest\Loan;
use Invest\Service\Reporting;
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
     * @var Reporting
     */
    private $reportingService;

    /**
     * @var array
     */
    private $report;

    /**
     * FeatureContext constructor.
     */
    public function __construct()
    {
        $this->reportingService = new Reporting();
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
     * @When /^the investor named "([^"]*)" tries to invest £"([^"]*)" in tranche "([^"]*)" on "([^"]*)" with the result "([^"]*)"$/
     */
    public function theInvestorNamedTriesToInvest£InTrancheOnWithTheResult(
        $investorName,
        $amount,
        $trancheName,
        $date,
        $result
    ) {
        switch ($result) {
            case 'success':
                new Investment(
                    $this->investors[$investorName], $this->tranches[$trancheName], $amount, new DateTime($date)
                );
                break;
            case 'exception':
                try {
                    new Investment(
                        $this->investors[$investorName], $this->tranches[$trancheName], $amount, new DateTime($date)
                    );
                } catch (Exception $e) {

                } finally {
                    if (!isset($e)) {
                        throw new Exception('Expecting exception but none thrown');
                    }
                }
                break;
        }

    }

    /**
     * @Given /^the accounts clerk runs the investment calculation report on for the period "([^"]*)" \- "([^"]*)"$/
     */
    public function theAccountsClerkRunsTheInvestmentCalculationReportOnForThePeriod($startDate, $endDate)
    {
        $this->report = $this->reportingService->generateInvestmentReport(
            $this->loan,
            new DateTime($startDate),
            new DateTime($endDate)
        );
    }

    /**
     * @Given /^the investment report indicates that investor "([^"]*)" earns £"([^"]*)"$/
     */
    public function theInvestmentReportIndicatesThatInvestorEarns£($investorName, $expectedEarnings)
    {
        $success = false;
        $actualEarnings = null;
        foreach ($this->report as $reportLine) {
            if ($reportLine['investor']->name() === $investorName) {
                $actualEarnings = (float)$reportLine['amount_earned'];
                if ((float)$expectedEarnings === $actualEarnings) {
                    $success = true;
                }
            }
        }

        if (!$success && isset($actualEarnings)) {
            throw new Exception(
                sprintf('Earnings expected were %s. Actual were %s', $expectedEarnings, $actualEarnings)
            );
        }
        if (!$success) {
            throw new Exception(sprintf('Earnings expected were %s', $expectedEarnings));
        }

    }
}
