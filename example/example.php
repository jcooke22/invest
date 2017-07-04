<?php
use Invest\Investment;
use Invest\Investor;
use Invest\Loan;
use Invest\Tranche;
use Invest\VirtualWallet;

require_once __DIR__ . '/../vendor/autoload.php';

$investor1 = new Investor('1', (new VirtualWallet())->add(1000.00));
$investor2 = new Investor('2', (new VirtualWallet())->add(1000.00));
$investor3 = new Investor('3', (new VirtualWallet())->add(1000.00));
$investor4 = new Investor('4', (new VirtualWallet())->add(1000.00));

$trancheA = new Tranche("A", 3.00, 1000.00);
$trancheB = new Tranche("B", 6.00, 1000.00);

$loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'), new DateTime('2015-10-05'));

$loan->addTranche($trancheA);
$loan->addTranche($trancheB);

$investmentOne = new Investment($investor1, $trancheA, 500.20);
$investmentTwo = new Investment($investor2, $trancheB, 750.10);

$trancheA->name();
$trancheA->maximumInvestmentAmount();
$trancheA->monthlyInterestRate();
$trancheA->getTotalInvestmentAmount();

var_dump($investmentOne);
var_dump($investmentTwo);






