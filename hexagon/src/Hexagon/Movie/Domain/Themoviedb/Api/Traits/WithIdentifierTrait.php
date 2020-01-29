<?php

namespace Hexagon\Movie\Domain\Themoviedb\Api\Traits;

trait WithIdentifierTrait
{
    /**
     * @var string
     */
    private $identifier;

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;
        return $this;
    }
}