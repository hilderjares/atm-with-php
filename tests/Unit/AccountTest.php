<?php

namespace Tests;

use Vitto\Account;
use Vitto\Client;

test('Test debit account', function () {
    $client = new Client('sid', uniqid(), 'dev');
    $account = new Account(239044, 100, 100000, $client);
    $account->modify($account->getBalance() - 100);

    $this->assertTrue(0 === $account->getBalance());
});

test('Test deposit account', function () {
    $client = new Client('sid', uniqid(), 'dev');
    $account = new Account(239044, 100, 100000, $client);
    $account->modify($account->getBalance() + 100);

    $this->assertTrue(200 === $account->getBalance());
});
