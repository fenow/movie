<?php


namespace Hexagon\Movie\Domain\Themoviedb\Api\Person;

use Hexagon\Movie\Domain\Themoviedb\Api\AbstractCallApi;

class PopularApi extends AbstractCallApi
{
    /**
     * @inheritDoc
     */
    function getVerb(): string
    {
        return 'person/popular';
    }

    /**
     * @inheritDoc
     */
    function getMethod(): string
    {
        return 'GET';
    }
}