<?php

namespace App\tests\entity;

use App\Entity\Evaluation;
use App\Entity\Recipe;
use PHPUnit\Framework\TestCase;

class RecipeText extends TestCase
{
    /** @test */
    public function TestCalcAverageEval()
    {

        $recipe = new Recipe();

        $result = $recipe->calcAverageEval();

        $this->assertEquals(-1, $result);

        $evaluation = new Evaluation();
        $evaluation->setStar(2);
        $recipe->addEvaluation($evaluation);
        $result = $recipe->calcAverageEval();
        $this->assertEquals(2, $result);
    }
}




