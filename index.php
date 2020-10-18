<?php

declare(strict_types=1);

use Vitto\Account;
use Vitto\AutomatedTellerMachine;
use Vitto\Bank;
use Vitto\Client;

$vendor = __DIR__.'/vendor/autoload.php';

if (!file_exists($vendor)) {
    exit('Install dependencies to run this script.');
}

require $vendor;

$bradescoBank = new Bank(new ArrayObject(), 'bradesco', 'Quixadá - CE');
$hilderjares = new Client('hilderjares', uniqid(), 'dev');
$hilderjaresAccount = new Account(2222, 0, 10000, $hilderjares);

$bradescoBank->addAccount($hilderjaresAccount->getNumber(), $hilderjaresAccount);

$atm = new AutomatedTellerMachine($bradescoBank);

try {
    $atm->deposit(2222, 580);
    $atm->withDraw(2222, 330);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
