<?php

declare(strict_types=1);

namespace Geekmusclay\Algorithms\Common;

class Math
{
    /**
     * Calaculates the factorial of an integer using recursive approach.
     * Time Complexity: O(n)
     *
     * @param integer $n The integer to calculate the factorial of.
     * @return integer The factorial of the integer.
     */
    public function rfacto(int $n): int
    {
        if ($n < 2) {
            return $n;
        }

        return $n * $this->rfacto($n - 1);
    }


    /**
     * Calculates the nth number in the Fibonacci sequence.
     * Time Complexity: O(n)
     *
     * @param int $n The index of the Fibonacci number to calculate.
     * @return int The calculated Fibonacci number.
     */
    public function lfibo(int $n): int
    {
        if ($n < 2) {
            return $n;
        }

        $res = [0, 1];
        for ($i = 2; $i <= $n; $i++) {
            $res[] = $res[$i - 1] + $res[$i - 2];
        }

        return $res[$n];
    }


    /**
     * Calculates the Fibonacci number at the given index using recursive approach.
     * Time Complexity: O(2^n)
     *
     * @param int $n The index of the Fibonacci number to calculate.
     * @return int The Fibonacci number at the given index.
     */
    public function rfibo(int $n): int
    {
        if ($n < 2) {
            return $n;
        }

        return $this->rfibo($n - 1) + $this->rfibo($n - 2);
    }
}
