<?php

namespace Hexagon\Movie\Domain\Themoviedb\Api;

use stdClass;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class AbstractCallApi
 * @package Hexagon\Movie\Domain\Themoviedb\Api
 */
abstract class AbstractCallApi
{
    private const URI = 'https://api.themoviedb.org/3/';

    /** @var HttpClientInterface $httpClient */
    protected $httpClient;

    /**
     * @var string
     */
    private $theMovieDbToken;
    /**
     * @var string
     */
    private $appLanguage;

    /**
     * @return string
     */
    abstract function getVerb(): string;

    /**
     * @return string
     */
    abstract function getMethod(): string;

    /**
     * AbstractCallApi constructor.
     * @param string $theMovieDbToken
     * @param string $appLanguage
     */
    public function __construct(string $theMovieDbToken, string $appLanguage)
    {
        $this->httpClient = HttpClient::create();
        $this->theMovieDbToken = $theMovieDbToken;
        $this->appLanguage = $appLanguage;
    }

    /**
     * @return string
     */
    private function makeUrl(): string
    {
        return sprintf('%s%s', self::URI, $this->getVerb());
    }

    /**
     * @param array $query
     *
     * @return string
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function makeCall(array $query = array()): stdClass
    {
        $query = array_merge([
            'api_key' => $this->theMovieDbToken,
            'language' => $this->appLanguage
        ], $query);

        $result = $this->httpClient->request($this->getMethod(), $this->makeUrl(), [
            'query' => $query
        ])->getContent();

        return json_decode($result);
    }
}