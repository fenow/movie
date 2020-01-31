<?php

namespace Hexagon\Movie\Domain\Game;

use Hexagon\Movie\Domain\Game\Model\Answer;
use Hexagon\Movie\Domain\Game\Model\Question;
use Hexagon\Movie\Domain\Themoviedb\Populator\QuestionPopulator;
use Hexagon\Movie\Infrastructure\QuestionRepository;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GameService
{
    /**
     * @var QuestionRepository
     */
    private $questionRepository;
    /**
     * @var QuestionPopulator
     */
    private $questionPopulator;

    /**
     * GameService constructor.
     * @param QuestionRepository $questionRepository
     * @param QuestionPopulator $questionPopulator
     */
    public function __construct(QuestionRepository $questionRepository, QuestionPopulator $questionPopulator)
    {
        $this->questionRepository = $questionRepository;
        $this->questionPopulator = $questionPopulator;
    }

    /**
     * @return Question
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getQuestion(): Question
    {
        if(0 === count($this->questionRepository->getQuestions())) {
            $this->questionPopulator->populate();
        }
        return $this->questionRepository->getQuestion();
    }

    /**
     * @param string $questionId
     * @param bool $answer
     *
     * @return Answer
     */
    public function isCorrect(string $questionId, bool $answer): Answer
    {
        $answer = new Answer(
            $this->questionRepository->isCorrect($questionId, $answer)
        );

        if(true === $answer->isCorrect()) {
            $this->questionRepository->consume($questionId);
        }

        return $answer;
    }
}