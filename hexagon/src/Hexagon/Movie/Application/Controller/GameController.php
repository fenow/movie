<?php

namespace Hexagon\Movie\Application\Controller;

use Hexagon\Movie\Domain\Game\GameService;
use Hexagon\Movie\UiApi\Resource\QuestionResource;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Throwable;

/**
 * @Route("", name="api_movie_game_")
 */
class GameController extends AbstractController
{
    /**
     * @var GameService
     */
    private $gameService;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * GameController constructor.
     * @param GameService $gameService
     * @param SerializerInterface $serializer
     */
    public function __construct(GameService $gameService, SerializerInterface $serializer)
    {
        $this->gameService = $gameService;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/movie/game/play", name="question", methods={"GET"})
     * @SWG\Tag(name="Game")
     * @SWG\Get(
     *   summary="Get question about movie",
     *   @SWG\Response(response=200, description="Returns question", @Model(type=QuestionResource::class))
     * )
     */
    public function question()
    {
        $question = QuestionResource::fromObject($this->gameService->getQuestion());
        return new Response($this->serializer->serialize($question, 'json'), 200);
    }

    /**
     * @Route("/api/movie/game/play", name="answer", methods={"POST"})
     * @SWG\Tag(name="Game")
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
     * @Route("/api/movie/game/populate/{page}", name="populate", methods={"GET"})
     * @SWG\Tag(name="Game")
     * @SWG\Get(
     *   summary="Call this to populate questions",
     *   @SWG\Response(response=200, description="No response")
     * )
     */
    public function populate(int $page)
    {
        try {
            $this->gameService->populate($page);
        } catch (Throwable $e) {
            return new JsonResponse($e->getMessage(), 500);
        }

        return new JsonResponse();
    }
}