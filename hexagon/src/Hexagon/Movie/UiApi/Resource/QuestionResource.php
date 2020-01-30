<?php

namespace Hexagon\Movie\UiApi\Resource;

use Hexagon\Movie\Domain\Game\Model\Question;
use JMS\Serializer\Annotation as Serializer;
use stdClass;
use Swagger\Annotations as SWG;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Serializer\XmlRoot("movie")
 *
 * @SWG\Schema(
 *     description="Question model",
 *     title="Question",
 *     required={"movieTitle"},
 *     @SWG\Xml(
 *         name="question"
 *     )
 * )
 */
class QuestionResource
{
    /**
     * @SWG\Property(type="string", description="Question id", example=2, readOnly=true)
     */
    public $id;

    /**
     * @SWG\Property(type="string", description="Movie title", example="Le mans 66")
     */
    public $movieTitle;

    /**
     * @SWG\Property(type="string", description="Movie poster", example="https://image.tmdb.org/t/p/w500//8yyRujXGSNCa3yrM3qoLZXUW3WY.jpg")
     */
    public $moviePoster;

    /**
     * @SWG\Property(type="string", description="Actor name", example="Sylvester Stallone")
     */
    public $actorName;

    /**
     * @SWG\Property(type="string", description="Actor avatar", example="https://image.tmdb.org/t/p/w500//gnmwOa46C2TP35N7ARSzboTdx2u.jpg")
     */
    public $actorAvatar;

    public static function fromObject(Question $question)
    {
        $self = new static();

        $self->id = $question->getId();
        $self->movieTitle = $question->getMovieTitle();
        $self->moviePoster = $question->getMoviePoster();
        $self->actorName = $question->getActorName();
        $self->actorAvatar = $question->getActorAvatar();

        return $self;
    }

    /**
     * @SWG\Property(
     *     property="_links", type="object",
     *     readOnly=true,
     *     @SWG\Property(
     *          property="self",
     *          @SWG\Property(
     *              property="href",
     *              type="string"
     *          )
     *     )
     * )
     * @Serializer\Exclude
     */
    public $links;
}
