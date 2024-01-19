<?php 

declare(strict_types=1);

namespace Geekmusclay\Algorithms\Common;

use Geekmusclay\Algorithms\Abstract\AbstractType;
use Geekmusclay\Algorithms\Arrays\Set;
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

    /**
     * Return the chars of the string
     *
     * @return array An array of chars
     */
    public function chars(): array
    {
        return str_split($this->string);
    }

    /**
     * Split the string by the delimiter
     *
     * @param string $delimiter The delimiter to use
     * @return Set The splitted string
     */
    public function split(string $delimiter): Set
    {
        return new Set($this->explode($delimiter));
    }

    /**
     * Explode the string using the given delimiter
     *
     * @param string $delimiter The delimiter to use
     * @return Scalar[] The splitted string, as a Scalar array
     */
    public function explode(string $delimiter): array
    {
        return $this->instanciate(explode($delimiter, $this->string), self::class);
    }

    /**
     * Split the string by line
     *
     * @return Set The lines of the string
     */
    public function lines(): Set
    {
        return $this->split(PHP_EOL);
    }

    public function length()
    {
        return strlen($this->string);
    }

    public function pos(string $string): int|false
    {
        return strpos($string, $this->string());
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

    public function numbers(): Set
    {
        preg_match_all('/\d+/m', $this->string, $matches, PREG_SET_ORDER, 0);

        return new Set(array_map(function ($item) {
            return new self($item[0]);
        }, $matches));
    }

    public function ints(): Set
    {
        preg_match_all('/\d{1}/m', $this->string, $matches, PREG_SET_ORDER, 0);

        return new Set(array_map(function ($item) {
            return new self($item[0]);
        }, $matches));
    }

    /**
     * Check if the string is empty
     *
     * @return boolean True if the string is empty, false otherwise
     */
    public function isEmpty(): bool
    {
        return strlen($this->string) === 0;
    }

    /**
     * Reverse the string using iterative approach
     * Time complexity O(n)
     *
     * @return string The reversed string
     */
    public function reverse(): string
    {
        $len = strlen($this->string);
        if ($len < 2) {
            return $this->string;
        }

        $res = '';
        for ($i = $len - 1; $i > 0; $i--) {
            $res .= $this->string[$i];
        }

        return $res;
    }

    /**
     * Reverse the string using a recursive approach
     * Time complexity O(n)
     *
     * @return string The reversed string
     */
    public function r_reverse(): string
    {
        $len = strlen($this->string);
        if ($len === 0) {
            return $this->string;
        }

        return $this->string[$len - 1] . $this->r_reverse(substr($this->string, 0, $len - 1));
    }
}