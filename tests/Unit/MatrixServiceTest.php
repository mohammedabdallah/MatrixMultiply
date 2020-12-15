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
}
