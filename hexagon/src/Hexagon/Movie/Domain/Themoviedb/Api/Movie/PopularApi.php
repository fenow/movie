<?php


namespace Hexagon\Movie\Domain\Themoviedb\Api\Movie;

use Hexagon\Movie\Domain\Themoviedb\Api\AbstractCallApi;

/**
 * Class PopularApi
 * @package Hexagon\Movie\Domain\Themoviedb\Api\Movie
 */
class PopularApi extends AbstractCallApi
{
    /**
     * @inheritDoc
     */
    function getVerb(): string
    {
        return 'movie/popular';
    }

    /**
     * @inheritDoc
     */
    function getMethod(): string
    {
        return 'GET';
    }
}