<?php


namespace Hexagon\Movie\Domain\Game\Model;


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
     * @var string
     */
    private $movieTitle;

    /**
     * @var string
     */
    private $moviePoster;

    /**
     * @var string
     */
    private $actorName;

    /**
     * @var string
     */
    private $actorAvatar;

    /**
     * Question constructor.
     * @param string $id
     * @param bool $answer
     * @param string $movieTitle
     * @param string $moviePoster
     * @param string $actorName
     * @param string $actorAvatar
     */
    public function __construct(string $id, bool $answer, string $movieTitle, string $moviePoster, string $actorName, string $actorAvatar)
    {
        $this->id = $id;
        $this->answer = $answer;
        $this->movieTitle = $movieTitle;
        $this->moviePoster = $moviePoster;
        $this->actorName = $actorName;
        $this->actorAvatar = $actorAvatar;
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
     * @return string
     */
    public function getMovieTitle(): string
    {
        return $this->movieTitle;
    }

    /**
     * @return string
     */
    public function getMoviePoster(): string
    {
        return $this->moviePoster;
    }

    /**
     * @return string
     */
    public function getActorName(): string
    {
        return $this->actorName;
    }

    /**
     * @return string
     */
    public function getActorAvatar(): string
    {
        return $this->actorAvatar;
    }
}