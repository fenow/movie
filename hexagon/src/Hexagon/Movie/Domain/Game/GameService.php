<?php

namespace Hexagon\Movie\Domain\Game;

use Hexagon\Movie\Domain\Game\Model\Question;
use Hexagon\Movie\Domain\Themoviedb\Populator\QuestionPopulator;
use Hexagon\Movie\Infrastructure\GameRepository;
use Hexagon\Movie\Infrastructure\QuestionRepository;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GameService
{
    /**
     * @var GameRepository
     */
    private $gameRepository;
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
     * @param GameRepository $gameRepository
     * @param QuestionRepository $questionRepository
     * @param QuestionPopulator $questionPopulator
     */
    public function __construct(GameRepository $gameRepository, QuestionRepository $questionRepository, QuestionPopulator $questionPopulator)
    {
        $this->gameRepository = $gameRepository;
        $this->questionRepository = $questionRepository;
        $this->questionPopulator = $questionPopulator;
    }

    /**
     * @param string $page
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function populate(string $page)
    {
        $this->questionPopulator->populate();
    }

    public function getQuestion(): Question
    {
        return $this->questionRepository->getQuestion();
    }
}