<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use ErrorException;
use Exception;

class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->wantsJson()) {
			$categories = new Category();
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
				$search['type'] = $request->input('search')['value'];
				$search['description'] = $request->input('search')['value'];
			}

			if ($request->input('where')) {
				$where = $request->input('where');
			}

			$categories = $categories->getDataForDataTable($limit, $offset, $search, $where, $with, $join, $orderBy,  $request->all());
			return response()->json($categories);
		}
		return view('content.category.list');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('content.category.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreCategoryRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreCategoryRequest $request)
	{
		$validated = $request->validated();

		try {

			$category = Category::create([
				'type'          => $validated['type'],
				'description'   => $validated['description'],
				'status'      => $validated['status'],
				'created_by'  => $request->user()->id,
				'modified_by' => $request->user()->id
			]);
		} catch (\PDOException $e) {

			return redirect()
				->back()
				->withInput()
				->with(['flashMsg' => ['msg' => $this->getMessage($e), 'type' => 'error']]);
		}

		return redirect()
			->route('category.index')
			->with(['flashMsg' => ['msg' => 'Category successfully added.', 'type' => 'success']]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function show(Category $category)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Category $category)
	{
		return view('content.category.edit')->with(['category' => $category]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateCategoryRequest  $request
	 * @param  \App\Models\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateCategoryRequest $request, Category $category)
	{
		if($category->active_parking){
			return back()->with(['flashMsg' => ['msg' => 'This category has already been used in an active parking.', 'type' => 'warning']]);
		}
		else{
			$validated = $request->validated();

			try {

				$category = Category::where('id', $category->id)->update([

					'type'        => $validated['type'],
					'description' => $validated['description'],
					'status'      => $validated['status'],
					'modified_by' => $request->user()->id
				]);
			} catch (\PDOException $e) {

				return redirect()
					->back()
					->withInput()
					->with(['flashMsg' => ['msg' => $this->getMessage($e), 'type' => 'error']]);
			}

			return redirect()
				->route('category.index')
				->with(['flashMsg' => ['msg' => 'Category successfully updated.', 'type' => 'success']]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Category $category)
	{
		$category->delete();
	}
}
