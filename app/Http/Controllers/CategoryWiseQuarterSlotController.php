<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryWisequarterSlot;
use App\Models\quarter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryWisequarterSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $parkingSlot = new CategoryWisequarterSlot();
            $limit = 10;
            $offset = 0;
            $search = [];
            $where = [];
            $with = ['category', 'createBy', 'quarter'];
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
        $quarters = quarter::where('status', 1)->get();
        return view('content.parking_settings.create')->with(['categories' => $categories, 'quarters' => $quarters]);
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
            $oldSlot =  CategoryWisequarterSlot::where(['category_id' => $request->category_id, 'quarter_id' => $request->quarter_id, 'slot_name' => $request->slot_name])->count();
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
            'quarter_id' => $request->quarter_id,
            'slot_name' => $request->slot_name,
            'slotId' => random_int(10000, 99999),
            'created_by' => auth()->id(),
        ];

        CategoryWisequarterSlot::create($data);

        return redirect()
            ->route('parking_settings.index')
            ->with(['flashMsg' => ['msg' => 'Parking slot successfully added.', 'type' => 'success']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryWisequarterSlot  $parking_setting
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryWisequarterSlot $parking_setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryWisequarterSlot  $parking_setting
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryWisequarterSlot $parking_setting)
    {
        $categories = Category::where('status', 1)->get();
        $quarters = quarter::where('status', 1)->get();
        return view('content.parking_settings.edit')->with(['categories' => $categories, 'quarters' => $quarters, 'parking_setting' => $parking_setting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryWisequarterSlot  $parking_setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryWisequarterSlot $parking_setting)
    {
        $validator = Validator::make($request->all(), [
            'slot_name' => 'bail|required|min:1|max:5',
            'identity' => 'bail|nullable|min:5',
            'remarks' => 'bail|nullable|min:5'
        ]);

        $validator->after(function ($validator) use ($request, $parking_setting) {
            $oldSlot =  CategoryWisequarterSlot::where(['category_id' => $request->category_id, 'quarter_id' => $request->quarter_id, 'slot_name' => $request->slot_name])->where('id', '!=', $parking_setting->id)->count();
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
            'quarter_id' => $request->quarter_id,
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
     * @param  \App\quarter  $quarter
     * @return \Illuminate\Http\Response
     */
    public function statusChange(Request $request, CategoryWisequarterSlot $parking_setting)
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
     * @param  \App\Models\CategoryWisequarterSlot  $parking_setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryWisequarterSlot $parking_setting)
    {
        $parking_setting->delete();
    }
}
