<?php

declare(strict_types=1);

namespace Geekmusclay\Algorithms\Abstract;

use Geekmusclay\Algorithms\Common\Scalar;

abstract class AbstractType
{
    const BOOL_VALUES = ['true', 'false', true, false];

    public function instanciate(array $values, string $class = Scalar::class): array
    {
        return array_map(function ($item) use ($class) {
            return new $class($item);
        }, $values);
    }

    public function type(mixed $value): mixed
    {
        if (true === is_array($value)) {
            return $this->type($value);
        }

        if (true === in_array($value, self::BOOL_VALUES, true)) {
            return boolval($value);
        }

        if (false === is_numeric($value)) {
            return $value;
        }

        $float = floatval($value);
        $int = intval($value);
        if (($float - $int) > 0) {
            return $float;
        }

        return $int;
    }
}
