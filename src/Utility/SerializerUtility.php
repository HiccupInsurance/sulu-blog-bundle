<?php

namespace Hiccup\SuluBlogBundle\Utility;

use JMS\Serializer\Construction\ObjectConstructorInterface;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Naming\PropertyNamingStrategyInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class SerializerUtility implements SerializerInterface
{

    #----------------------------------------------------------------------------------------------
    # Constants
    #----------------------------------------------------------------------------------------------

    const FORMAT = 'json';

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var SerializerInterface
     */
    private $serializer;

    #----------------------------------------------------------------------------------------------
    # Magic methods
    #----------------------------------------------------------------------------------------------

    /**
     * SerializerUtility constructor.
     * @param ObjectConstructorInterface $objectConstructor
     * @param PropertyNamingStrategyInterface $namingStrategy
     */
    public function __construct(
        ObjectConstructorInterface $objectConstructor, 
        PropertyNamingStrategyInterface $namingStrategy
    ) {
        $this->serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy($namingStrategy)
            ->setObjectConstructor($objectConstructor)
            ->build();
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function deserialize($data, $type, $format, DeserializationContext $context = null)
    {
        return $this->serializer->deserialize($data, $type, $format, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function serialize($data, $format, SerializationContext $context = null)
    {
        return $this->serializer->serialize($data, $format, $context = null);
    }

    /**
     * Apple partial update to existing object
     *
     * @param object $object
     * @param string $data new data to be applied
     * @param string $format
     * @return object|mixed
     */
    public function applyDiff($object, $data, $format)
    {
        $context = new DeserializationContext();
        $context->attributes->set('target', $object);

        return $this->deserialize($data, get_class($object), $format, $context);
    }
}
