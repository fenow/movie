<?php

namespace Hexagon\Movie\Domain\Themoviedb\Model;

/**
 * Class Question
 * @package Hexagon\Movie\Domain\Themoviedb\Model
 */
class Question
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var bool
     */
    private $answer;

    /**
     * @var Movie
     */
    private $movie;

    /**
     * @var Person
     */
    private $person;

    /**
     * Question constructor.
     * @param string $id
     * @param bool $answer
     * @param Movie $movie
     * @param Person $person
     */
    public function __construct(string $id, bool $answer, Movie $movie, Person $person)
    {
        $this->id = $id;
        $this->answer = $answer;
        $this->person = $person;
        $this->movie = $movie;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function getAnswer(): bool
    {
        return $this->answer;
    }

    /**
     * @return Movie
     */
    public function getMovie(): Movie
    {
        return $this->movie;
    }

    /**
     * @return Person
     */
    public function getPerson(): Person
    {
        return $this->person;
    }


}