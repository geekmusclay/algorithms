<?php 

declare(strict_types=1);

namespace Geekmusclay\Algorithms;

use Geekmusclay\Algorithms\Abstract\AbstractType;
use Geekmusclay\Algorithms\Arrays\Map;
use JsonSerializable;

class Scalar extends AbstractType implements JsonSerializable
{
    /** @var string $string Conain the string value of the scalar */
    private string $string;

    /** @var int $int Contain the int value of the scalar */
    private int $int;

    /** @var mixed $value Contain the typed value of the scalar */
    private mixed $value;

    /**
     * Scalar constructor
     *
     * @param mixed $value The scalar value
     */
    public function __construct(mixed $value)
    {
        $this->string = (string) $value;
        $this->int    = (int) $value;
        $this->value  = $this->type($value);
    }

    /**
     * Cast as string
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->string;
    }

    /**
     * Return the string value of the scalar
     *
     * @return string
     */
    public function string(): string
    {
        return $this->string;
    }

    /**
     * Return the integer value of the scalar
     *
     * @return integer
     */
    public function int(): int
    {
        return $this->int;
    }

    /**
     * Return the typed value of the scalar
     *
     * @return mixed
     */
    public function value(): mixed
    {
        return $this->value;
    }

    /**
     * When debugging, only output the string value
     *
     * @return void
     */
    public function jsonSerialize(): string
    {
        return $this->string;
    }

    public function chars(): array
    {
        return str_split($this->string);
    }

    public function split(string $delimiter): Map
    {
        return new Map($this->explode($delimiter));
    }

    public function explode(string $delimiter): array
    {
        return $this->instanciate(explode($delimiter, $this->string), self::class);
    }

    public function lines(): Map
    {
        return $this->split(PHP_EOL);
    }

    public function length()
    {
        return strlen($this->string);
    }

    public function trim(): self
    {
        $this->string = trim($this->string);

        return $this;
    }

    public function match(string $regex): array
    {
        preg_match_all($regex, $this->string, $matches, PREG_SET_ORDER, 0);

        return $matches;
    }

    public function numbers(): Map
    {
        preg_match_all('/\d+/m', $this->string, $matches, PREG_SET_ORDER, 0);

        return new Map(array_map(function ($item) {
            return new self($item[0]);
        }, $matches));
    }

    public function ints(): Map
    {
        preg_match_all('/\d{1}/m', $this->string, $matches, PREG_SET_ORDER, 0);

        return new Map(array_map(function ($item) {
            return new self($item[0]);
        }, $matches));
    }

    public function isEmpty(): bool
    {
        return strlen($this->string) === 0;
    }
}