<?php

namespace Test\Benchmark;

use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Revs(100)
 * @Iterations(3)
 * @BeforeMethods({"init"})
 *
 * Test description goes here
 *
 */
class StringConcatenationBench
{
    private $chars;

    public function init()
    {
        $this->chars = array_fill(0 , 100000, 'a');
    }

    public function benchExample()
    {
        $result = '';
        foreach($this->chars as $char) {
            $result .= $char;
        }
    }
}
