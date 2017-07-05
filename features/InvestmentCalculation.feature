
# @todo - Break these up into smaller, more focused features

Feature: Investment calculation
  In order to understand how much interest to pay investors
  As an accounts clerk
  I would like to run a report to generate the interest

  Scenario: Running an investment report
    Given there is a loan which starts on "2015-10-01" and ends on "2015-11-15"
    And the loan has a tranche named "A" with an interest rate of "3"% and an investment limit of £"1000"
    And the loan has a tranche named "B" with an interest rate of "6"% and an investment limit of £"1000"
    And there is an investor named "1" who has £"1000" in their virtual wallet 
    And there is an investor named "2" who has £"1000" in their virtual wallet
    And there is an investor named "3" who has £"1000" in their virtual wallet
    And there is an investor named "4" who has £"1000" in their virtual wallet
    When the investor named "1" tries to invest £"1000" in tranche "A" on "2015-10-03" with the result "success"
    And the investor named "2" tries to invest £"1" in tranche "A" on "2015-10-04" with the result "exception"
    And the investor named "3" tries to invest £"500" in tranche "B" on "2015-10-10" with the result "success"
    And the investor named "4" tries to invest £"1100" in tranche "B" on "2015-10-25" with the result "exception"
    And the accounts clerk runs the investment calculation report on for the period "2015-10-01" - "2015-10-31"
    Then the investment report indicates that investor "1" earns £"28.06" 
    And the investment report indicates that investor "3" earns £"21.29"
