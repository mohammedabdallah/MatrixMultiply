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
            ['Z', 'P', 'AB'],
            ['BD', 'AN', 'BL'],
            ['CH', 'BL', 'CV']
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
        $this->assertEquals('', $alphabet);
    }

}
