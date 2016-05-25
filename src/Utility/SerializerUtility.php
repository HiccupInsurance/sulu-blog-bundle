<?php

namespace Hiccup\SuluBlogBundle\Utility;

use JMS\Serializer\SerializerInterface;

class SerializerUtility
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

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @param string $data
     * @param string $type
     * @return object
     */
    public function deserialize($data, $type)
    {
        return $this->serializer->deserialize($data, $type, self::FORMAT);
    }

    /**
     * Apple $data string into $object
     *
     * @param object $object
     * @param string $data new data to be applied
     * @return object
     */
    public function apply($object, $data)
    {
        $dataArray = json_decode($data);

        foreach ($dataArray as $property => $value) {
            $setter = $this->getSetter($property, $object);
            $object->$setter($value);
        }
        
        return $object;
    }

    #----------------------------------------------------------------------------------------------
    # Private methods
    #----------------------------------------------------------------------------------------------

    /**
     * @param string $property
     * @param object $entity
     *
     * @return string
     * @throws \BadMethodCallException
     */
    private function getSetter($property, $entity)
    {
        $setter = 'set' . ucfirst($property);
        if (method_exists($entity, $setter) === false) {
            throw new \BadMethodCallException(sprintf('Method "%s" not exist', $setter));
        }

        return $setter;
    }
}
