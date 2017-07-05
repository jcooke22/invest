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
    When the investor named "1" tries to invest £"1000" in tranche "A" on "03/10/2015"
    And the investor named "2" tries to invest £"1" in tranche "A" on "04/10/2015"
    And the investor named "3" tries to invest £"500" in tranche "B" on "10/10/2015"
    And the investor named "4" tries to invest £"1100" in tranche "B" on "25/10/2015"
    And the accounts clerk runs the investment calculation report on for the period "01/10/2015" - "31/10/2015"
    Then the investor named "1" was "able" to successfully invest
    And the investor named "2" was "unable" to successfully invest 
    And the investor named "3" was "able" to successfully invest
    And the investor named "4" was "unable" to successfully invest
    And the investment report indicates that investor "1" earns £"28.06" 
    And the investment report indicates that investor "3" earns £"21.29"
