<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Programmer
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="programmer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProgrammerRepository")
 */
class Programmer
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
     * @Serializer\Expose()
     *
     * @ORM\Column(name="nickname", type="string", length=255)
     */
    private $nickname;

    /**
     * @var string
     *
     * @Serializer\Expose()
     * @ORM\Column(name="avatarNumber", type="string", length=255)
     */
    private $avatarNumber;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     *
     * @return Programmer
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set avatarNumber
     *
     * @param string $avatarNumber
     *
     * @return Programmer
     */
    public function setAvatarNumber($avatarNumber)
    {
        $this->avatarNumber = $avatarNumber;

        return $this;
    }

    /**
     * Get avatarNumber
     *
     * @return string
     */
    public function getAvatarNumber()
    {
        return $this->avatarNumber;
    }
}

