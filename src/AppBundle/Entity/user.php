<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * user
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\userRepository")
 */
class user
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="plainPassword", type="string", length=255)
     */
    private $plainPassword;


    /**
     * @ORM\Column(name="roles", type="integer", nullable=true)
     */
    private $roles;


    /**
     * @var bool
     *
     * @ORM\Column(name="isScientist", type="boolean", nullable=true)
     */
    private $isScientist;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="universityName", type="string", length=255, nullable=true)
     */
    private $universityName;

    /**
     * @var string
     *
     * @ORM\Column(name="avataruri", type="string", length=255)
     */
    private $avataruri;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return user
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set plainPassword.
     *
     * @param string $plainPassword
     *
     * @return user
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Get plainPassword.
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set isScientist.
     *
     * @param bool $isScientist
     *
     * @return user
     */
    public function setIsScientist($isScientist)
    {
        $this->isScientist = $isScientist;

        return $this;
    }

    /**
     * Get isScientist.
     *
     * @return bool
     */
    public function getIsScientist()
    {
        return $this->isScientist;
    }

    /**
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return user
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName.
     *
     * @param string $lastName
     *
     * @return user
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set universityName.
     *
     * @param string $universityName
     *
     * @return user
     */
    public function setUniversityName($universityName)
    {
        $this->universityName = $universityName;

        return $this;
    }

    /**
     * Get universityName.
     *
     * @return string
     */
    public function getUniversityName()
    {
        return $this->universityName;
    }

    /**
     * Set avataruri.
     *
     * @param string $avataruri
     *
     * @return user
     */
    public function setAvataruri($avataruri)
    {
        $this->avataruri = $avataruri;

        return $this;
    }

    /**
     * Get avataruri.
     *
     * @return string
     */
    public function getAvataruri()
    {
        return $this->avataruri;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return trim($this->getFirstName() . ' ' . $this->getLastName());
    }
}
