<?php

namespace Hexagon\Movie\Domain\Game\Model;

class Game
{
    /**
     * @var int
     */
    private $score = 0;

    /**
     * @var Question[]
     */
    private $questionsToPlay;

    /**
     * @var Question[]
     */
    private $questionsPlayed;
}