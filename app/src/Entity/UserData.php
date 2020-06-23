<?php
/**
 * UserData entity.
 */
namespace App\Entity;

use App\Repository\UserDataRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserDataRepository::class)
 * @ORM\Table(name="users_data")
 */
class UserData
{
    /**
     * Id.
     *
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Nickname.
     *
     * @var string
     *
     * @Assert\NotBlank
     *
     * @Assert\Length(
     *     min="3",
     *     max="45",
     *     )
     * @ORM\Column(type="string", length=45)
     */
    private $nickname;

    /**
     * Name.
     *
     * @var string
     *
     * @Assert\NotBlank
     *
     * @Assert\Length(
     *     min="3",
     *     max="45",
     *     )
     *
     * @ORM\Column(type="string", length=45)
     *
     * @ORM\Column(type="string", length=45)
     */
    private $name;

    /**
     * Surname.
     *
     * @var string
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min="3",
     *     max="45",
     *     )
     * @ORM\Column(type="string", length=45)
     */
    private $surname;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="userData", cascade={"persist", "remove"})
     */
    private $identity;

    /**
     * Getter for id.
     *
     * @return int|null Result
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for nickname.
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * Setter for nickname.
     *
     * @return $this
     */
    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Getter for nickname.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Setter for name.
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Getter for surname.
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * Setter for Surname.
     *
     * @return $this
     */
    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Getter for identity.
     */
    public function getIdentity(): ?User
    {
        return $this->identity;
    }

    /**
     * Setter for Identity.
     *
     * @return $this
     */
    public function setIdentity(?User $identity): self
    {
        $this->identity = $identity;

        return $this;
    }
    public function __toString() {
        return $this->nickname;
    }

}
