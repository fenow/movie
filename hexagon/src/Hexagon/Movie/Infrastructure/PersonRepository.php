<?php

namespace Hexagon\Movie\Infrastructure;

use Predis\ClientInterface;

/**
 * Class PersonRepository
 * @package Hexagon\Movie\Application\Infrastructure
 */
class PersonRepository
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