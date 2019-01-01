<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The news article
 *
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\NewsArticleRepository")
 */
final class NewsArticle
{
    /**
     * @var int The id of the news article
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @var string The title of the news article
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="5", maxMessage="THIS IS A ERROR")
     */
    private $title;

    /**
     * @var string The body of the news article
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $body;

    /**
     * @var \DateTimeInterface The publication date
     * @ORM\Column(type="datetime_immutable")
     *
     * @Assert\NotBlank()
     */
    private $publicationDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="newsArticle")
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * @param mixed $publicationDate
     */
    public function setPublicationDate($publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setNewsArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getNewsArticle() === $this) {
                $comment->setNewsArticle(null);
            }
        }

        return $this;
    }
}
