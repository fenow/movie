<?php


namespace Hexagon\Movie\Domain\Themoviedb\Model;

/**
 * Class Movie
 * @package Hexagon\Movie\Domain\Themoviedb\Model
 */
class Movie
{
    /**
     * @var string
     */
    private const URI = 'https://image.tmdb.org/t/p/w500/';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $poster;

    /**
     * @var Person[]
     */
    private $persons;

    /**
     * Movie constructor.
     * @param string $id
     * @param string $name
     * @param string $poster
     * @param array $persons
     */
    public function __construct(string $id, string $name, string $poster, array $persons)
    {
        $this->id = $id;
        $this->name = $name;
        $this->poster = $poster;
        $this->persons = $persons;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPoster(): string
    {
        return sprintf('%s%s', self::URI, $this->poster);
    }

    /**
     * @return Person[]
     */
    public function getPersons(): array
    {
        return $this->persons;
    }


}