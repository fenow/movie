<?php

namespace Hexagon\Movie\Infrastructure;

use Predis\ClientInterface;

/**
 * Class MovieRepository
 * @package Hexagon\Movie\Application\Infrastructure
 */
class MovieRepository
{
    /**
     * @var ClientInterface
     */
    private $redis;

    public function __construct(ClientInterface $sncRedisDefault)
    {
        $this->redis = $sncRedisDefault;
    }
}