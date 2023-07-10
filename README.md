# PHP-Benchmark
Benchmark your PHP Scripts

## Usage
include the benchmark.php file in your code
```php
include('benchmark.php');
```

Load the Class
```php
$bench = new BenchMark();
```

Start a round
```php
$bench->mark();
```

Start a round with a name
```php
$bench->mark('value');
```

Mark a round. You can also name this
```php
$bench->mark();
```

## Show results
```php
var_dump($bench->all_marks()); //Show all marks
print_r($bench->total_time()); //Show total runtime
print_r($bench->time_between('first','last')); //Show time between two named values
print_r($bench->convert_readable());
print_r($bench->convert_readable($bench->time_between('first','last')));
```
