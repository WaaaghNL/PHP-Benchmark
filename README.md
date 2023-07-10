# PHP-Benchmark
Benchmark your PHP Scripts

## Usage
include the benchmark.php file in your code
``include('benchmark.php');``

Load the Class
``$bench = new BenchMark();``

Start a round
``$bench->mark();``

Start a round with a name
``$bench->mark('value');``

Mark a round. You can also name this
``$bench->mark();``

## Show results
``
var_dump($bench->all_marks()); //Show all marks
print_r($bench->total_time()); //Show total runtime
print_r($bench->time_between('first','last')); //Show time between two named values
print_r($bench->convert_readable());
print_r($bench->convert_readable($bench->time_between('first','last')));
``
