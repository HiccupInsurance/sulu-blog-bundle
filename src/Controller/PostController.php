<?php

namespace Hiccup\SuluBlogBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Hiccup\SuluBlogBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PostController
 * @package Hiccup\SuluBlogBundle\Controller
 * @Rest\NamePrefix("hiccup_sulu_blog_post_")
 */
class PostController extends FOSRestController
{

    /**
     * @Rest\Get("posts")
     * @Rest\View(serializerGroups={"post"})
     *
     * @return array
     */
    public function listAction()
    {
        return [
            'test' => 'success'
        ];
    }

    /**
     * @Rest\Post("posts")
     * @Rest\View(serializerGroups={"post"})
     *
     * @param Request $request
     * @return Post
     */
    public function postAction(Request $request)
    {
        /** @var Post $post */
        $post = $this->get('serializer')->deserialize($request->getContent(), Post::class, 'json');
        $this->get('hiccup_sulu_blog.manager.post')->save($post);
        $this->getDoctrine()->getManager()->flush();

        return $this->handleView($this->view($post));
    }
}
