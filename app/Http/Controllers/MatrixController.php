<?php

namespace App\Http\Controllers;

use App\Models\Matrix;
use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreMatrixRequest;
use App\Http\Requests\UpdateMatrixRequest;
use MathPHP\Statistics\Correlation;
use MathPHP\Statistics\Descriptive;

class MatrixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Matrix::with('alternative', 'criteria')->latest()->get();

        $alternativeAmount = Alternative::count();
        $criteriaAmount = Criteria::count();

        // create array 2 dimensional and push data from $data
        $matrix = [];
        foreach ($data as $value) {
            $matrix[$value->alternative_id][$value->criteria_id] = (object) [
                'alternative_id' => $value->alternative_id,
                'alternative_code' => $value->alternative->code,
                'alternative_name' => $value->alternative->name,
                'criteria_id' => $value->criteria_id,
                'criteria_code' => $value->criteria->code,
                'criteria_name' => $value->criteria->name,
                'id' => $value->id,
                'value' => $value->value,
            ];
        }

        ksort($matrix);

        foreach ($matrix as $key => $value) {
            ksort($matrix[$key]);
        }

        return view('contents.matrices.index', [
            'alternativeAmount' => $alternativeAmount,
            'criteriaAmount' => $criteriaAmount,
            'criterias' => Criteria::all(),
            'alternatives' => Alternative::all(),
            'matrix' => $matrix,
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.matrices.create', [
            'criterias' => Criteria::all(),
            'alternatives' => Alternative::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMatrixRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatrixRequest $request)
    {
        // Check if data already exists
        $check = Matrix::where('alternative_id', $request->alternative_id)
            ->where('criteria_id', $request->criteria_id)
            ->first();

        if ($check) {
            Alert::error('Error', 'Data already exists!');
            return redirect('/matrices/create');
        } else {
            Matrix::create($request->validated());
            Alert::success('Success', 'Value matrix has been added.');

            return redirect('/matrices');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matrix  $matrix
     * @return \Illuminate\Http\Response
     */
    public function show(Matrix $matrix)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matrix  $matrix
     * @return \Illuminate\Http\Response
     */
    public function edit(Matrix $matrix)
    {
        return view('contents.matrices.edit', [
            'matrix' => $matrix,
            'criterias' => Criteria::all(),
            'alternatives' => Alternative::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMatrixRequest  $request
     * @param  \App\Models\Matrix  $matrix
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMatrixRequest $request, Matrix $matrix)
    {
        $matrix->update($request->validated());
        Alert::success('Success', 'Value matrix has been updated.');

        return redirect('/matrices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matrix  $matrix
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matrix $matrix)
    {
        $matrix->delete();
        Alert::success('Success', 'Value matrix has been deleted.');

        return redirect('/matrices');
    }

    public function truncate()
    {
        Matrix::truncate();
        Alert::success('Success', 'Matrix has been deleted.');
        return redirect('/matrices');
    }

    public function rank()
    {
        $alternatives = Alternative::all();

        return response()->json([
            'alternatives' => $alternatives,
        ]);
    }

    public function countMerec()
    {
        $data = Matrix::with('alternative', 'criteria')->latest()->get();

        // check if data is empty
        if ($data->isEmpty()) {
            Alert::error('Error', 'Data to be calculated is empty! Please complete the data first.');
            return redirect('/matrices');
        } else {
            $alternativeCount = Alternative::count();
            $criteriaCount = Criteria::count();

            // create array 2 dimensional and push data from $data
            $matrix = [];
            foreach ($data as $value) {
                $matrix[$value->alternative_id][$value->criteria_id] = $value->value;
            }

            ksort($matrix);

            foreach ($matrix as $key => $value) {
                ksort($matrix[$key]);
            }

            $jumlahAlternatif = count($matrix);
            $jumlahKriteria = count($matrix[1]);

            if ($jumlahAlternatif != $alternativeCount || $jumlahKriteria != $criteriaCount) {
                Alert::error('Error', 'Data to be calculated is incomplete! Please complete the data first.');
                return redirect('/matrices');
            } else {
                // create max and min each criteria
                $max = [];
                $min = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $max[$i] = max(array_column($matrix, $i));
                    $min[$i] = min(array_column($matrix, $i));
                }

                // BEGINNING OF MEREC
                // create matrix normalize by dividing each value with max if benefit and min if cost
                $normalisasi = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        if (Criteria::find($j)->type == 'benefit') {
                            $normalisasi[$i][$j] = $min[$j] / $matrix[$i][$j];
                        } else {
                            $normalisasi[$i][$j] = $matrix[$i][$j] / $max[$j];
                        }
                    }
                }

                // Calculation of Overall Performance of alternatives (Si)
                $sumEachCriteria = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $sumEachCriteria[$i] = array_sum(array_column($normalisasi, $i));
                }

                // =LN(1+((1/14)*(ABS(LN(B61))+ABS(LN(C61))+ABS(LN(D61))+ABS(LN(E61))+ABS(LN(F61))+ABS(LN(G61))+ABS(LN(H61))+ABS(LN(I61))+ABS(LN(J61))+ABS(LN(K61))+ABS(LN(L61))+ABS(LN(M61))+ABS(LN(N61))+ABS(LN(O61)))))
                // LOG ALL VALUES
                $logValues = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $logValues[$i][$j] = log($normalisasi[$i][$j]);
                    }
                }

                // ABS ALL VALUES
                $absValues = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $absValues[$i][$j] = abs($logValues[$i][$j]);
                    }
                }

                // SUM ALL CRITERIAS BY ALTERNATIVES
                $sumValues = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    $sumValues[$i] = array_sum($absValues[$i]);
                }
                
                // FINAL VALUES
                $sumAbsLogCriteria = [];
                    for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                        $sumAbsLogCriteria[$i] = log(1+((1/14) * $sumValues[$i]));
                }
                
                // SUM ALL CRITERIAS BY ALTERNATIVES 2
                $sumValuess = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        // Initialize sum for current element
                        $sum = 0;
                        // Loop through each column to calculate sum excluding current index
                        for ($col = 1; $col <= $jumlahKriteria; $col++) {
                            if ($col != $j) {
                                $sum += $absValues[$i][$col];
                            }
                        }
                        // Assign the sum to the result array
                        $sumValuess[$i][$j] = $sum;
                    }
                }
                
                // FINAL VALUES 2
                $sumAbsLogCriterias = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $sumAbsLogCriterias[$i][$j] = log(1+((1/14) * $sumValuess[$i][$j]));
                    }
                }

                // Calculation of Removal Effect (Ej)
                $removalEffect = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $removalEffect[$i][$j] =  abs($sumAbsLogCriteria[$i] - $sumAbsLogCriterias[$i][$j]);
                    }
                }

                // Estimate the final Weights (Wj)
                $weightEst = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    $weightEst[$i] = array_sum(array_column($removalEffect, $i));
                }

                $weight = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $weight[$i] = $weightEst[$i] / array_sum($weightEst);
                }

                // END OF MEREC

                // BEGINNING OF CRITIC

                // NORMALIZATION
                $normalisasiCritic = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        if (Criteria::find($j)->type == 'benefit') {
                            $normalisasiCritic[$i][$j] = ($matrix[$i][$j] - $min[$j]) / ($max[$j] - $min[$j]);
                        } else {
                            $normalisasiCritic[$i][$j] = ($matrix[$i][$j] - $max[$j]) / ($min[$j] - $max[$j]);
                        }
                    }
                }

                // Calculation of Standard Deviation for Each Criteria
                
                // 1. Column Mean
                $columnMeans = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $columnMeans[$i] = array_sum(array_column($normalisasiCritic, $i)) / $jumlahAlternatif;
                }
                
                // 2. Calculate the squared differences from the mean for each column
                $distance = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $distance[$i][$j] = pow($normalisasiCritic[$i][$j] - $columnMeans[$j], 2);
                    }
                }

                //3. SUM
                $sumDis = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $sumDis[$i] = array_sum(array_column($distance, $i));
                }

                // 4. DIVIDE BY ALT
                $divided = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $divided[$i] = $sumDis[$i] / $jumlahAlternatif;
                }

                // RESULT
                $stdDev = array_map('sqrt', $divided);

                // Determine the Symmetric Matrix
                $columns = [];
                // Iterate through each column index
                for ($j = 1; $j <= $jumlahKriteria; $j++) {
                    // Initialize an array to store elements of the current column
                    $column = [];
                    // Iterate through each row
                    for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                        // Add the element at the current column index to the column array
                        $column[] = $normalisasiCritic[$i][$j];
                    }
                    // Add the column array to the columns array
                    $columns[] = $column;
                }
                //dd($columns[1]);

                $correl = [];
                for ($i = 1; $i <= count($normalisasiCritic[$i]); $i++) {
                    for ($j = 1; $j <= count($normalisasiCritic[$i]); $j++) {
                        $correl[$i][$j] = Correlation::r($columns[$i-1], $columns[$j-1]);
                        
                    }
                }

                // Measure of the Conflict Created by Criterion
                $conflicCreated = [];
                for ($i = 1; $i <= count($normalisasiCritic[$i]); $i++) {
                    for ($j = 1; $j <= count($normalisasiCritic[$i]); $j++) {
                        $conflicCreated[$i][$j] = 1 - $correl[$i][$j];
                        
                    }
                }

                // Estimation of Criterion information Cj 
                $est = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $est[$i] = array_sum($conflicCreated[$i]) * $stdDev[$i];
                }

                // Determining the Objective Weights
                $weightCritic = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $weightCritic[$i] = $est[$i] / array_sum($est);
                }

                // COMPARISON
                arsort($weight);
                arsort($weightCritic);

                // MOORA
                // Normalization of the Decision Matrix
                $power = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $power[$i][$j] = pow($matrix[$i][$j], 2);
                    }
                }

                $powSum = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $powSum[$i] = array_sum(array_column($power, $i));
                }
                //dd($power);
                
                $normalisasiMoora = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $normalisasiMoora[$i][$j] = $matrix[$i][$j] / sqrt($powSum[$j]);
                    }
                }

                //Weighting Normalized Decision Matrix
                $merecWeighted = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        if (Criteria::find($j)->type == 'cost') {
                            $merecWeighted[$i][$j] = -1 * $normalisasiMoora[$i][$j] * $weight[$j];
                        } else {
                            $merecWeighted[$i][$j] = $normalisasiMoora[$i][$j] * $weight[$j];
                        }
                    }
                }

                $criticWeighted = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        if (Criteria::find($j)->type == 'cost') {
                            $criticWeighted[$i][$j] = -1 * $normalisasiMoora[$i][$j] * $weightCritic[$j];
                        } else {
                            $criticWeighted[$i][$j] = $normalisasiMoora[$i][$j] * $weightCritic[$j];
                        }
                    }
                }

                // Result
                $merecRank = [];
                $criticRank = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    $merecRank[$i] = array_sum($merecWeighted[$i]);
                    $criticRank[$i] = array_sum($criticWeighted[$i]);
                }

                // sort value from highest to lowest
                arsort($merecRank);
                arsort($criticRank);
                /* 
                // 1 / alternative amount, then times with $sumEachCriteria
                $averageValue = array_map(function ($value) use ($jumlahAlternatif) {
                    return (1 / $jumlahAlternatif) * $value;
                }, $sumEachCriteria);

                // (normalize value - $averageValue) ^ 2
                $pow = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $pow[$i][$j] = pow($normalisasi[$i][$j] - $averageValue[$j], 2);
                    }
                }

                $sumPow = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $sumPow[$i] = array_sum(array_column($pow, $i));
                }

                // 1 - $sumPow
                $result = array_map(function ($value) {
                    return 1 - $value;
                }, $sumPow);

                // sum result
                $sumResult = array_sum($result);

                // Define criteria weight with divide $result with $sumResult
                $criteriaWeight = array_map(function ($value) use ($sumResult) {
                    return $value / $sumResult;
                }, $result);

                // Define PSI value with times normalize value with criteria weight
                $psi = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $psi[$i][$j] = $normalisasi[$i][$j] * $criteriaWeight[$j];
                    }
                }

                // sum each row of psi
                $sumPsi = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    $sumPsi[$i] = array_sum($psi[$i]);
                }

                $sumPsiRank = $sumPsi;

                // sort $sumPsi value from highest to lowest
                arsort($sumPsiRank); */
            }
        }

        // dd($matrix, $max, $min, $normalisasi, $sumEachCriteria, $averageValue, $pow, $sumPow, $result, $sumResult, $criteriaWeight, $psi, $sumPsi, $sumPsiRank);

        return view('contents.calculateMerec.index', [
            'data' => $data,
            'matrix' => $matrix,
            'max' => $max,
            'min' => $min,
            'normalisasi' => $normalisasi,
            'sumEachCriteria' => $sumEachCriteria,
            'sumAbsLogCriteria' => $sumAbsLogCriteria,
            /* 'averageValue' => $averageValue,
            'pow' => $pow,
            'sumPow' => $sumPow,
            'result' => $result,
            'sumResult' => $sumResult,
            'criteriaWeight' => $criteriaWeight,
            'psi' => $psi,
            'sumPsi' => $sumPsi,
            'sumPsiRank' => $sumPsiRank, */
            'alternativeCount' => $alternativeCount,
            'criteriaCount' => $criteriaCount,
            'logValues' => $logValues,
            'absValues' => $absValues,
            'sumValues' => $sumValues,
            'sumValuess' => $sumValuess,
            'sumAbsLogCriterias' => $sumAbsLogCriterias,
            'removalEffect' => $removalEffect,
            'weight' => $weight,
            'normalisasiCritic' => $normalisasiCritic,
            'stdDev' => $stdDev,
            'columnMeans' => $columnMeans,
            'distance' => $distance,
            'sumDis' => $sumDis,
            'divided' => $divided,
            'correl' => $correl,
            'conflicCreated' => $conflicCreated,
            'est' => $est,
            'weightCritic' => $weightCritic,
            'normalisasiMoora' => $normalisasiMoora,
            'merecWeighted' => $merecWeighted,
            'criticWeighted' => $criticWeighted,
            'merecRank' => $merecRank,
            'criticRank' => $criticRank,
            'criterias' => Criteria::all(),
            'alternatives' => Alternative::all(),
        ]);
    }
    public function countCritic()
    {
        $data = Matrix::with('alternative', 'criteria')->latest()->get();

        // check if data is empty
        if ($data->isEmpty()) {
            Alert::error('Error', 'Data to be calculated is empty! Please complete the data first.');
            return redirect('/matrices');
        } else {
            $alternativeCount = Alternative::count();
            $criteriaCount = Criteria::count();

            // create array 2 dimensional and push data from $data
            $matrix = [];
            foreach ($data as $value) {
                $matrix[$value->alternative_id][$value->criteria_id] = $value->value;
            }

            ksort($matrix);

            foreach ($matrix as $key => $value) {
                ksort($matrix[$key]);
            }

            $jumlahAlternatif = count($matrix);
            $jumlahKriteria = count($matrix[1]);

            if ($jumlahAlternatif != $alternativeCount || $jumlahKriteria != $criteriaCount) {
                Alert::error('Error', 'Data to be calculated is incomplete! Please complete the data first.');
                return redirect('/matrices');
            } else {
                // create max and min each criteria
                $max = [];
                $min = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $max[$i] = max(array_column($matrix, $i));
                    $min[$i] = min(array_column($matrix, $i));
                }

                // BEGINNING OF CRITIC

                // NORMALIZATION
                $normalisasiCritic = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        if (Criteria::find($j)->type == 'benefit') {
                            $normalisasiCritic[$i][$j] = ($matrix[$i][$j] - $min[$j]) / ($max[$j] - $min[$j]);
                        } else {
                            $normalisasiCritic[$i][$j] = ($matrix[$i][$j] - $max[$j]) / ($min[$j] - $max[$j]);
                        }
                    }
                }

                // Calculation of Standard Deviation for Each Criteria
                
                // 1. Column Mean
                $columnMeans = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $columnMeans[$i] = array_sum(array_column($normalisasiCritic, $i)) / $jumlahAlternatif;
                }
                
                // 2. Calculate the squared differences from the mean for each column
                $distance = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $distance[$i][$j] = pow($normalisasiCritic[$i][$j] - $columnMeans[$j], 2);
                    }
                }

                //3. SUM
                $sumDis = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $sumDis[$i] = array_sum(array_column($distance, $i));
                }

                // 4. DIVIDE BY ALT
                $divided = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $divided[$i] = $sumDis[$i] / $jumlahAlternatif;
                }

                // RESULT
                $stdDev = array_map('sqrt', $divided);

                // Determine the Symmetric Matrix
                $columns = [];
                // Iterate through each column index
                for ($j = 1; $j <= $jumlahKriteria; $j++) {
                    // Initialize an array to store elements of the current column
                    $column = [];
                    // Iterate through each row
                    for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                        // Add the element at the current column index to the column array
                        $column[] = $normalisasiCritic[$i][$j];
                    }
                    // Add the column array to the columns array
                    $columns[] = $column;
                }
                //dd($columns[1]);

                $correl = [];
                for ($i = 1; $i <= count($normalisasiCritic[$i]); $i++) {
                    for ($j = 1; $j <= count($normalisasiCritic[$i]); $j++) {
                        $correl[$i][$j] = Correlation::r($columns[$i-1], $columns[$j-1]);
                        
                    }
                }

                // Measure of the Conflict Created by Criterion
                $conflicCreated = [];
                for ($i = 1; $i <= count($normalisasiCritic[$i]); $i++) {
                    for ($j = 1; $j <= count($normalisasiCritic[$i]); $j++) {
                        $conflicCreated[$i][$j] = 1 - $correl[$i][$j];
                        
                    }
                }

                // Estimation of Criterion information Cj 
                $est = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $est[$i] = array_sum($conflicCreated[$i]) * $stdDev[$i];
                }

                // Determining the Objective Weights
                $weightCritic = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $weightCritic[$i] = $est[$i] / array_sum($est);
                }
                
            }
        }

        return view('contents.calculateCritic.index', [
            'data' => $data,
            'matrix' => $matrix,
            'max' => $max,
            'min' => $min,
            'alternativeCount' => $alternativeCount,
            'criteriaCount' => $criteriaCount,
            'normalisasiCritic' => $normalisasiCritic,
            'stdDev' => $stdDev,
            'columnMeans' => $columnMeans,
            'distance' => $distance,
            'sumDis' => $sumDis,
            'divided' => $divided,
            'correl' => $correl,
            'conflicCreated' => $conflicCreated,
            'est' => $est,
            'weightCritic' => $weightCritic,
            'criterias' => Criteria::all(),
            'alternatives' => Alternative::all(),
        ]);
    }
    
    public function countMoora()
    {
        $data = Matrix::with('alternative', 'criteria')->latest()->get();

        // check if data is empty
        if ($data->isEmpty()) {
            Alert::error('Error', 'Data to be calculated is empty! Please complete the data first.');
            return redirect('/matrices');
        } else {
            $alternativeCount = Alternative::count();
            $criteriaCount = Criteria::count();

            // create array 2 dimensional and push data from $data
            $matrix = [];
            foreach ($data as $value) {
                $matrix[$value->alternative_id][$value->criteria_id] = $value->value;
            }

            ksort($matrix);

            foreach ($matrix as $key => $value) {
                ksort($matrix[$key]);
            }

            $jumlahAlternatif = count($matrix);
            $jumlahKriteria = count($matrix[1]);

            if ($jumlahAlternatif != $alternativeCount || $jumlahKriteria != $criteriaCount) {
                Alert::error('Error', 'Data to be calculated is incomplete! Please complete the data first.');
                return redirect('/matrices');
            } else {
                // create max and min each criteria
                $max = [];
                $min = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $max[$i] = max(array_column($matrix, $i));
                    $min[$i] = min(array_column($matrix, $i));
                }

                // BEGINNING OF MEREC
                // create matrix normalize by dividing each value with max if benefit and min if cost
                $normalisasi = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        if (Criteria::find($j)->type == 'benefit') {
                            $normalisasi[$i][$j] = $min[$j] / $matrix[$i][$j];
                        } else {
                            $normalisasi[$i][$j] = $matrix[$i][$j] / $max[$j];
                        }
                    }
                }

                // Calculation of Overall Performance of alternatives (Si)
                $sumEachCriteria = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $sumEachCriteria[$i] = array_sum(array_column($normalisasi, $i));
                }

                // =LN(1+((1/14)*(ABS(LN(B61))+ABS(LN(C61))+ABS(LN(D61))+ABS(LN(E61))+ABS(LN(F61))+ABS(LN(G61))+ABS(LN(H61))+ABS(LN(I61))+ABS(LN(J61))+ABS(LN(K61))+ABS(LN(L61))+ABS(LN(M61))+ABS(LN(N61))+ABS(LN(O61)))))
                // LOG ALL VALUES
                $logValues = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $logValues[$i][$j] = log($normalisasi[$i][$j]);
                    }
                }

                // ABS ALL VALUES
                $absValues = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $absValues[$i][$j] = abs($logValues[$i][$j]);
                    }
                }

                // SUM ALL CRITERIAS BY ALTERNATIVES
                $sumValues = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    $sumValues[$i] = array_sum($absValues[$i]);
                }
                
                // FINAL VALUES
                $sumAbsLogCriteria = [];
                    for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                        $sumAbsLogCriteria[$i] = log(1+((1/14) * $sumValues[$i]));
                }
                
                // SUM ALL CRITERIAS BY ALTERNATIVES 2
                $sumValuess = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        // Initialize sum for current element
                        $sum = 0;
                        // Loop through each column to calculate sum excluding current index
                        for ($col = 1; $col <= $jumlahKriteria; $col++) {
                            if ($col != $j) {
                                $sum += $absValues[$i][$col];
                            }
                        }
                        // Assign the sum to the result array
                        $sumValuess[$i][$j] = $sum;
                    }
                }
                
                // FINAL VALUES 2
                $sumAbsLogCriterias = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $sumAbsLogCriterias[$i][$j] = log(1+((1/14) * $sumValuess[$i][$j]));
                    }
                }

                // Calculation of Removal Effect (Ej)
                $removalEffect = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $removalEffect[$i][$j] =  abs($sumAbsLogCriteria[$i] - $sumAbsLogCriterias[$i][$j]);
                    }
                }

                // Estimate the final Weights (Wj)
                $weightEst = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    $weightEst[$i] = array_sum(array_column($removalEffect, $i));
                }

                $weight = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $weight[$i] = $weightEst[$i] / array_sum($weightEst);
                }

                // END OF MEREC

                // BEGINNING OF CRITIC

                // NORMALIZATION
                $normalisasiCritic = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        if (Criteria::find($j)->type == 'benefit') {
                            $normalisasiCritic[$i][$j] = ($matrix[$i][$j] - $min[$j]) / ($max[$j] - $min[$j]);
                        } else {
                            $normalisasiCritic[$i][$j] = ($matrix[$i][$j] - $max[$j]) / ($min[$j] - $max[$j]);
                        }
                    }
                }

                // Calculation of Standard Deviation for Each Criteria
                
                // 1. Column Mean
                $columnMeans = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $columnMeans[$i] = array_sum(array_column($normalisasiCritic, $i)) / $jumlahAlternatif;
                }
                
                // 2. Calculate the squared differences from the mean for each column
                $distance = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $distance[$i][$j] = pow($normalisasiCritic[$i][$j] - $columnMeans[$j], 2);
                    }
                }

                //3. SUM
                $sumDis = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $sumDis[$i] = array_sum(array_column($distance, $i));
                }

                // 4. DIVIDE BY ALT
                $divided = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $divided[$i] = $sumDis[$i] / $jumlahAlternatif;
                }

                // RESULT
                $stdDev = array_map('sqrt', $divided);

                // Determine the Symmetric Matrix
                $columns = [];
                // Iterate through each column index
                for ($j = 1; $j <= $jumlahKriteria; $j++) {
                    // Initialize an array to store elements of the current column
                    $column = [];
                    // Iterate through each row
                    for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                        // Add the element at the current column index to the column array
                        $column[] = $normalisasiCritic[$i][$j];
                    }
                    // Add the column array to the columns array
                    $columns[] = $column;
                }
                //dd($columns[1]);

                $correl = [];
                for ($i = 1; $i <= count($normalisasiCritic[$i]); $i++) {
                    for ($j = 1; $j <= count($normalisasiCritic[$i]); $j++) {
                        $correl[$i][$j] = Correlation::r($columns[$i-1], $columns[$j-1]);
                        
                    }
                }

                // Measure of the Conflict Created by Criterion
                $conflicCreated = [];
                for ($i = 1; $i <= count($normalisasiCritic[$i]); $i++) {
                    for ($j = 1; $j <= count($normalisasiCritic[$i]); $j++) {
                        $conflicCreated[$i][$j] = 1 - $correl[$i][$j];
                        
                    }
                }

                // Estimation of Criterion information Cj 
                $est = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $est[$i] = array_sum($conflicCreated[$i]) * $stdDev[$i];
                }

                // Determining the Objective Weights
                $weightCritic = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $weightCritic[$i] = $est[$i] / array_sum($est);
                }

                // COMPARISON
                arsort($weight);
                arsort($weightCritic);

                // MOORA
                // Normalization of the Decision Matrix
                $power = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $power[$i][$j] = pow($matrix[$i][$j], 2);
                    }
                }

                $powSum = [];
                for ($i = 1; $i <= $jumlahKriteria; $i++) {
                    $powSum[$i] = array_sum(array_column($power, $i));
                }
                //dd($power);
                
                $normalisasiMoora = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        $normalisasiMoora[$i][$j] = $matrix[$i][$j] / sqrt($powSum[$j]);
                    }
                }

                //Weighting Normalized Decision Matrix
                $merecWeighted = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        if (Criteria::find($j)->type == 'cost') {
                            $merecWeighted[$i][$j] = -1 * $normalisasiMoora[$i][$j] * $weight[$j];
                        } else {
                            $merecWeighted[$i][$j] = $normalisasiMoora[$i][$j] * $weight[$j];
                        }
                    }
                }

                $criticWeighted = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    for ($j = 1; $j <= $jumlahKriteria; $j++) {
                        if (Criteria::find($j)->type == 'cost') {
                            $criticWeighted[$i][$j] = -1 * $normalisasiMoora[$i][$j] * $weightCritic[$j];
                        } else {
                            $criticWeighted[$i][$j] = $normalisasiMoora[$i][$j] * $weightCritic[$j];
                        }
                    }
                }

                // Result
                $merecRank = [];
                $criticRank = [];
                for ($i = 1; $i <= $jumlahAlternatif; $i++) {
                    $merecRank[$i] = array_sum($merecWeighted[$i]);
                    $criticRank[$i] = array_sum($criticWeighted[$i]);
                }

                // sort value from highest to lowest
                arsort($merecRank);
                arsort($criticRank);
            }
        }

        // dd($matrix, $max, $min, $normalisasi, $sumEachCriteria, $averageValue, $pow, $sumPow, $result, $sumResult, $criteriaWeight, $psi, $sumPsi, $sumPsiRank);

        return view('contents.calculateMoora.index', [
            'data' => $data,
            'matrix' => $matrix,
            'max' => $max,
            'min' => $min,
            'normalisasi' => $normalisasi,
            'sumEachCriteria' => $sumEachCriteria,
            'sumAbsLogCriteria' => $sumAbsLogCriteria,
            'alternativeCount' => $alternativeCount,
            'criteriaCount' => $criteriaCount,
            'logValues' => $logValues,
            'absValues' => $absValues,
            'sumValues' => $sumValues,
            'sumValuess' => $sumValuess,
            'sumAbsLogCriterias' => $sumAbsLogCriterias,
            'removalEffect' => $removalEffect,
            'weight' => $weight,
            'normalisasiCritic' => $normalisasiCritic,
            'stdDev' => $stdDev,
            'columnMeans' => $columnMeans,
            'distance' => $distance,
            'sumDis' => $sumDis,
            'divided' => $divided,
            'correl' => $correl,
            'conflicCreated' => $conflicCreated,
            'est' => $est,
            'weightCritic' => $weightCritic,
            'normalisasiMoora' => $normalisasiMoora,
            'merecWeighted' => $merecWeighted,
            'criticWeighted' => $criticWeighted,
            'merecRank' => $merecRank,
            'criticRank' => $criticRank,
            'criterias' => Criteria::all(),
            'alternatives' => Alternative::all(),
        ]);
    }
}
