<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Entities\Category;
use Modules\Product\DataTables\ProductCategoriesDataTable;

class CategoriesController extends Controller
{

     public function index(ProductCategoriesDataTable $dataTable) {
        abort_if(Gate::denies('access_product_categories'), 403);

        return $dataTable->render('product::categories.index');
    }


    public function store(Request $request) {
        abort_if(Gate::denies('access_product_categories'), 403);

        $request->validate([
            'category_code' => 'required|unique:categories,category_code',
            'category_name' => 'required'
        ]);

        Category::create([
            'category_code' => $request->category_code,
            'empresa_id' => \Auth::user()->empresa_id,
            'category_name' => $request->category_name,
        ]);

        toast('¡Categoría creada!', 'success');


        return redirect()->back();
    }

     public function query(Category $model) {
        return $model->newQuery()->withCount('products');
    }


    public function edit($id) {
        abort_if(Gate::denies('access_product_categories'), 403);

        $category = Category::findOrFail($id);

        return view('product::categories.edit', compact('category'));
    }


    public function update(Request $request, $id) {
        abort_if(Gate::denies('access_product_categories'), 403);

        $request->validate([
            'category_code' => 'required|unique:categories,category_code,' . $id,
            'category_name' => 'required'
        ]);

        Category::findOrFail($id)->update([
            'category_code' => $request->category_code,
            'empresa_id' => \Auth::user()->empresa_id,
            'category_name' => $request->category_name,
        ]);

         toast('¡Categoría actualizada!', 'success');

        return redirect()->route('product-categories.index');
    }


    public function destroy($id) {
        abort_if(Gate::denies('access_product_categories'), 403);

        $category = Category::with('products')->findOrFail($id);

        $products = \DB::table('products')
        ->where('category_id',$id)
        ->sum('category_id');

        if ($products > 0) {
            return back()->withErrors('No se puede eliminar porque hay productos asociados a esta categoría.');
        }

        $category->delete();

        toast('¡Categoría eliminada!', 'success');

        return redirect()->route('product-categories.index');
    }
}
