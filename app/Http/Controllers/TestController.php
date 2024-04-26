<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        // $matriksKeputusan = [
        //     [0.5, 1, 0.7, 0.7, 0.8],
        //     [0.8, 0.7, 1, 0.5, 1],
        //     [1, 0.3, 0.4, 0.7, 1],
        //     [0.2, 1, 0.5, 0.9, 0.7],
        //     [1, 0.7, 0.4, 0.7, 1],
        // ];

        $matriksKeputusan = [
            [5, 10, 15,    6, 9,    50000],
            [5,    10,    15,    8, 9,    50000],
            [4,    10, 15, 6,    7, 300000],
            [4,    10,    15,    6, 9,    200000],
            [4, 5,    15,    6,    7,    200000],
            [3,    5,    12,    6,    7,    200000],
            [3, 5,    12,    6,    7,    100000],
            [3, 5,    3,    4, 5,    200000],
            [4, 10, 15,    4,    5,    200000],
            [3,    10,    15,    6, 3,    50000],
            [5,    10, 15, 10, 7, 300000],
            [4, 10,    15,    8,    7,    50000],
            [4,    10,    15,    8,    7,    50000],
            [3,    1,    9, 6, 5,    100000],
            [5,    15, 15, 6,    7,    100000],
            [4,    5,    12,    6,    7, 200000],
            [4,    10,    12, 8,    9,    50000],
            [4, 5,    12,    6, 7,    200000],
            [4,    5, 3,    8,    9, 100000],
            [2,    1,    3, 8,    5,    100000],
            [4,    5, 12, 8,    9,    200000],
            [4, 5,    12, 4,    7,    200000],
            [4,    5, 12, 4, 9,    100000],
            [5, 10,    9,    6,    9,    100000],
            [4,    5, 12, 4, 9,    100000],
            [3,    3, 9, 4,    7,    100000],
            [4,    5, 9, 4, 7,    100000],
            [4,    1,    3,    4, 9,    300000],
            [4,    5,    12,    4,    9,    300000],
            [3, 5, 9, 6,    7, 100000],
        ];

        $jumlahAlternatif = count($matriksKeputusan);
        $jumlahKriteria = count($matriksKeputusan[0]);

        // create array column with for
        $arrayColumn = [];
        for ($i = 0; $i < $jumlahKriteria; $i++) {
            $arrayColumn[$i] = array_column($matriksKeputusan, $i);
        }

        // create max and min each criteria
        $max = [];
        $min = [];
        for ($i = 0; $i < $jumlahKriteria; $i++) {
            $max[$i] = max($arrayColumn[$i]);
            $min[$i] = min($arrayColumn[$i]);
        }

        // create normalisasi matrix by dividing each value with max if benefit (index = 0,1,2) or min if cost (index = 3,4)
        $normalisasiMatrix = [];
        for ($i = 0; $i < $jumlahAlternatif; $i++) {
            for ($j = 0; $j < $jumlahKriteria; $j++) {
                if ($j == 0 || $j == 1 || $j == 2 || $j == 3 || $j == 4) {
                    $normalisasiMatrix[$i][$j] = $matriksKeputusan[$i][$j] / $max[$j];
                } else {
                    $normalisasiMatrix[$i][$j] = $min[$j] / $matriksKeputusan[$i][$j];
                }
            }
        }

        // sum each column of normalisasi matrix
        $sumEachCriteria = [];
        for ($i = 0; $i < $jumlahKriteria; $i++) {
            $sumEachCriteria[$i] = array_sum(array_column($normalisasiMatrix, $i));
        }

        // 1 / jumlah alternatif kemudian dikali dengan $sumEachCriteria
        $averageValue = array_map(function ($value) use ($jumlahAlternatif) {
            // return $value / $jumlahAlternatif;
            return (1 / $jumlahAlternatif) * $value;
        }, $sumEachCriteria);

        // (nilai normalisasi - $averageValue) ^ 2
        $pow = [];
        for ($i = 0; $i < $jumlahAlternatif; $i++) {
            for ($j = 0; $j < $jumlahKriteria; $j++) {
                $pow[$i][$j] = pow($normalisasiMatrix[$i][$j] - $averageValue[$j], 2);
            }
        }

        // sum each column of pow
        $sumPow = [];
        for ($i = 0; $i < $jumlahKriteria; $i++) {
            $sumPow[$i] = array_sum(array_column($pow, $i));
        }

        // 1 - $sumPow
        $result = array_map(function ($value) {
            return 1 - $value;
        }, $sumPow);

        // sum result
        $sumResult = array_sum($result);

        // Menentukan bobot kriteria dengan cara membagi $result dengan $sumResult
        $criteriaWeight = array_map(function ($value) use ($sumResult) {
            return $value / $sumResult;
        }, $result);

        // Menentukan nilai PSI dengan cara mengalikan nilai normalisasi dengan bobot kriteria
        $psi = [];
        for ($i = 0; $i < $jumlahAlternatif; $i++) {
            for ($j = 0; $j < $jumlahKriteria; $j++) {
                $psi[$i][$j] = $normalisasiMatrix[$i][$j] * $criteriaWeight[$j];
            }
        }

        // sum each row of psi
        $sumPsi = [];
        for ($i = 0; $i < $jumlahAlternatif; $i++) {
            $sumPsi[$i] = array_sum($psi[$i]);
        }

        $rankSumPsi = $sumPsi;

        // urutkan nilai $sumPsi dari yang terbesar ke terkecil
        arsort($rankSumPsi);

        dd($normalisasiMatrix, $sumEachCriteria, $averageValue, $pow, $sumPow, $result, $sumResult, $criteriaWeight, $psi, $sumPsi, $rankSumPsi);

        // foreach ($matriksKeputusan as $key => $value) {
        //     $arrayColumn[$key] = array_column($matriksKeputusan, $key);
        // }
    }
}
