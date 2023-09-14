<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use App\Controller\VideoFormType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 */
class Video
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="videos")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */

     // @Assert\Email(message = "The email '{{ value }}' is not a valid email.")
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 10, minMessage = "Video title must be at least {{ limit }} characters long", maxMessage = "Video title cannot be longer than {{ limit }} characters")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(
     * maxSize = "1024k"
     * mimeTypes = {"video/mp4", "application/pdf", "application/x-pdf"},
     * mimeTypesMessage = "Please upload a valid video."
     * )
     */
    private $file;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }
}
