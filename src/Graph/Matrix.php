<?php

declare(strict_types=1);

namespace Geekmusclay\Algorithms\Graph;

class Matrix
{
    private array $matrix;

    public function __construct(array $matrix)
    {
        $this->matrix = $matrix;
    }

    public function matrix(): array
    {
        return $this->matrix;
    }

    public function hasForNeighbor(int $x, int $y, mixed $value, int $length = 1): bool
    {
        return true;
    }
}
