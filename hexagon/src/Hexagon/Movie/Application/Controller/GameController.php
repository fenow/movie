<?php

namespace Hexagon\Movie\Application\Controller;

use Hexagon\Movie\UiApi\Resource\QuestionResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * @Route("", name="api_movie_game_")
 */
class GameController extends AbstractController
{
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
        return new JsonResponse('toto', 200);
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