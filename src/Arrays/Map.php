<?php

declare(strict_types=1);

namespace Geekmusclay\Algorithms\Arrays;

use JsonSerializable;
use Geekmusclay\Algorithms\Scalar;
use Geekmusclay\Algorithms\Abstract\AbstractType;

class Map extends AbstractType implements JsonSerializable
{
    /** @var Scalar[] $values */
    private array $values;

    public function __construct(array $value)
    {
        $this->values = $value;
    }

    public function __toString()
    {
        return $this->json();
    }

    public function push(mixed $value): self
    {
        array_push($this->values, $value);

        return $this;
    }

    public function value(): array
    {
        return $this->values;
    }

    public function get(int $index): mixed
    {
        return $this->values[$index];
    }

    public function search(mixed $value): ?int
    {
        return array_search($value, $this->values);
    }

    public function map(callable $callable): self
    {
        $this->values = array_map($callable, $this->values);

        return $this;
    }

    public function each(callable $callable): self
    {
        /** @var Scalar $value */
        foreach ($this->values as $key => &$value) {
            $value = $callable($value, $key);
        }

        return $this;
    }

    public function filter(?callable $callback = null, int $mode = 0): self
    {
        $this->values = array_filter($this->values, $callback, $mode);

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return $this->values;
    }

    public function json(): string|false
    {
        return json_encode($this->values);
    }

    public function first(): mixed
    {
        if (false === isset($this->values[0])) {
            return null;
        }

        return $this->values[0];
    }

    public function last(): mixed
    {
        return end($this->values);
    }

    public function sum(): int
    {
        return array_reduce($this->values, function ($carry, $item) {
            $carry += $item->int();
            return $carry;
        });
    }

    public function length(): int
    {
        return count($this->values);
    }

    public function keys(): Map
    {
        return new Map(
            $this->instanciate(
                array_keys($this->values),
                Scalar::class
            )
        );
    }
}
