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

    /**
     * @return bool
     */
    private function initPage(): bool
    {
        $key = sprintf('%s%s', self::PREFIX, 'page');
        $this->redis->set($key, 1);

        return true;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        $key = sprintf('%s%s', self::PREFIX, 'page');
        $page = $this->redis->get($key);

        if(null === $page) {
            $this->initPage();
            return 1;
        }

        return $page;
    }

    /**
     * @return bool
     */
    public function incrPage(): bool
    {
        $key = sprintf('%s%s', self::PREFIX, 'page');
        $page = $this->redis->get($key);

        if(null === $page) {
            return $this->initPage();
        }

        $this->redis->incrby($key, 1);
        return true;
    }
}