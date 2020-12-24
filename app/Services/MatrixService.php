<?php

namespace App\Services;

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
    public function multiplyTwoMatrix(array $firstMatrix, array $secondMatrix): array
    {
        $result = [];
        for ($firstMatrixCounter = 0; $firstMatrixCounter < count($firstMatrix); $firstMatrixCounter++) {
            for ($secondMatrixCounter = 0; $secondMatrixCounter < count($secondMatrix[1]); $secondMatrixCounter++) {
                $result[$firstMatrixCounter][$secondMatrixCounter] = 0;

                for ($resultMatrixCounter = 0; $resultMatrixCounter < count($firstMatrix[0]); $resultMatrixCounter++) {
                    $result[$firstMatrixCounter][$secondMatrixCounter] +=
                        (int)$firstMatrix[$firstMatrixCounter][$resultMatrixCounter]
                        *
                        (int)$secondMatrix[$resultMatrixCounter][$secondMatrixCounter];
                }
            }
        }

        return $result;
    }

    /**
     * @param array $matrix
     * @return array
     */
    public function transFormMatrixToExcelColumns(array $matrix): array
    {
        $result = [];
        for ($rowCounter = 0; $rowCounter < count($matrix); $rowCounter++) {
            for ($columnCounter = 0; $columnCounter < count($matrix[1]); $columnCounter++) {
                $result[$rowCounter][$columnCounter] = $this->generateCharFromNumber(
                    $matrix[$rowCounter][$columnCounter]
                );
            }
        }

        return $result;
    }

    /**
     * @param int $number
     * @return string
     */
    public function generateCharFromNumber(int $number): string
    {
        $letters = '';
        $positiveNumber = abs($number);
        while ($positiveNumber > 0) {
            if ($positiveNumber % 26 == 0) {
                $code = 26;
            } else {
                $code = $positiveNumber % 26;
            }

            $letters .= chr($code + 64);
            $positiveNumber = ($positiveNumber - $code) / 26;
        }
        if ($number < 0) {
            $letters .= '-';
        }
        return strtoupper(strrev($letters));
    }
}
