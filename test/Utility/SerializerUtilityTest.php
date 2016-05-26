<?php

namespace Test\Utility;

use Hiccup\SuluBlogBundle\Constructor\ObjectConstructor;
use Hiccup\SuluBlogBundle\Entity\Post;
use Hiccup\SuluBlogBundle\Utility\SerializerUtility;
use JMS\Serializer\Construction\UnserializeObjectConstructor;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerInterface;
use Prophecy\Prophecy\ObjectProphecy;

class SerializerUtilityTest extends \PHPUnit_Framework_TestCase
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var SerializerUtility
     */
    private $utility;

    /**
     * @var Post|ObjectProphecy
     */
    private $object;

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @group unit
     */
    public function testInstance()
    {
        $this->assertInstanceOf(SerializerInterface::class, $this->utility);
    }

    /**
     * @group unit
     */
    public function testDeserialize()
    {
        $data = json_encode(['title' => 'alpha']);

        /** @var Post $object */
        $object = $this->utility->deserialize($data, Post::class, 'json');

        $this->assertInstanceOf(Post::class, $object);
        $this->assertEquals('alpha', $object->getTitle());
    }

    /**
     * @group unit
     */
    public function testSerialize()
    {
        $object = new Post();
        $object->setTitle('alpha');

        $serializedData = $this->utility->serialize($object, 'json');

        $this->assertEquals(json_encode(['title' => 'alpha', 'tags' => [], 'status' => 'draft']), $serializedData);
    }

    /**
     * @group unit
     */
    public function testApplyDiff()
    {
        $object = new Post();
        $object->setTitle('alpha');
        $object->setContent('beta');
        $data = json_encode(['title' => 'charlie']);

        /** @var Post $result */
        $result = $this->utility->applyDiff($object, $data, 'json');
        
        $this->assertInstanceOf(Post::class, $result);
        $this->assertEquals('charlie', $result->getTitle());
        $this->assertEquals('beta', $result->getContent());
    }

    #----------------------------------------------------------------------------------------------
    # Protected methods
    #----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->utility = new SerializerUtility(
            new ObjectConstructor(new UnserializeObjectConstructor()),
            new IdenticalPropertyNamingStrategy()
        );

        $this->object = $this->prophesize(Post::class);
    }
}
