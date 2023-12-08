# Algorithms

## Day 1 Solution
```php
declare(strict_types=1);

include '../vendor/autoload.php';

use Geekmusclay\Algorithms\Scalar;
use Geekmusclay\Algorithms\Arrays\Map;

$input = '1abc2
pqr3stu8vwx
a1b2c3d4e5f
treb7uchet';

function scalar(mixed $input) {
    return new Scalar($input);
}

function map(array $input) {
    return new Map($input);
}

function solve(Map $lines) {
    return $lines->map(function ($line) {
        $nums = $line->ints();
        return scalar($nums->first() . $nums->last());
    })->sum();
}

/** @var Scalar[] $line */
$sum = solve(scalar($input)->lines());
var_dump($sum);

$digits = [
    "zero"  => 0,
    "one"   => 1,
    "two"   => 2,
    "three" => 3,
    "four"  => 4,
    "five"  => 5,
    "six"   => 6,
    "seven" => 7,
    "eight" => 8,
    "nine"  => 9,
];

$input = 'two1nine
eightwothree
abcone2threexyz
xtwone3four
4nineeightseven2
zoneight234
7pqrstsixteen';

function solveTwo(string $input, array $digits) {
    $lines = scalar($input)->lines()->map(function ($line) use ($digits) {
        // Replace the letter numbers by mapped numbers
        $res = preg_replace_callback(
            "/(".implode("|", array_keys($digits)).")/", // /(zero|one|two ...)/
            function ($r) use ($digits) {
                return $digits[$r[1]];                   // Replace found letter digits by mapped digits
            },
            $line->string()                              // We work on the string value of the line
        );

        return scalar($res);
    });

    return solve($lines);
}

var_dump(solveTwo($input, $digits));
```