<?php

namespace Tests\Unit;

use App\Services\MatrixService;
use InvalidArgumentException;
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

        $result = $this->matrixService->multiplyTwoMatrix($firstMatrix, $secondMatrix,'alpha');
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
        $multiplicationResult = $this->matrixService->multiplyTwoMatrix($largeMatrix, $largeMatrix,'alpha');
        //Check columns and rows count
        $this->assertCount(6, $multiplicationResult);
    }

    /**
     * Test negative integers formatting
     *
     * @return void
     */
    public function testNegativeIntegersFormatting()
    {
        $alphabet = (new MatrixService())->generateCharFromNumber(-1,'alpha');
        $this->assertEquals("-A", $alphabet);

        $alphabet = (new MatrixService())->generateCharFromNumber(-4,'alpha');
        $this->assertEquals("-D", $alphabet);

        $alphabet = (new MatrixService())->generateCharFromNumber(-26,'alpha');
        $this->assertEquals("-Z", $alphabet);
    }

    /**
     * Test returning zero value
     *
     * @return void
     */
    public function testZeroValue()
    {
        $alphabet = (new MatrixService())->generateCharFromNumber(0,'alpha');

        //Currently returns an empty string, what can be done about it?
        $this->assertEquals('', $alphabet);
    }

    public function testItThrowExceptionWhenUseUnsuportedCoverterType()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->matrixService->generateCharFromNumber(27,'alphaaa');
    }
}
