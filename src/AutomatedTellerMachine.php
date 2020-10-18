<?php

declare(strict_types=1);

namespace Vitto;

use Exception;

class AutomatedTellerMachine implements Transactions
{
    private $bank;

    public function __construct(Bank $bank)
    {
        $this->bank = $bank;
    }

    public function deposit(int $numberAccount, int $value): void
    {
        $account = $this->bank->account($numberAccount);

        if (!$account) {
            throw new Exception('a conta não existe');
        }

        if ($value < 0) {
            throw new Exception('vocẽ não pode depositar um valor negativo');
        }

        $account->modify($account->getBalance() + $value);
    }

    public function withDraw(int $numberAccount, int $value): void
    {
        $account = $this->bank->account($numberAccount);
        $valueForDebit = $value;

        if (!$account) {
            throw new Exception('a conta não existe');
        }

        if ($value < 0) {
            throw new Exception('vocẽ não pode sacar um valor negativo');
        }

        if ($value > $account->getBalance()) {
            throw new Exception('vocẽ tem saldo suficiente para sacar esse valor');
        }

        $notes = [200, 100, 50, 20, 10, 5, 2];
        $noteCounter = [0, 0, 0, 0, 0, 0, 0];

        for ($i = 0; $i < count($notes); ++$i) {
            if ($value >= $notes[$i]) {
                $noteCounter[$i] = intval($value / $notes[$i]);
                $value = $value - $noteCounter[$i] * $notes[$i];
            }
        }

        if (0 !== $value) {
            throw new Exception('não foi possível sacar esse valor');
        }

        $account->modify($account->getBalance() - $valueForDebit);

        for ($i = 0; $i < count($noteCounter); ++$i) {
            if (0 != $noteCounter[$i]) {
                echo $notes[$i].' : '.$noteCounter[$i].PHP_EOL;
            }
        }
    }

    public function viewBalance(int $numberAccount): void
    {
        $account = $this->bank->account($numberAccount);

        if (!$account) {
            throw new Exception('a conta não existe');
        }

        echo 'seu saldo atual: '.money_format('%.2n', $account->getBalance()).PHP_EOL;
    }
}
