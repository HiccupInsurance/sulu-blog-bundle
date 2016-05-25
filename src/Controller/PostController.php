<?php

namespace Hiccup\SuluBlogBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Hiccup\SuluBlogBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as FrameworkExtra;
use Sulu\Component\Rest\ListBuilder\Doctrine\FieldDescriptor\DoctrineFieldDescriptor;
use Sulu\Component\Rest\ListBuilder\ListRepresentation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PostController
 * @package Hiccup\SuluBlogBundle\Controller
 * @Rest\NamePrefix("hiccup_sulu_blog_post_")
 */
class PostController extends FOSRestController
{

    #----------------------------------------------------------------------------------------------
    # Constants
    #----------------------------------------------------------------------------------------------

    const ENTITY_NAME = 'HiccupSuluBlogBundle:Post';

    #----------------------------------------------------------------------------------------------
    # Public methods
    #----------------------------------------------------------------------------------------------

    /**
     * @Rest\Get("posts")
     * @Rest\View(serializerGroups={"post"})
     *
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request)
    {
        $restHelper = $this->get('sulu_core.doctrine_rest_helper');
        $factory = $this->get('sulu_core.doctrine_list_builder_factory');

        $listBuilder = $factory->create(self::ENTITY_NAME);
        $restHelper->initializeListBuilder($listBuilder, $this->getFieldDescriptors());
        $results = $listBuilder->execute();

        $list = new ListRepresentation(
            $results,
            'data-items',
            'hiccup_sulu_blog_post_get_fields',
            $request->query->all(),
            $listBuilder->getCurrentPage(),
            $listBuilder->getLimit(),
            $listBuilder->count()
        );

        $view = $this->view($list, 200);

        return $this->handleView($view);
    }

    /**
     * Returns all fields that can be used by list.
     *
     * @Rest\Get("post-fields")
     *
     * @return Response
     */
    public function getFieldsAction()
    {
        return $this->handleView($this->view(array_values($this->getFieldDescriptors())));
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
        $post = $this->get('hiccup_sulu_blog.utility.serializer')->deserialize($request->getContent(), Post::class);
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
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function putAction(Request $request, Post $post)
    {
        $post = $this->get('hiccup_sulu_blog.utility.serializer')->apply($post, $request->getContent());

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

    #----------------------------------------------------------------------------------------------
    # Private methods
    #----------------------------------------------------------------------------------------------

    /**
     * Returns array of existing field-descriptors.
     *
     * @return array
     */
    private function getFieldDescriptors()
    {
        return [
            'id' => new DoctrineFieldDescriptor(
                'id',
                'id',
                self::ENTITY_NAME,
                'public.id',
                [],
                true
            ),
            'title' => new DoctrineFieldDescriptor(
                'title',
                'title',
                self::ENTITY_NAME,
                'public.title'
            ),
            'headline' => new DoctrineFieldDescriptor(
                'headline',
                'headline',
                self::ENTITY_NAME,
                'public.headline'
            ),
            'content' => new DoctrineFieldDescriptor(
                'content',
                'content',
                self::ENTITY_NAME,
                'news.content'
            ),
            'publishedDate' => new DoctrineFieldDescriptor(
                'publishedDate',
                'publishedDate',
                self::ENTITY_NAME,
                'news.publishedDate'
            ),
            'tags' => new DoctrineFieldDescriptor(
                'tags',
                'tags',
                self::ENTITY_NAME,
                'news.tags'
            ),
            'status' => new DoctrineFieldDescriptor(
                'status',
                'status',
                self::ENTITY_NAME,
                'news.status'
            ),
            'createdAt' => new DoctrineFieldDescriptor(
                'createdAt',
                'createdAt',
                self::ENTITY_NAME,
                'news.createdAt'
            ),
            'updatedAt' => new DoctrineFieldDescriptor(
                'updatedAt',
                'updatedAt',
                self::ENTITY_NAME,
                'news.updatedAt'
            )
        ];
    }
}
