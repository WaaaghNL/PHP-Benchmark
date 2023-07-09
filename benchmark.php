<?php

class BenchMark {

    private $marks = array('named' => array(), 'marks' => []);

    /**
     * mark
     * 
     * The mark is a time triggerpoint. When providing $name with a value the time will be added to the $marks['named'] array.
     * everytime the mark function is run it checks if the first named value exists if not it will add $marks['named']['start']
     * Everytime the mark function runs it updates the ['stop'] time
     * @param type $name
     */
    function mark($name) {
        $time = microtime(true);
        if (isset($name)) {
            $this->marks['named'][$name] = $time;
        }
        if (!isset($this->marks['marks']['start'])) {
            $this->marks['marks']['start'] = $time;
        }
        $this->marks['marks'][] = $time;
        $this->marks['marks']['stop'] = $time;
    }

    /**
     * time_between
     * 
     * This function calculates the time between two named timestamps
     * @param type $first
     * @param type $last
     * @return type
     */
    function time_between($first = 'start', $last = 'stop') {
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
        $time = $time + 500;

        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$time");
        return $dtF->diff($dtT)->format('Process time: %a days, %h hours, %i minutes and %s seconds');
    }

}
