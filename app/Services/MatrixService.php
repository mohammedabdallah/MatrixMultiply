<?php

namespace App\Services;

use App\Helpers\LoadClass;
use Exception;

class MatrixService
{

    /**
     * This function simply iterate over first matrix ro and second matrix columns to multiply them and count them
     * Time Complexity O(N^3)
     * We can minimize complexity using Strassen Algorithm to be O(N^2.8074) but it only sufficient for squared metrics
     * @param array $firstMatrix
     * @param array $secondMatrix
     * @return array
     */
    public function multiplyTwoMatrix(array $firstMatrix, array $secondMatrix, $convertType): array
    {
        $result = [];
        if ($firstMatrix == $secondMatrix) {
            $secondMatrix = $this->transposeMatrix($secondMatrix);
            //or using this pretty one    $secondMatrix = array_map(null, ...$matrix)
        }
        for ($firstMatrixCounter = 0; $firstMatrixCounter < count($firstMatrix); $firstMatrixCounter++) {
            for ($secondMatrixCounter = 0; $secondMatrixCounter < count($secondMatrix[1]); $secondMatrixCounter++) {
                $result[$firstMatrixCounter][$secondMatrixCounter] = 0;
                $resultedNumber = 0;
                for ($resultMatrixCounter = 0; $resultMatrixCounter < count($firstMatrix[0]); $resultMatrixCounter++) {
                    $resultedNumber +=
                        (int)$firstMatrix[$firstMatrixCounter][$resultMatrixCounter]
                        *
                        (int)$secondMatrix[$resultMatrixCounter][$secondMatrixCounter];
                }
                $result[$firstMatrixCounter][$secondMatrixCounter] = $this->generateCharFromNumber($resultedNumber, $convertType);
            }
        }
        return $result;
    }
    /**
     * @param int $number
     * @return string
     */
    public function generateCharFromNumber(int $number, $convertType)
    {
        $converter =  LoadClass::load($convertType);
        //handle if convert type not supported in our systme
        if (!class_exists($converter)) {
            throw new Exception("Error Processing Request", 1);
        }
        $instance  = new $converter();
        return  $instance->convert($number);
    }
    public function transposeMatrix($matrix)
    {
        $result = [];
        foreach ($matrix as $row => $columns) {
            foreach ($columns as $row2 => $column2) {
                $result[$row2][$row] = $column2;
            }
        }
        return $result;
    }
}
