<?php

namespace Hiccup\SuluBlogBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Hiccup\SuluBlogBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as FrameworkExtra;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @return Response
     */
    public function listAction()
    {
        return $this->handleView($this->view($this->get('hiccup_sulu_blog.repository.post')->findAll()));
    }

    /**
     * @Rest\Get("posts/{id}")
     * @Rest\View(serializerGroups={"post"})
     *
     * @FrameworkExtra\ParamConverter("post")
     *
     * @param Post $post
     * @return Response
     */
    public function getAction(Post $post)
    {
        return $this->handleView($this->view($post));
    }

    /**
     * @Rest\Post("posts")
     * @Rest\View(serializerGroups={"post"})
     *
     * @param Request $request
     * @return Response
     */
    public function postAction(Request $request)
    {
        /** @var Post $post */
        $post = $this->get('serializer')->deserialize($request->getContent(), Post::class, 'json');
        $this->get('hiccup_sulu_blog.manager.post')->save($post);
        $this->getDoctrine()->getManager()->flush();

        return $this->handleView($this->view($post));
    }

    /**
     * @Rest\Put("posts/{id}")
     * @Rest\View(serializerGroups={"post"})
     *
     * @FrameworkExtra\ParamConverter("post")
     *
     * @param Post $post
     * @return Response
     */
    public function putAction(Post $post)
    {
        

        return $this->handleView($this->view($post));
    }

    /**
     * @Rest\Delete("posts/{id}")
     * @Rest\View(serializerGroups={"post"})
     *
     * @FrameworkExtra\ParamConverter("post")
     *
     * @param Post $post
     * @return Response
     */
    public function deleteAction(Post $post)
    {
        $this->get('hiccup_sulu_blog.manager.post')->remove($post);
        $this->getDoctrine()->getManager()->flush();

        return $this->handleView($this->view());
    }
}
