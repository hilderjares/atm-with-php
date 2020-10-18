<?php

declare(strict_types=1);

namespace Vitto;

class Account
{
    private $number;
    private $balance;
    private $limit;
    private $client;

    public function __construct(int $number, int $balance, int $limit, Client $client)
    {
        $this->number = $number;
        $this->balance = $balance;
        $this->limit = $limit;
        $this->client = $client;
    }

    public function modify(int $newBalance): void
    {
        $this->balance = $newBalance;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function getNumber(): int
    {
        return $this->number;
    }
}
