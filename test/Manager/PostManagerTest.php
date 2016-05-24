<?php

namespace Test\Manager;

use Hiccup\SuluBlogBundle\Entity\Post;
use Hiccup\SuluBlogBundle\Manager\PostManager;
use Hiccup\SuluBlogBundle\Repository\PostRepository;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostManagerTest extends \PHPUnit_Framework_TestCase
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var PostManager
     */
    private $manager;

    /**
     * @var ObjectProphecy|PostRepository
     */
    private $repository;

    /**
     * @var ObjectProphecy|ValidatorInterface
     */
    private $validator;

    /**
     * @var ObjectProphecy|Post
     */
    private $post;

    /**
     * @var ObjectProphecy|ConstraintViolationListInterface
     */
    private $violationList;

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @group unit
     */
    public function testSave()
    {
        $this->validator->validate($this->post->reveal())->shouldBeCalledTimes(1)
            ->willReturn($this->violationList->reveal());

        $this->violationList->count()->shouldBeCalledTimes(1)->willReturn(0);
        $this->repository->save($this->post->reveal())->shouldBeCalledTimes(1);

        $this->manager->save($this->post->reveal());
    }

    /**
     * @group unit
     * @expectedException \Hiccup\SuluBlogBundle\Exception\ValidationFailedException
     */
    public function testSaveThrowValidationFailedException()
    {
        $this->validator->validate($this->post->reveal())->shouldBeCalledTimes(1)
            ->willReturn($this->violationList->reveal());

        $this->violationList->count()->shouldBeCalled()->willReturn(1);
        $this->violationList->rewind()->shouldBeCalled();
        $this->violationList->valid()->shouldBeCalled();

        $this->manager->save($this->post->reveal());
    }

    /**
     * @group unit
     */
    public function testRemove()
    {
        $this->repository->remove($this->post->reveal())->shouldBeCalledTimes(1);

        $this->manager->remove($this->post->reveal());
    }

    #----------------------------------------------------------------------------------------------
    # Protected methods
    #----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->repository = $this->prophesize(PostRepository::class);
        $this->validator = $this->prophesize(ValidatorInterface::class);
        $this->post = $this->prophesize(Post::class);
        $this->violationList = $this->prophesize(ConstraintViolationListInterface::class);

        $this->manager = new PostManager($this->repository->reveal(), $this->validator->reveal());
    }
}
