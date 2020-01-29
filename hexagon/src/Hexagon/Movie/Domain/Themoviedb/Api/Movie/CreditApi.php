<?php


namespace Hexagon\Movie\Domain\Themoviedb\Api\Movie;


use Hexagon\Movie\Domain\Themoviedb\Api\AbstractCallApi;
use Hexagon\Movie\Domain\Themoviedb\Api\Traits\WithIdentifierTrait;

/**
 * Class CreditApi
 * @package Hexagon\Movie\Domain\Themoviedb\Api\Movie
 */
class CreditApi extends AbstractCallApi
{
    use WithIdentifierTrait;

    /**
     * @inheritDoc
     */
    public function getVerb(): string
    {
        if(null === $this->identifier) {
            throw new \RuntimeException('Identifier is needeed');
        }

        return sprintf('movie/%s/credits', $this->identifier);
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return 'GET';
    }
}