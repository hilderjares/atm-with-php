<?php

declare(strict_types=1);

namespace Vitto;

class Client
{
    private $name;
    private $identify;
    private $job;

    public function __construct(string $name, string $identify, string $job)
    {
        $this->name = $name;
        $this->identify = $identify;
        $this->job = $job;
    }

    public function __toString()
    {
        return "{$this->name} - {$this->identify} - {$this->job}";
    }
}
