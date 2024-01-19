# Algorithms

### Scalar usage example
```php
function scalar(mixed $input) {
    return new Scalar($input);
}

$input = 'line1
line2';

$sum = 0;
scalar($input)->numbers()->map(function (Scalar $scalar) use ($sum) {
    $sum += $scala->int()
});

echo $sum; // 3
```

### Queue usage example
```php
function queue(array $queue): Queue {
    return new Queue($queue);
}

$queue = queue([0,1,2,3,4,5,6,7,8,9]);
$queue->push(10);

while (true !== $queue->isEmpty()) {
    echo $queue->pop();
}
```

### Stack usage example
```php
function queue(array $queue): Queue {
    return new Queue($queue);
}

$queue = queue([0,1,2,3,4,5,6,7,8,9]);
$queue->push(10);

while (true !== $queue->isEmpty()) {
    echo $queue->pop();
}
```