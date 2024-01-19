<?php

declare(strict_types=1);

namespace Geekmusclay\Algorithms\Arrays;

class Stack
{
    private array $stack;

    public function __construct(array $stack)
    {
        $this->stack = $stack;
    }

    public function __toString()
    {
        return $this->json();
    }

    public function top(): mixed
    {
        return end($this->stack);
    }

    public function push(mixed $value): self
    {
        array_push($this->stack, $value);

        return $this;
    }

    public function pop(): mixed
    {
        return array_pop($this->stack);
    }

    public function reverse(): self
    {
        $this->stack = array_reverse($this->stack);

        return $this;
    }

    public function isEmpty(): bool
    {
        return 0 === count($this->stack);
    }

    public function search(mixed $value): int|false
    {
        for ($i = 0; $i < count($this->stack); $i++) { 
            if ($value === $this->stack[$i]) {
                return $i;
            }
        }

        return false;
    }

    public function json(): string
    {
        return json_encode($this->stack);
    }
}
