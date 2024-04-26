<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Decision;
use App\Models\Alternative;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreDecisionRequest;
use App\Http\Requests\UpdateDecisionRequest;

class DecisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Decision::latest()->get();
        // dd($data->alternative->name);

        $alternativeAmount = Alternative::count();
        $criteriaAmount = Criteria::count();

        // create array 2 dimensional and push data from $data
        $matrix = [];
        foreach ($data as $value) {
            $matrix[$value->alternative_id][$value->criteria_id] = $value->value;
        }
        // dd($matrix);

        // if ($request->ajax()) {
        //     return Datatables::of($data)
        //         ->addColumn('alternative', function (Decision $decision) {
        //             return $decision->alternative->name;
        //         })
        //         ->addColumn('action', function ($row) {
        //             $actionBtn = '<a href="/decisions/ ' . $row->id . '/edit" class="btn btn-warning"><i
        //                             class="mdi mdi-pencil"></i>
        //                         Edit</a>
        //                         <a href="/decisions/' . $row->id . '" class="btn btn-danger" data-confirm-delete="true"><i
        //                             class="mdi mdi-delete"></i>
        //                         Delete</a>';
        //             return $actionBtn;
        //         })
        //         ->rawColumns(['action'])
        //         ->addIndexColumn()
        //         ->make(true);
        // }

        return view('contents.decisions.index', [
            'alternativeAmount' => $alternativeAmount,
            'criteriaAmount' => $criteriaAmount,
            'matrix' => $matrix,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDecisionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDecisionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Decision  $decision
     * @return \Illuminate\Http\Response
     */
    public function show(Decision $decision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Decision  $decision
     * @return \Illuminate\Http\Response
     */
    public function edit(Decision $decision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDecisionRequest  $request
     * @param  \App\Models\Decision  $decision
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDecisionRequest $request, Decision $decision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Decision  $decision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Decision $decision)
    {
        //
    }
}
