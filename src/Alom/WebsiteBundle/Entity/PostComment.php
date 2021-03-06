<?php
/**
 * This file is part of the Alom project.
 *
 * (c) Alexandre Salomé <alexandre.salome@gmail.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alom\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment on a blog post
 *
 * @author Alexandre Salomé <alexandre.salome@gmail.com>
 *
 * @ORM\Entity
 */
class PostComment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Email
     * @Assert\NotBlank
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Length(min=3)
     * @Assert\NotBlank
     */
    protected $fullname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Url(protocols={"http", "https"})
     */
    protected $website;

    /**
     * @ORM\Column(type="text")
     *
     * @Assert\Length(min=7, minMessage="Try to make a sentence")
     * @Assert\NotBlank
     */
    protected $body;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     *
     * @var Alom\Website\AlomWebsiteBundle\Post
     */
    protected $post;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $isModerated;

    public function __construct()
    {
        $this->createdAt   = new \DateTime();
        $this->isModerated = true;
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     */
    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Get Website
     *
     * @return string $website
     */
    public function getWebsite() {
        return $this->website;
    }

    /**
     * Set body of the comment
     *
     * @param string $body Body to set
     */
    public function setBody($body) {
        $this->body = $body;
    }

    /**
     * Body of the comment
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the creation date
     *
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt) {
        if (!$createdAt instanceof \DateTime) {
            $createdAt = new \DateTime($createdAt);
        }

        $this->createdAt = $createdAt;
    }

    /**
     * Get the creation date
     *
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function setPost($post)
    {
        $this->post = $post;
    }

    public function setWebsite($website)
    {
        $this->website = $website;
    }

    public function isModerated()
    {
        return $this->isModerated;
    }

    public function setIsModerated($isModerated)
    {
        $this->isModerated = $isModerated;
    }

    public function activate()
    {
        $this->isModerated = true;
    }

    public function inactivate()
    {
        $this->isModerated = false;
    }
}
