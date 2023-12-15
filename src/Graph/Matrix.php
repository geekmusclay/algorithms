<?php

declare(strict_types=1);

namespace Geekmusclay\Algorithms\Graph;

use Exception;

class Matrix
{
    private array $matrix;

    private int $length = 0;

    private int $height = 0;

    public function __construct(array $matrix = [])
    {
        $this->matrix = $matrix;
        $this->height = count($this->matrix);
        if (false === isset($this->matrix[0])) {
            $this->length = 0;
        } else {
            $this->length = count($this->matrix[0]);
        }
    }

    public function matrix(): array
    {
        return $this->matrix;
    }

    public function height(): int
    {
        return $this->height;
    }

    public function length(): int
    {
        return $this->length;
    }

    public function getRow(int $y): ?array
    {
        if (false === isset($this->matrix[$y])) {
            return null;
        }

        return $this->matrix[$y];
    }

    public function getValue(int $y, int $x): mixed
    {
        if (false === isset($this->matrix[$y][$x])) {
            return null;
        }

        return $this->matrix[$y][$x];
    }

    public function getNeighbors(int $y, int $x): ?array
    {
        if (false === isset($this->matrix[$y][$x])) {
            return null;
        }
        $neightbors = [];

        // Get left
        if ($x !== 0 && true === isset($this->matrix[$y][$x - 1])) {
            $neightbors[] = $this->matrix[$y][$x - 1];
        }

        // Get right
        if ($x !== $this->length() && true === isset($this->matrix[$y][$x + 1])) {
            $neightbors[] = $this->matrix[$y][$x + 1];
        }

        // Get top
        if ($y !== 0 && true === isset($this->matrix[$y - 1][$x])) {
            $neightbors[] = $this->matrix[$y - 1][$x];
        }

        // Get bottom
        if ($y !== $this->height() && true === isset($this->matrix[$y + 1][$x])) {
            $neightbors[] = $this->matrix[$y + 1][$x];
        }

        // Get top left
        if ($y !== 0 && $x !== 0 && true === isset($this->matrix[$y - 1][$x - 1])) {
            $neightbors[] = $this->matrix[$y - 1][$x - 1];
        }

        // Get top right
        if ($y !== 0 && $x !== $this->length() && true === isset($this->matrix[$y - 1][$x + 1])) {
            $neightbors[] = $this->matrix[$y - 1][$x + 1];
        }

        // Get bottom left
        if ($y !== $this->height() && $x !== 0 && true === isset($this->matrix[$y + 1][$x - 1])) {
            $neightbors[] = $this->matrix[$y + 1][$x - 1];
        }

        // Get bottom right
        if ($y !== $this->height() && $x !== $this->length() && true === isset($this->matrix[$y + 1][$x + 1])) {
            $neightbors[] = $this->matrix[$y + 1][$x + 1];
        }

        return $neightbors;
    }

    // @TODO fix doublon
    public function getRangedNeighbor(int $y, int $from, int $to, ?callable $callback = null): ?array
    {
        if (false === isset($this->matrix[$y])) {
            return null;
        }
        $neightbors = [];

        for ($i = $from; $i <= $to; $i++) {
            $neightbors = [...$neightbors, ...$this->getNeighbors($y, $i)];
        }

        if (null !== $callback) {
            $neightbors = array_filter($neightbors, $callback);
        }

        return $neightbors;
    }
}
