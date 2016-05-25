<?php

namespace Test\Utility;

use Hiccup\SuluBlogBundle\Entity\Post;
use Hiccup\SuluBlogBundle\Utility\SerializerUtility;
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
     * @var SerializerInterface|ObjectProphecy
     */
    private $serializer;

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
    public function testDeserialize()
    {
        $data = json_encode(['title' => 'alpha']);
        $this->serializer->deserialize($data, Post::class, 'json')->shouldBeCalledTimes(1)
            ->willReturn($this->object->reveal());

        $this->utility->deserialize($data, Post::class);
    }

    /**
     * @group unit
     */
    public function testApply()
    {
        $data = json_encode(['title' => 'alpha']);
        $this->object->setTitle('alpha')->shouldBeCalledTimes(1);

        $this->utility->apply($this->object->reveal(), $data);
    }

    /**
     * @group unit
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method "setNotExistedArray" not exist
     */
    public function testApplyThrowBadMethodCallException()
    {
        $data = json_encode(['notExistedArray' => 'alpha']);

        $this->utility->apply($this->object->reveal(), $data);
    }

    #----------------------------------------------------------------------------------------------
    # Protected methods
    #----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->serializer = $this->prophesize(SerializerInterface::class);
        $this->utility = new SerializerUtility($this->serializer->reveal());

        $this->object = $this->prophesize(Post::class);
    }
}
