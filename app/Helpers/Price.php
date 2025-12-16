<?php

namespace App\Helpers;

class Price
{
    public readonly int $cent;

    public readonly int $value;

    public readonly float $dollar;

    public readonly string $formatted;

    public function __construct(int $cent)
    {
        $this->cent = $cent;
        $this->value = $cent;
        $this->dollar = $cent / 100;
        $this->formatted = number_format($this->dollar, 2);
    }

    public static function from(int $cent): self
    {
        return new self($cent);
    }
}
