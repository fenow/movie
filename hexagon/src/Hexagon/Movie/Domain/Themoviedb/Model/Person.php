<?php


namespace Hexagon\Movie\Domain\Themoviedb\Model;

/**
 * Class Person
 * @package Hexagon\Movie\Domain\Themoviedb\Model
 */
class Person
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
    private $avatar;

    /**
     * Person constructor.
     * @param string $id
     * @param string $name
     * @param string $avatar
     */
    public function __construct(string $id, string $name, string $avatar)
    {
        $this->id = $id;
        $this->name = $name;
        $this->avatar = $avatar;
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
    public function getAvatar(): string
    {
        return sprintf('%s%s', self::URI, $this->avatar);
    }


}