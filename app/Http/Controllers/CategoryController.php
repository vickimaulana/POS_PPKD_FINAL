<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {
        $datas = Category::notDelete()->orderBy('id', 'desc')->get();
        // return $datas;
        return view('admin.categories.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validation  = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation)
                ->withInput();
        }

        Category::create([
            'category_name' => $request->name,
        ]);

        Alert::success('Success', 'Category created successfully');

        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category || $category->is_deleted) {
            Alert::error('Error', 'Category not found');
            return redirect()->route('category.index');
        }

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category || $category->is_deleted) {
            Alert::error('Error', 'Category not found');
            return redirect()->route('category.index');
        }

        $validation  = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation)
                ->withInput();
        }

        $category->update([
            'category_name' => $request->name,
        ]);

        Alert::success('Success', 'category updated successfully');
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        // return $category;
        if (!$category) {
            Alert::error('Error', 'Category not found');
            return redirect()->route('category.index');
        }

        $category->update([
            'category_name' => $category->category_name,
            'is_deleted' => 1,
        ]);

        Alert::success('Success', 'Category deleted successfully');
        return redirect()->route('category.index');
    }
}
