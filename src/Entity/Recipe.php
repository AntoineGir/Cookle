<?php

namespace App\Entity;

use App\Controller\EvaluationController;
use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $extrainfo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adjustments;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredient::class, inversedBy="recipes")
     */
    private $ingredient;

    /**
     * @ORM\ManyToOne(targetEntity=CourseType::class, inversedBy="recipes")
     */
    private $CourseType;

    /**
     * @ORM\ManyToOne(targetEntity=Source::class, inversedBy="recipes")
     */
    private $source;

    /**
     * @ORM\OneToMany(targetEntity=Evaluation::class, mappedBy="recipe")
     */
    private $evaluation;

    /**
     * @ORM\OneToMany(targetEntity=CookingHistory::class, mappedBy="recipe")
     */
    private $cookingHistory;

    public function __construct()
    {
        $this->ingredient = new ArrayCollection();
        $this->evaluation = new ArrayCollection();
        $this->cookingHistory = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getExtrainfo(): ?string
    {
        return $this->extrainfo;
    }

    public function setExtrainfo(string $extrainfo): self
    {
        $this->extrainfo = $extrainfo;

        return $this;
    }

    public function getAdjustments(): ?string
    {
        return $this->adjustments;
    }

    public function setAdjustments(string $adjustments): self
    {
        $this->adjustments = $adjustments;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredient(): Collection
    {
        return $this->ingredient;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredient->contains($ingredient)) {
            $this->ingredient[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        $this->ingredient->removeElement($ingredient);

        return $this;
    }

    public function getCourseType(): ?CourseType
    {
        return $this->CourseType;
    }

    public function setCourseType(?CourseType $CourseType): self
    {
        $this->CourseType = $CourseType;

        return $this;
    }

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(?Source $source): self
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return Collection|Evaluation[]
     */
    public function getEvaluation(): Collection
    {
        return $this->evaluation;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluation->contains($evaluation)) {
            $this->evaluation[] = $evaluation;
            $evaluation->setRecipe($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluation->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getRecipe() === $this) {
                $evaluation->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CookingHistory[]
     */
    public function getCookingHistory(): Collection
    {
        return $this->cookingHistory;
    }

    public function addCookingHistory(CookingHistory $cookingHistory): self
    {
        if (!$this->cookingHistory->contains($cookingHistory)) {
            $this->cookingHistory[] = $cookingHistory;
            $cookingHistory->setRecipe($this);
        }

        return $this;
    }

    public function removeCookingHistory(CookingHistory $cookingHistory): self
    {
        if ($this->cookingHistory->removeElement($cookingHistory)) 
        {
            // set the owning side to null (unless already changed)
            if ($cookingHistory->getRecipe() === $this) {
                $cookingHistory->setRecipe(null);
            }
        }

        return $this;
    }

    //faire la moyenne des évalutions pour une recette
    public function calcAverageEval(): float
    {
        $comtpeur = 1;
        $note = 0;
        foreach ( $this->evaluation as $eval) 
        {
            $note = $note + $eval->getStar();
            $comtpeur++;
        }
        
        if ($comtpeur > 0)
        {
        $note = $note / $comtpeur;
        }

        else{
            $note = -1;
        }

        return $note;
    }
}
