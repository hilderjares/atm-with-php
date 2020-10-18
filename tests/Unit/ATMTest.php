<?php

namespace Tests;

use Vitto\Account;
use Vitto\AutomatedTellerMachine;
use Vitto\Bank;
use Vitto\Client;
use ArrayObject;
use Exception;

test('Test if cant debit value more than balance account', function () {
    $bradescoBank = new Bank(new ArrayObject(), 'bradesco', 'Quixadá - CE');
    $hilderjares = new Client('hilderjares', uniqid(), 'dev');
    $hilderjaresAccount = new Account(2222, 0, 10000, $hilderjares);

    $bradescoBank->addAccount($hilderjaresAccount->getNumber(), $hilderjaresAccount);

    $atm = new AutomatedTellerMachine($bradescoBank);
    $atm->withDraw(2222, 100);
})->throws(Exception::class, 'vocẽ não tem saldo suficiente para sacar esse valor');
