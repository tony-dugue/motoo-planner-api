<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SuggestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SuggestionRepository::class)
 * @ApiResource()
 * @ORM\HasLifecycleCallbacks()
 */
class Suggestion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:roadbook"})
     * @Assert\NotBlank(message="Une adresse est obligatoire")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=180)
     * @Groups({"read:roadbook"})
     * @Assert\NotBlank(message="Une ville est obligatoire")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=80)
     * @Groups({"read:roadbook"})
     * @Assert\NotBlank(message="Un code postal est obligatoire")
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:roadbook"})
     * @Assert\NotBlank(message="Un pays est obligatoire")
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Groups({"read:roadbook"})
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:roadbook"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Une latitude est obligatoire")
     */
    private $suggestLat;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Une longitude est obligatoire")
     */
    private $suggestLong;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="suggestions")
     * @Groups({"read:roadbook"})
     */
    private $categories;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:roadbook"})
     * @Assert\NotBlank(message="Un nom est obligatoire")
     */
    private $name;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSuggestLat(): ?float
    {
        return $this->suggestLat;
    }

    public function setSuggestLat(float $suggestLat): self
    {
        $this->suggestLat = $suggestLat;

        return $this;
    }

    public function getSuggestLong(): ?float
    {
        return $this->suggestLong;
    }

    public function setSuggestLong(float $suggestLong): self
    {
        $this->suggestLong = $suggestLong;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist() {
        $this->setCreatedAt(new \DateTime());
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString() {
        return $this->getName();
    }
}
