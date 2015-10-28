<?php

namespace MessagePack\Tests\Benchmark;

use MessagePack\Packer;

class Packing implements Benchmark
{
    private $size;
    private $packer;

    public function __construct($size, Packer $packer = null)
    {
        $this->size = $size;
        $this->packer = $packer ?: new Packer();
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return get_class($this->packer);
    }

    /**
     * {@inheritdoc}
     */
    public function measure($raw, $packed)
    {
        $totalTime = 0;

        for ($i = $this->size; $i; $i--) {
            $time = microtime(true);
            $this->packer->pack($raw);
            $totalTime += microtime(true) - $time;
        }

        return $totalTime;
    }
}