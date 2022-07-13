<?php

namespace Modules\Product\Http\Controllers;

use Modules\Product\DataTables\ProductDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Modules\Product\Entities\Product;
use Modules\Product\Http\Requests\StoreProductRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Modules\Upload\Entities\Upload;

class ProductController extends Controller
{

    public function index(ProductDataTable $dataTable) {
        abort_if(Gate::denies('access_products'), 403);

        return $dataTable->render('product::products.index');
    }


    public function create() {
        abort_if(Gate::denies('create_products'), 403);

        return view('product::products.create');
    }


    public function store(StoreProductRequest $request) {

    //dd(($request->has('document')));

        if ($request->has('document')) {

        $image_names = [];

        $file = $request->document;

        $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);


        $fileName = strtotime(date('Y-m-d H:i:s'));
        $fileName = $fileName . '.' . $ext;


        $file->move(public_path('images/products'), $fileName);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_barcode_symbology = $request->product_barcode_symbology;
        $product->product_quantity = $request->product_quantity;
        $product->product_cost = $request->product_cost;
        $product->product_price = $request->product_price;
        $product->product_unit = $request->product_unit;
        $product->product_stock_alert = $request->product_stock_alert;
        $product->product_order_tax = $request->product_order_tax;
        $product->product_tax_type = $request->product_tax_type;
        $product->product_note = $request->product_note;
        $product->product_image = $fileName;
        $product->save();

        toast('Product Created!', 'success');

        return redirect()->route('products.index');
     }
     else
     {

     }

    }


    public function show(Product $product) {
        abort_if(Gate::denies('show_products'), 403);
        $movimientos = $product->LineasProducto()->orderBy('fecha', 'desc')->paginate(5);
        return view('product::products.show', compact('product','movimientos'));
    }


    public function edit(Product $product) {
        abort_if(Gate::denies('edit_products'), 403);

        return view('product::products.edit', compact('product'));
    }


    public function update(UpdateProductRequest $request, Product $product) {
        $product->update($request->except('document'));

        if ($request->has('document')) {
            if (count($product->getMedia('images')) > 0) {
                foreach ($product->getMedia('images') as $media) {
                    if (!in_array($media->file_name, $request->input('document', []))) {
                        $media->delete();
                    }
                }
            }

            $media = $product->getMedia('images')->pluck('file_name')->toArray();

            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $product->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('images');
                }
            }
        }

        toast('Product Updated!', 'info');

        return redirect()->route('products.index');
    }


    public function destroy(Product $product) {
        abort_if(Gate::denies('delete_products'), 403);

        $product->delete();

        toast('Product Deleted!', 'warning');

        return redirect()->route('products.index');
    }
}
