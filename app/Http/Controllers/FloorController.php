<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Exception;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $floors = new Floor();
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

            $floors = $floors->getDataForDataTable($limit, $offset, $search, $where, $with, $join, $orderBy,  $request->all());
            return response()->json($floors);
        }

        return view('content.floors.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.floors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate(['name' => 'bail|required|unique:floors', 'level' => 'required', 'remarks' => 'bail|nullable|min:3']);

        $floor = Floor::create([
            'name'     => $validated['name'],
            'level'     => $validated['level'],
            'remarks'     => $validated['remarks'],
        ]);

        return redirect()
            ->route('floors.index')
            ->with(['flashMsg' => ['msg' => 'Floor successfully added.', 'type' => 'success']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function show(Floor $floor)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function edit(Floor $floor)
    {
        $viewData = array(
            'floor' => $floor,
        );

        return view('content.floors.edit')->with($viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Floor $floor)
    {
        $validated = $request->validate(['name' => 'bail|required|unique:floors,name,' . $floor->id, 'level' => 'required', 'remarks' => 'bail|nullable|min:3']);

        $floor->update([
            'name'     => $validated['name'],
            'level'    => $validated['level'],
            'remarks'  => $validated['remarks'],
        ]);

        return redirect()
            ->route('floors.index')
            ->with(['flashMsg' => ['msg' => 'Floor successfully updated.', 'type' => 'success']]);
    }
   
   
    /**
     * Update the status
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function statusChange(Request $request, Floor $floor)
    {
        if ($floor->active_parking) {
            return back()->with(['flashMsg' => ['msg' => 'This floor has already been used in an active parking.', 'type' => 'warning']]);
        }
        else{
            if($floor->status == 1){
                $floor->update(['status' => 0]);
            }
            else{
                $floor->update(['status' => 1]);
            }

            return back()->with(['flashMsg' => ['msg' => 'Status successfully changed.', 'type' => 'success']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Floor $floor)
    {
       $floor->delete();
    }
}
