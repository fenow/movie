<?php

namespace Hexagon\Movie\UiApi\Resource;

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
 *     required={"name"},
 *     @SWG\Xml(
 *         name="question"
 *     )
 * )
 */
class QuestionResource
{
    /**
     * @SWG\Property(type="integer", description="Job's begin ID", example=2, readOnly=true)
     */
    public $id;

    /**
     * @SWG\Property(type="string", description="Name", example="toto")
     */
    public $name;

    /**
     * @var UrlGeneratorInterface
     * @Serializer\Exclude
     */
    private $urlGenerator;

    /**
     * SectorResource constructor.
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public static function fromObject(stdClass $object, UrlGeneratorInterface $urlGenerator)
    {
        $self = new static($urlGenerator);

        $self->id = $object->id ?? null;
        $self->name = 'toto';

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
