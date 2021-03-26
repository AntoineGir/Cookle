<?php

namespace App\Entity;

use App\Entity\Evaluation;
use App\Entity\Recipe;
use PHPUnit\Framework\TestCase;

class Calculator
{
    public function add(Recipe $evaluation)
    {

        $evaluation = Recipe->calcAverageEval();
        $result = $evaluation->add(4);

        $this->assertEquals(4, $result);
    }
}




