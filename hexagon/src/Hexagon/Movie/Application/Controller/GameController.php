<?php

namespace Hexagon\Movie\Application\Controller;

use Hexagon\Movie\Domain\Game\GameService;
use Hexagon\Movie\UiApi\Resource\AnswerResource;
use Hexagon\Movie\UiApi\Resource\QuestionResource;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     *   @SWG\Response(response=200, description="Is user answer correctly to the question?", @Model(type=AnswerResource::class))
     * )
     */
    public function answer(Request $request)
    {
        $json = json_decode($request->getContent());

        if(isset($json->answer) && isset($json->questionId)) {
            $answer = AnswerResource::fromObject($this->gameService->isCorrect($json->questionId, $json->answer));
            return new Response($this->serializer->serialize($answer, 'json'), 200);
        }

        return new Response(null, 404);
    }
}