<?php

namespace App\Services;

class MatrixService
{

    /**
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
}
