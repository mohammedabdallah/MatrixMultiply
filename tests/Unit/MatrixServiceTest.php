<?php

namespace Tests\Unit;

use App\Services\MatrixService;
use PHPUnit\Framework\TestCase;

class MatrixServiceTest extends TestCase
{
    private $matrixService;

    protected function setUp(): void
    {
        $this->matrixService = app()->make(MatrixService::class);
    }

    /**
     * A basic test to make sure that the function return the right char which against it in excel columns
     *
     * @return void
     */
    public function testItReturnRightCharInExcel()
    {
        $char = $this->matrixService->generateCharFromNumber(28);

        $this->assertEquals('AB', $char);
    }

    public function testItMultiplicityTwoMatricesCorrectly()
    {
        $firstMatrix = [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9]
        ];
        $secondMatrix = [
            [1, 2, 1],
            [2, 4, 6],
            [7, 2, 5]
        ];
        $expectedResult = [
            [26, 16, 28],
            [56, 40, 64],
            [86, 64, 100]
        ];

        $result = $this->matrixService->multiplyTwoMatrix($firstMatrix, $secondMatrix);

        $this->assertEquals($expectedResult, $result);
    }
}
