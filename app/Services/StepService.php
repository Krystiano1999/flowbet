<?php

namespace App\Services;

use App\Models\Step;

class StepService
{
    /**
     * Create a new step.
     *
     * @param array $data
     * @return Step
     */
    public function createStep(array $data): Step
    {
        return Step::create($data);
    }
}
