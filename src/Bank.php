<?php

declare(strict_types=1);

namespace Vitto;

use ArrayObject;

class Bank
{
    private $name;
    private $address;
    private $accounts;

    public function __construct(ArrayObject $accounts, string $name, string $address)
    {
        $this->accounts = $accounts;
        $this->name = $name;
        $this->address = $address;
    }

    public function addAccount(int $accountNumber, Account $account): void
    {
        $this->accounts->offsetSet($accountNumber, $account);
    }

    public function account(int $accountNumber): ?Account
    {
        return $this->accounts->offsetExists($accountNumber) ? $this->accounts->offsetGet($accountNumber) : null;
    }
}
