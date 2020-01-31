<?php

namespace Hexagon\Movie\UiApi\Resource;

use Hexagon\Movie\Domain\Game\Model\Answer;
use JMS\Serializer\Annotation as Serializer;
use Swagger\Annotations as SWG;

/**
 * @Serializer\XmlRoot("movie")
 *
 * @SWG\Schema(
 *     description="Answer model",
 *     title="Answer",
 *     required={"correct"},
 *     @SWG\Xml(
 *         name="answer"
 *     )
 * )
 */
class AnswerResource
{
    /**
     * @SWG\Property(type="boolean", description="Boolean to know if user answer correctly to the question", example=true, readOnly=true)
     */
    public $correct;

    /**
     * @param Answer $answer
     * @return static
     */
    public static function fromObject(Answer $answer)
    {
        $self = new static();

        $self->correct = $answer->isCorrect();

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
