<?php

namespace Modules\People\Http\Controllers;

use Modules\People\DataTables\SuppliersDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\People\Entities\Supplier;

class SuppliersController extends Controller
{

    public function index(SuppliersDataTable $dataTable) {
        abort_if(Gate::denies('access_suppliers'), 403);

        return $dataTable->render('people::suppliers.index');
    }


    public function create() {
        abort_if(Gate::denies('create_suppliers'), 403);

        return view('people::suppliers.create');
    }


    public function store(Request $request) {
        abort_if(Gate::denies('create_suppliers'), 403);

        $request->validate([
            'supplier_name'  => 'required|string|max:255',
            'supplier_phone' => 'required|max:255',
            'supplier_email' => 'required|email|max:255',
            'supplier_rif'           => 'required|string|max:255',
            //'country'        => 'required|string|max:255',
            'address'        => 'required|string|max:500',
        ]);


        //dd($request->to_modal  == 1);
       if ($request->to_modal == 1) {

             Supplier::create([
            'supplier_name'  => $request->supplier_name,
            'supplier_phone' => $request->supplier_phone,
            'supplier_email' => $request->supplier_email,
            'supplier_rif'   => $request->supplier_rif,
            //'country'        => $request->country,
            'address'        => $request->address
        ]);

        toast('Proveedor creado!', 'success');

        return redirect()->to('purchases/create');


       }
       else
       {
         Supplier::create([
            'supplier_name'  => $request->supplier_name,
            'supplier_phone' => $request->supplier_phone,
            'supplier_email' => $request->supplier_email,
            'supplier_rif'   => $request->supplier_rif,
            //'country'        => $request->country,
            'address'        => $request->address
        ]);

        toast('Supplier Created!', 'success');
        return redirect()->route('suppliers.index');
       }
    }


    public function show(Supplier $supplier) {
        abort_if(Gate::denies('show_suppliers'), 403);
        //dd(\DB::table('purchases')->where('supplier_id',$supplier->id)->get());

        return view('people::suppliers.show', compact('supplier'));
    }


    public function edit(Supplier $supplier) {
        abort_if(Gate::denies('edit_suppliers'), 403);

        return view('people::suppliers.edit', compact('supplier'));
    }


    public function update(Request $request, Supplier $supplier) {
        abort_if(Gate::denies('edit_suppliers'), 403);

        $request->validate([
            'supplier_name'  => 'required|string|max:255',
            'supplier_phone' => 'required|max:255',
            'supplier_email' => 'required|email|max:255',
            //'city'           => 'required|string|max:255',
            'supplier_rif'        => 'required|string|max:255',
            'address'        => 'required|string|max:500',
        ]);

        $supplier->update([
            'supplier_name'  => $request->supplier_name,
            'supplier_phone' => $request->supplier_phone,
            'supplier_email' => $request->supplier_email,
            'supplier_rif'   => $request->supplier_rif,
            //'country'        => $request->country,
            'address'        => $request->address
        ]);

         toast('Proveedor modificado!', 'success');

        return redirect()->route('suppliers.index');
    }


    public function destroy(Supplier $supplier) {
        abort_if(Gate::denies('delete_suppliers'), 403);

        $supplier->delete();

         toast('Proveedor eliminado!', 'success');

        return redirect()->route('suppliers.index');
    }
}
