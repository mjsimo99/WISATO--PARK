<?php

namespace App\Http\Controllers;

use App\Models\Quarter;
use Exception;
use Illuminate\Http\Request;

class QuarterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $quarter = new Quarter();
            $limit = 10;
            $offset = 0;
            $search = [];
            $where = [];
            $with = [];
            $join = [];
            $orderBy = [];

            if ($request->input('length')) {
                $limit = $request->input('length');
            }

            if ($request->input('order')[0]['column'] != 0) {
                $column_name = $request->input('columns')[$request->input('order')[0]['column']]['name'];
                $sort = $request->input('order')[0]['dir'];
                $orderBy[$column_name] = $sort;
            }

            if ($request->input('start')) {
                $offset = $request->input('start');
            }

            if ($request->input('search') && $request->input('search')['value'] != "") {
                $search['name'] = $request->input('search')['value'];
                $search['level'] = $request->input('search')['value'];
            }

            if ($request->input('where')) {
                $where = $request->input('where');
            }

            $quarters = $quarters->getDataForDataTable($limit, $offset, $search, $where, $with, $join, $orderBy,  $request->all());
            return response()->json($quarters);
        }

        return view('content.quarters.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.quarters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate(['name' => 'bail|required|unique:quarters', 'level' => 'required', 'remarks' => 'bail|nullable|min:3']);

        $quarter = Quarter::create([
            'name'     => $validated['name'],
            'level'     => $validated['level'],
            'remarks'     => $validated['remarks'],
        ]);

        return redirect()
            ->route('quarters.index')
            ->with(['flashMsg' => ['msg' => 'quarter successfully added.', 'type' => 'success']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quarter  $quarter
     * @return \Illuminate\Http\Response
     */
    public function show(Quarter $quarter)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quarter  $quarter
     * @return \Illuminate\Http\Response
     */
    public function edit(Quarter $quarter)
    {
        $viewData = array(
            'quarter' => $quarter,
        );

        return view('content.quarters.edit')->with($viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quarter  $quarter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quarter $quarter)
    {
        $validated = $request->validate(['name' => 'bail|required|unique:quarters,name,' . $quarter->id, 'level' => 'required', 'remarks' => 'bail|nullable|min:3']);

        $quarter->update([
            'name'     => $validated['name'],
            'level'    => $validated['level'],
            'remarks'  => $validated['remarks'],
        ]);

        return redirect()
            ->route('quarters.index')
            ->with(['flashMsg' => ['msg' => 'quarter successfully updated.', 'type' => 'success']]);
    }
   
   
    /**
     * Update the status
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quarter  $quarter
     * @return \Illuminate\Http\Response
     */
    public function statusChange(Request $request, Quarter $quarter)
    {
        if ($quarter->active_parking) {
            return back()->with(['flashMsg' => ['msg' => 'This quarter has already been used in an active parking.', 'type' => 'warning']]);
        }
        else{
            if($quarter->status == 1){
                $quarter->update(['status' => 0]);
            }
            else{
                $quarter->update(['status' => 1]);
            }

            return back()->with(['flashMsg' => ['msg' => 'Status successfully changed.', 'type' => 'success']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quarter  $quarter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quarter $quarter)
    {
       $quarter->delete();
    }
}
