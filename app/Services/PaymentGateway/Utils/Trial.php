<?php

namespace App\Services\PaymentGateway\Utils;

use DateTime;
use DateTimeZone;

class Trial
{
    private DateTimeZone $timezone;

    private DateTime $date;

    public function __construct()
    {
        $this->timezone = new DateTimeZone('America/Sao_Paulo');
        $this->date = new DateTime('now', $this->timezone);
    }

    private function setDate(string $timestamp): self
    {
        $this->date = new DateTime($timestamp, $this->timezone);

        return $this;
    }

    public function get(): string
    {
        return $this->date->format('Y-m-d');
    }

    public function today(): self
    {
        $this->setDate('now');

        return $this;
    }

    public function tomorrow(): self
    {
        $this->setDate('tomorrow');

        return $this;
    }

    public function oneWeek(): self
    {
        $this->setDate('+1 week');

        return $this;
    }

    public function fourteenDays(): self
    {
        $this->setDate('+14 days');

        return $this;
    }

    public function fifteenDays(): self
    {
        $this->setDate('+15 days');

        return $this;
    }

    public function thirtyDays(): self
    {
        $this->setDate('+30 days');

        return $this;
    }

    public function oneMonth(): self
    {
        $this->setDate('+1 month');

        return $this;
    }

    public function fuortyDays(): self
    {
        $this->setDate('+40 days');

        return $this;
    }
}
