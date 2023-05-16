<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryWiseFloorSlot;
use App\Models\Floor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryWiseFloorSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $parkingSlot = new CategoryWiseFloorSlot();
            $limit = 10;
            $offset = 0;
            $search = [];
            $where = [];
            $with = ['category', 'createBy', 'floor'];
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
                $search['slot_name'] = $request->input('search')['value'];
                $search['slotId'] = $request->input('search')['value'];
            }

            if ($request->input('where')) {
                $where = $request->input('where');
            }

            $parkingSlot = $parkingSlot->getDataForDataTable($limit, $offset, $search, $where, $with, $join, $orderBy,  $request->all());
            return response()->json($parkingSlot);
        }

        return view('content.parking_settings.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $floors = Floor::where('status', 1)->get();
        return view('content.parking_settings.create')->with(['categories' => $categories, 'floors' => $floors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slot_name' => 'bail|required|min:1|max:5',
            'identity' => 'bail|nullable|min:5',
            'remarks' => 'bail|nullable|min:5'
        ]);

        $validator->after(function ($validator) use ($request) {
            $oldSlot =  CategoryWiseFloorSlot::where(['category_id' => $request->category_id, 'floor_id' => $request->floor_id, 'slot_name' => $request->slot_name])->count();
            if ($oldSlot) {
                $validator->errors()->add('slot_name', 'This slot name has been used.');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();;
        }

        $data = [
            'identity' => $request->identity,
            'remarks' => $request->remarks,
            'category_id' => $request->category_id,
            'floor_id' => $request->floor_id,
            'slot_name' => $request->slot_name,
            'slotId' => random_int(10000, 99999),
            'created_by' => auth()->id(),
        ];

        CategoryWiseFloorSlot::create($data);

        return redirect()
            ->route('parking_settings.index')
            ->with(['flashMsg' => ['msg' => 'Parking slot successfully added.', 'type' => 'success']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryWiseFloorSlot  $parking_setting
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryWiseFloorSlot $parking_setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryWiseFloorSlot  $parking_setting
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryWiseFloorSlot $parking_setting)
    {
        $categories = Category::where('status', 1)->get();
        $floors = Floor::where('status', 1)->get();
        return view('content.parking_settings.edit')->with(['categories' => $categories, 'floors' => $floors, 'parking_setting' => $parking_setting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryWiseFloorSlot  $parking_setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryWiseFloorSlot $parking_setting)
    {
        $validator = Validator::make($request->all(), [
            'slot_name' => 'bail|required|min:1|max:5',
            'identity' => 'bail|nullable|min:5',
            'remarks' => 'bail|nullable|min:5'
        ]);

        $validator->after(function ($validator) use ($request, $parking_setting) {
            $oldSlot =  CategoryWiseFloorSlot::where(['category_id' => $request->category_id, 'floor_id' => $request->floor_id, 'slot_name' => $request->slot_name])->where('id', '!=', $parking_setting->id)->count();
            if ($oldSlot) {
                $validator->errors()->add('slot_name', 'This slot name has been used.');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();;
        }

        $data = [
            'identity' => $request->identity,
            'remarks' => $request->remarks,
            'category_id' => $request->category_id,
            'floor_id' => $request->floor_id,
            'slot_name' => $request->slot_name
        ];

        $parking_setting->update($data);

        return redirect()
            ->route('parking_settings.index')
            ->with(['flashMsg' => ['msg' => 'Parking slot successfully updated.', 'type' => 'success']]);
    }

    /**
     * Update the status
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function statusChange(Request $request, CategoryWiseFloorSlot $parking_setting)
    {
        if ($parking_setting->active_parking) {
            return back()->with(['flashMsg' => ['msg' => 'This Slot has already been used in an active parking.', 'type' => 'warning']]);
        } else {
            if ($parking_setting->status == 1) {
                $parking_setting->update(['status' => 0]);
            } else {
                $parking_setting->update(['status' => 1]);
            }

            return back()->with(['flashMsg' => ['msg' => 'Status successfully changed.', 'type' => 'success']]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryWiseFloorSlot  $parking_setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryWiseFloorSlot $parking_setting)
    {
        $parking_setting->delete();
    }
}
