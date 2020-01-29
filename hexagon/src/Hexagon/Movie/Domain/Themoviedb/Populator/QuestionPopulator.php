<?php

namespace Hexagon\Movie\Domain\Themoviedb\Populator;

use Hexagon\Movie\Domain\Themoviedb\Api\Movie\CreditApi;
use Hexagon\Movie\Domain\Themoviedb\Api\Movie\PopularApi as PopularMovie;
use Hexagon\Movie\Domain\Themoviedb\Api\Person\PopularApi as PopularPerson;
use Hexagon\Movie\Domain\Themoviedb\Model\Movie;
use Hexagon\Movie\Domain\Themoviedb\Model\Person;
use Hexagon\Movie\Domain\Themoviedb\Model\Question;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class MoviePopulator
 * @package Hexagon\Movie\Domain\Themoviedb\Populator
 */
class QuestionPopulator
{
    /**
     * @var CreditApi
     */
    private $creditApi;

    /**
     * @var PopularPerson
     */
    private $popularPerson;

    /**
     * @var PopularMovie
     */
    private $popularMovie;

    /**
     * @var Person[]
     */
    private $persons = [];

    /**
     * @var Movie[]
     */
    private $movies = [];

    /**
     * MoviePopulator constructor.
     * @param PopularMovie $popularMovie
     * @param CreditApi $creditApi
     * @param PopularPerson $popularPerson
     */
    public function __construct(PopularMovie $popularMovie, CreditApi $creditApi, PopularPerson $popularPerson)
    {
        $this->creditApi = $creditApi;
        $this->popularPerson = $popularPerson;
        $this->popularMovie = $popularMovie;
    }

    /**
     * @param int $page
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function populate(int $page = 1)
    {
        $this->getPersons($page);
        $this->getMovies($page);
        $questions = $this->setQuestions();
    }

    /**
     * @param int $page
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    private function getMovies(int $page)
    {
        $results = $this->popularMovie->makeCall([
            'page' => $page
        ])->results;

        foreach ($results as $result) {
            $persons = [];
            $credits = $this->creditApi->setIdentifier($result->id)->makeCall()->cast;

            foreach ($credits as $credit) {
                if(isset($credit->id) && isset($credit->name) && isset($credit->profile_path)) {
                    $persons[] = new Person($credit->id, $credit->name, $credit->profile_path);
                }
            }

            if(0 < count($persons) && isset($result->id) && isset($result->title) && isset($result->poster_path)) {
                $this->movies[] = new Movie($result->id, $result->title, $result->poster_path, $persons);
            }
        }
    }

    /**
     * @param int $page
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    private function getPersons(int $page)
    {
        $results = $this->popularPerson->makeCall([
            'page' => $page
        ])->results;

        foreach ($results as $result) {
            if(isset($result->id) && isset($result->name) && isset($result->profile_path)) {
                $this->persons[] = new Person($result->id, $result->name, $result->profile_path);
            }
        }
    }

    private function setQuestions(): array
    {
        $questions = [];
        $currentMovieCounter = 0;

        foreach ($this->movies as $movie) {
            if(true === (bool) ($currentMovieCounter % 2)) {
                $questions[] = $this->getTrueQuestion($movie);
            } else {
                $questions[] = $this->getFalseQuestion($movie);
            }

            $currentMovieCounter++;
        }

        return $questions;
    }

    private function getTrueQuestion(Movie $movie): Question
    {
        $persons = $movie->getPersons();
        $max = count($persons) - 1;
        $randomizedPerson = $persons[rand(0, $max)];

        return new Question($movie->getId(), true, $movie, $randomizedPerson);
    }

    private function getFalseQuestion(Movie $movie): Question
    {
        $answer = false;
        $max = count($this->persons) - 1;
        $randomizedPerson = $this->persons[rand(0, $max)];

        foreach ($movie->getPersons() as $person) {
            if($randomizedPerson->getId() === $person->getId()) {
                $answer = true;
                break;
            }
        }

        return new Question($movie->getId(), $answer, $movie, $randomizedPerson);
    }
}