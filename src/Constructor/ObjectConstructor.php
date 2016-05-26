<?php

namespace Hiccup\SuluBlogBundle\Constructor;

use JMS\Serializer\Construction\ObjectConstructorInterface;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\VisitorInterface;

/**
 * Class ObjectConstructor
 * @package Hiccup\SuluBlogBundle\Constructor
 * @codeCoverageIgnore
 */
class ObjectConstructor implements ObjectConstructorInterface
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var ObjectConstructorInterface
     */
    private $fallbackConstructor;

    #----------------------------------------------------------------------------------------------
    # Magic methods
    #----------------------------------------------------------------------------------------------

    /**
     * Constructor.
     *
     * @param ObjectConstructorInterface $fallbackConstructor Fallback object constructor
     */
    public function __construct(ObjectConstructorInterface $fallbackConstructor)
    {
        $this->fallbackConstructor = $fallbackConstructor;
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function construct(
        VisitorInterface $visitor, 
        ClassMetadata $metadata, 
        $data, 
        array $type, 
        DeserializationContext $context
    ) {
        if ($context->attributes->containsKey('target') && $context->getDepth() === 1) {
            return $context->attributes->get('target')->get();
        }

        return $this->fallbackConstructor->construct($visitor, $metadata, $data, $type, $context);
    }
}
