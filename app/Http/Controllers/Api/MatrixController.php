<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MultiplyMatrixRequest;
use App\Services\MatrixService;

class MatrixController extends Controller
{
    private $matrixService;

    public function __construct(MatrixService $matrixService)
    {
        $this->matrixService = $matrixService;
    }

    public function multiply(MultiplyMatrixRequest $request): array
    {
        $result = $this->matrixService->multiplyTwoMatrix(
            $request->get('first_matrix'),
            $request->get('second_matrix')
        );
        return $this->matrixService->transFormMatrixToExcelColumns($result);
    }
}
