<?php

namespace Hexagon\Movie\Infrastructure;

use Hexagon\Movie\Domain\Game\Model\Question;
use Predis\ClientInterface;

/**
 * Class GameRepository
 * @package Hexagon\Movie\Application\Infrastructure
 */
class GameRepository
{
    /**
     * @var string
     */
    private const PREFIX = 'game:';

    /**
     * @var ClientInterface
     */
    private $redis;

    /**
     * QuestionRepository constructor.
     * @param ClientInterface $sncRedisDefault
     */
    public function __construct(ClientInterface $sncRedisDefault)
    {
        $this->redis = $sncRedisDefault;
    }
}