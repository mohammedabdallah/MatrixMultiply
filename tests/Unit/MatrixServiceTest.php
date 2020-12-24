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
    /**
     * Test if it can handle a large matrix
     *
     * @return void
     */
    public function testItHandlesLargeMatrix()
    {
        $largeMatrix = [
            range(1, 1000),
            range(1, 1000),
            range(1, 1000),
            range(1, 1000),
            range(1, 1000),
            range(1, 1000)
        ];
        $multiplicationResult = $this->matrixService->multiplyTwoMatrix($largeMatrix, $largeMatrix);
        //Check columns and rows count
        $this->assertCount(6, $multiplicationResult);
        $this->assertCount(1000, $multiplicationResult[0]);
    }

    /**
     * Test negative integers formatting
     *
     * @return void
     */
    public function testNegativeIntegersFormatting()
    {
        $alphabet = (new MatrixService())->generateCharFromNumber(-1);
        $this->assertEquals("-A", $alphabet);

        $alphabet = (new MatrixService())->generateCharFromNumber(-4);
        $this->assertEquals("-D", $alphabet);

        $alphabet = (new MatrixService())->generateCharFromNumber(-26);
        $this->assertEquals("-Z", $alphabet);
    }

    /**
     * Test returning zero value
     *
     * @return void
     */
    public function testZeroValue()
    {
        $alphabet = (new MatrixService())->generateCharFromNumber(0);

        //Currently returns an empty string, what can be done about it?
        $this->assertEquals('',$alphabet);

    }

    /**
     * Test validation exception throwing when cell value is not a number
     *
     * @return void
     */
    public function testValidationExceptionIsThrownWhenMatrixHasNonNumericValues()
    {
        $matrixWithStringValue = [
            ['A', 2, 3],
            [2, 3,],
            [3, 4, 5]
        ];

        //Assert validation exception is thrown

        $matrixWithDecimalValue = [
            [1, 2, 3],
            [2, 3, 4],
            [3, 4, [1]]
        ];

        //Assert validation exception is thrown

        $matrixWithDecimalValue = [
            [1, 2, 3],
            [2, 3, 4],
            [3, 4, 5.5]
        ];

        //Assert validation exception is thrown

        $matrixWithBooleanValue = [
            [1, 2, 3],
            [2, 3, 4],
            [false, 4, 5]
        ];

        //Assert validation exception is thrown
    }
}
