<?php

namespace Hiccup\SuluBlogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Hiccup\SuluBlogBundle\Entity\Post;

/**
 * Class PostRepository
 * @package Hiccup\SuluBlogBundle\Repository
 * @codeCoverageIgnore
 */
class PostRepository extends EntityRepository
{

    /**
     * @param Post $post
     */
    public function save(Post $post)
    {
        $this->getEntityManager()->persist($post);
    }

    /**
     * @param Post $post
     */
    public function remove(Post $post)
    {
        $this->getEntityManager()->remove($post);
    }
}
