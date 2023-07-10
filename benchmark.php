<?php

class BenchMark {

    private $marks = null;

    /**
     * fill array for first use
     */
    function __construct() {
        $this->marks = array('named' => array(), 'marks' => []);
    }

    /**
     * Remove everything
     */
    function __destruct() {
        unset($this->marks);
    }

    /**
     * mark
     * 
     * The mark is a time triggerpoint. When providing $name with a value the time will be added to the $marks['named'] array.
     * FIRST and LAST are reserved names for this function. 
     * everytime the mark function is run it checks if the first named value exists if not it will add $marks['named']['first']
     * Everytime the mark function runs it updates the ['last'] time
     * @param type $name
     */
    function mark($name = null) {
        //Create timestamp
        $time = microtime(true);

        if (strtolower($name) == "first" OR strtolower($name) == "last") {
            die("first and last are reserved words for this bensmark function!");
        }
        if (!isset($this->marks['named']['first'])) {
            $this->marks['named']['first'] = $time;
        }
        if (isset($name)) {
            $this->marks['named'][$name] = $time;
        }
        $this->marks['marks'][] = $time;
        $this->marks['named']['last'] = $time;
    }

    /**
     * time_between
     * 
     * This function calculates the time between two named timestamps
     * @param type $first
     * @param type $last
     * @return type
     */
    function time_between($first, $last) {
        if (isset($first) AND isset($last)) {
            return $this->marks['named'][$last] - $this->marks['named'][$first];
        } else {
            return $this->total_time();
        }
    }

    /**
     * total_time
     * 
     * this function returns the time between the first and last mark.
     * @return int
     */
    function total_time() {
        return array_key_last($this->marks['marks']) - array_key_first($this->marks['marks']);
    }

    /**
     * Returns an array with all values
     * 
     * @return array
     */
    function all_marks() {
        return $this->marks;
    }

    /**
     * convert_readable
     * 
     * input seconds and the output will be a string in Days, hours, minutes, and seconds
     * @param type $input
     * @return string
     */
    function convert_readable($input = null) {
        if (isset($input) AND is_numeric($input)) {
            $time = $input;
        } else {
            $time = $this->total_time();
        }

        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$time");
        echo $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    }
}
