<?php

namespace Hiccup\SuluBlogBundle\Manager;

use Hiccup\SuluBlogBundle\Entity\Post;
use Hiccup\SuluBlogBundle\Exception\ValidationFailedException;
use Hiccup\SuluBlogBundle\Repository\PostRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostManager
{

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var PostRepository
     */
    private $repository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    #----------------------------------------------------------------------------------------------
    # Magic methods
    #----------------------------------------------------------------------------------------------

    /**
     * @param PostRepository $repository
     * @param ValidatorInterface $validator
     */
    public function __construct(PostRepository $repository, ValidatorInterface $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @param Post $post
     */
    public function save(Post $post)
    {
        $errors = $this->validator->validate($post);
        
        if ($errors->count() > 0) {
            throw new ValidationFailedException($errors);
        }

        $this->repository->save($post);
    }

    /**
     * @param Post $post
     */
    public function remove(Post $post)
    {
        $this->repository->remove($post);
    }
}
