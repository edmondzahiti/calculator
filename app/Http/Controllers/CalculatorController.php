<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRequest;
use App\Http\Resources\CalculationCollection;
use App\Http\Resources\CalculationResource;
use App\Services\CalculatorService;

class CalculatorController extends Controller
{
    protected $calculatorService;

    public function __construct(CalculatorService $calculatorService)
    {
        $this->calculatorService = $calculatorService;
    }

    public function calculate(CalculateRequest $request)
    {
        return new CalculationResource($this->calculatorService->calculate($request->expression));
    }

    public function history()
    {
        return new CalculationCollection($this->calculatorService->getHistory());
    }
}
