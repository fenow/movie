<?php

namespace Hexagon\Movie\Infrastructure;

use Hexagon\Movie\Domain\Game\Model\Question;
use Predis\ClientInterface;

/**
 * Class QuestionRepository
 * @package Hexagon\Movie\Application\Infrastructure
 */
class QuestionRepository
{
    private const FILEDS = [
        'id',
        'answer',
        'movieTitle',
        'moviePoster',
        'actorName',
        'actorAvatar'
    ];

    /**
     * @var string
     */
    private const PREFIX = 'question:';

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

    public function add(Question $question)
    {
        $key = sprintf('%s%s', self::PREFIX, $question->getId());
        $this->redis->hmset($key, [
                'id' => $question->getId(),
                'answer' => $question->getAnswer(),
                'movieTitle' => $question->getMovieTitle(),
                'moviePoster' => $question->getMoviePoster(),
                'actorName' => $question->getActorName(),
                'actorAvatar' => $question->getActorAvatar()
            ]
        );
    }

    /**
     * @return array
     */
    public function getQuestions(): array
    {
        return $this->redis->keys(self::PREFIX . '*');
    }

    /**
     * @return Question
     */
    public function getQuestion(): Question
    {
        $questions = $this->getQuestions();
        $max = count($questions) - 1;
        $questionId = $questions[rand(0, $max)];

        $result = $this->redis->hmget($questionId, self::FILEDS);

        return new Question(
            $result[0],
            $result[1],
            $result[2],
            $result[3],
            $result[4],
            $result[5]
        );
    }

    public function consume(Question $question): bool
    {
        $key = sprintf('%s%s', self::PREFIX, $question->getId());
        $this->redis->del([$key]);
    }
}