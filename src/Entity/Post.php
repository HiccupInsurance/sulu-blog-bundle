<?php

namespace Hiccup\SuluBlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="hiccup_sulu_blog_post")
 * @ORM\Entity(repositoryClass="Hiccup\SuluBlogBundle\Repository\PostRepository")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @Serializer\ExclusionPolicy("all")
 *
 * @codeCoverageIgnore
 */
class Post
{

    #----------------------------------------------------------------------------------------------
    # Constants
    #----------------------------------------------------------------------------------------------

    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';

    #----------------------------------------------------------------------------------------------
    # Properties
    #----------------------------------------------------------------------------------------------

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\ReadOnly
     * @Serializer\Expose
     * @Serializer\Type("integer")
     * @Serializer\Groups({"post"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     *
     * @Assert\NotNull()
     * @Assert\Type(type="string")
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\Groups({"post"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="headline", type="string", length=255)
     *
     * @Assert\NotNull()
     * @Assert\Type(type="string")
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\Groups({"post"})
     */
    private $headline;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     *
     * @Assert\NotNull()
     * @Assert\Type(type="string")
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\Groups({"post"})
     */
    private $content;

    /**
     * @var \DateTime
     
     * @ORM\Column(name="published_date", type="datetime")
     *
     * @Assert\NotNull()
     * @Assert\Type(type="DateTime")
     * 
     * @Serializer\Expose
     * @Serializer\Type("DateTime")
     * @Serializer\Groups({"post"})
     */
    private $publishedDate;

    /**
     * @var array
     *
     * @ORM\Column(name="tags", type="array")
     *
     * @Assert\NotNull()
     * @Assert\Type(type="array")
     * 
     * @Serializer\Expose
     * @Serializer\Type("array")
     * @Serializer\Groups({"post"})
     */
    private $tags = [];

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string")
     *
     * @Assert\NotNull()
     * @Assert\Type(type="string")
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\Groups({"post"})
     */
    private $status = self::STATUS_DRAFT;

    #----------------------------------------------------------------------------------------------
    # Properties accessor
    #----------------------------------------------------------------------------------------------

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedDate()
    {
        return $this->publishedDate;
    }

    /**
     * @param \DateTime $publishedDate
     */
    public function setPublishedDate(\DateTime $publishedDate)
    {
        $this->publishedDate = $publishedDate;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @param string $headline
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

}
