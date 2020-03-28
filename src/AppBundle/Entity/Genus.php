<?php
/**
 * Created by PhpStorm.
 * User: leaphu
 * Date: 2017/7/7
 * Time: 上午1:00
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenusRepository")
 * @ORM\Table(name="genus")
 */
class Genus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", unique=true)
     */
    private $slug;

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }


    /**
     * @ORM\Column(type="string")
     */
    private $subFamily;

    /**
     * @ORM\Column(type="integer")
     */
    private $speciesCount;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $funFact;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished = true; # hae default value

    /**
     * @ORM\OneToMany(targetEntity="GenusNote",mappedBy="genus")
     * @ORM\OrderBy({"createAt"="DESC"})
     */
    private $notes;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\user", inversedBy="studiedGenuses")
     * @ORM\JoinTable(name="genus_scientist")
     */
    private $genusScientist;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->genusScientist = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSubFaminy()
    {
        return $this->subFamily;
    }

    /**
     * @param mixed $subFamily
     */
    public function setSubFamily($subFamily)
    {
        $this->subFamily = $subFamily;
    }

    /**
     * @return mixed
     */
    public function getSpeciesCount()
    {
        return $this->speciesCount;
    }

    /**
     * @param mixed $speciesCount
     */
    public function setSpeciesCount($speciesCount)
    {
        $this->speciesCount = $speciesCount;
    }

    /**
     * @return mixed
     */
    public function getFunFact()
    {
//        return '**TEST**';
        return $this->funFact;
    }

    /**
     * @param mixed $funFact
     */
    public function setFunFact($funFact)
    {
        $this->funFact = $funFact;
    }

    public function getUpdatedAt()
    {
        return new \DateTime('-'.rand(0,100).' days');
    }

    /**
     * @param mixed $isPublished
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    }

    /**
     * @return ArrayCollection|GenusNote[]
     */
    public function getNotes()
    {
        return $this->notes;
    }

    public function addGenusScientist(User $user)
    {
        if ($this->genusScientist->contains($user)) {
            return;
        }
        $this->genusScientist[] = $user;
    }

    /**
     * @return ArrayCollection|User[]
     */
    public function getGenusScientist()
    {
        return $this->genusScientist;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    public function removeGenusScientist(User $user)
    {
        $this->genusScientist->removeElement($user);
    }
}