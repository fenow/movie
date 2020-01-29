<?php

namespace Hexagon\Movie\Application\Controller;

use Hexagon\Movie\UiApi\Resource\QuestionResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Predis\ClientInterface;

/**
 * @Route("", name="api_movie_game_")
 */
class GameController extends AbstractController
{
    /**
     * @var ClientInterface
     */
    private $redis;

    public function __construct(ClientInterface $sncRedisDefault)
    {
        $this->redis = $sncRedisDefault;
    }

    /**
     * @Route("/api/movie/game/play", name="question", methods={"GET"})
     * @SWG\Tag(name="Movie")
     * @SWG\Get(
     *   summary="Get question about movie",
     *   @SWG\Response(response=200, description="Returns question", @Model(type=QuestionResource::class))
     * )
     */
    public function question()
    {
        $this->redis->set('tutu', 'titi');
        return new JsonResponse($this->redis->get('tutu'), 200);
    }

    /**
     * @Route("/api/movie/game/play", name="answer", methods={"POST"})
     * @SWG\Tag(name="Movie")
     * @SWG\Post(
     *   summary="Answer to the question",
     *   @SWG\Response(response=204, description="No response")
     * )
     */
    public function answer()
    {
        return new JsonResponse('toto', 204);
    }
}