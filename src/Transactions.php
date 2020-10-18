<?php

namespace Vitto;

interface Transactions
{
    public function deposit(int $numberAccount, int $value): void;

    public function withDraw(int $numberAccount, int $value): void;

    public function viewBalance(int $numberAccount): void;
}
