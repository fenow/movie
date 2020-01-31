<?php


namespace Hexagon\Movie\Domain\Game\Model;

/**
 * Class Answer
 * @package Hexagon\Movie\Domain\Game\Model
 */
class Answer
{
    /**
     * @var boolean
     */
    private $correct;

    /**
     * Answer constructor.
     * @param bool $correct
     */
    public function __construct(bool $correct)
    {
        $this->correct = $correct;
    }

    /**
     * @return bool
     */
    public function isCorrect(): bool
    {
        return $this->correct;
    }


}