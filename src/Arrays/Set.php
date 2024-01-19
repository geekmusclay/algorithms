<?php

declare(strict_types=1);

namespace Geekmusclay\Algorithms\Arrays;

use JsonSerializable;
use Geekmusclay\Algorithms\Common\Scalar;
use Geekmusclay\Algorithms\Abstract\AbstractType;

/**
 * Describe a scalar array
 */
class Set extends AbstractType implements JsonSerializable
{
    /** @var Scalar[] $values The values stored in the map */
    private array $values;

    /**
     * Undocumented function
     *
     * @param array $value
     */
    public function __construct(array $value)
    {
        $this->values = $value;
    }

    /**
     * Undocumented function
     *
     * @return string String representation of the array
     */
    public function __toString()
    {
        return $this->json();
    }

    public function get(int|string $index): mixed
    {
        return $this->values[$index];
    }

    public function push(mixed $value): self
    {
        array_push($this->values, $value);

        return $this;
    }

    public function values(): array
    {
        return $this->values;
    }

    public function array(): array
    {
        return array_map(function ($value) {
            if ($value instanceof Scalar) {
                return $value->value();
            }

            return $value;
        }, $this->values);
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

    public function slice(int $offset, ?int $length = null, bool $preserve_keys = false): self
    {
        $this->values = array_slice($this->values, $offset, $length, $preserve_keys);

        return $this;
    }

    public function implode(string $separator): string
    {
        return implode($separator, $this->values);
    }

    public function jsonSerialize(): mixed
    {
        return $this->values;
    }

    public function json(int $flags = 0, int $depth = 512): string|false
    {
        return json_encode(array_values($this->values), $flags, $depth);
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

    public function min(): int
    {
        return min(PHP_INT_MAX, ...$this->values);
    }

    public function max(): int
    {
        return max(PHP_INT_MIN, ...$this->values);
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

    public function keys(): Set
    {
        return new Set(
            $this->instanciate(
                array_keys($this->values),
                Scalar::class
            )
        );
    }
}
