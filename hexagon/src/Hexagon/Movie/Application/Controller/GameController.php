<?php

namespace Hexagon\Movie\Application\Controller;

use Hexagon\Movie\Domain\Themoviedb\Populator\PopulatorCollection;
use Hexagon\Movie\Domain\Themoviedb\Populator\QuestionPopulator;
use Hexagon\Movie\UiApi\Resource\QuestionResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Predis\ClientInterface;
use Throwable;

/**
 * @Route("", name="api_movie_game_")
 */
class GameController extends AbstractController
{
    /**
     * @var ClientInterface
     */
    private $redis;

    /**
     * @var QuestionPopulator
     */
    private $questionPopulator;

    /**
     * GameController constructor.
     * @param ClientInterface $sncRedisDefault
     * @param QuestionPopulator $questionPopulator
     */
    public function __construct(ClientInterface $sncRedisDefault, QuestionPopulator $questionPopulator)
    {
        $this->redis = $sncRedisDefault;
        $this->questionPopulator = $questionPopulator;
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

    /**
     * @Route("/api/movie/game/populate", name="question", methods={"GET"})
     * @SWG\Tag(name="Movie")
     * @SWG\Get(
     *   summary="Get question about movie",
     *   @SWG\Response(response=200, description="Returns question", @Model(type=QuestionResource::class))
     * )
     */
    public function populate()
    {
        try {
            $this->questionPopulator->populate();
        } catch (Throwable $e) {
            return new JsonResponse($e->getMessage(), 500);
        }

        return new JsonResponse();
    }
}