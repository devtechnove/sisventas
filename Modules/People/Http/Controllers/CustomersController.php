<?php

namespace Modules\People\Http\Controllers;

use Modules\People\DataTables\CustomersDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\People\Entities\Customer;
use Modules\Sale\Entities\Sale;

class CustomersController extends Controller
{

    public function index(CustomersDataTable $dataTable) {
        abort_if(Gate::denies('access_customers'), 403);

        return $dataTable->render('people::customers.index');
    }


    public function create() {
        abort_if(Gate::denies('create_customers'), 403);

        return view('people::customers.create');
    }


    public function store(Request $request) {
        abort_if(Gate::denies('create_customers'), 403);

        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_documento' => 'required|max:255',
            'customer_phone' => 'required|string|max:255',
            'address'           => 'required|string|max:255',
        ]);

        Customer::create([
            'customer_name'  => $request->customer_name,
            'customer_documento' => $request->customer_documento,
            'customer_phone' => $request->customer_phone,
            'address'           => $request->address,
            'empresa_id'        => \Auth::user()->empresa_id,
            //'address'        => $request->address
        ]);

        toast('Cliente creado!', 'success');


       if ($request->to_modal) {
           return redirect()->back();
       }
        return redirect()->route('customers.index');
    }


    public function show(Customer $customer) {
        abort_if(Gate::denies('show_customers'), 403);
        $venta = Sale::with('saleDetails')->where('customer_id',$customer->id)->get();
        return view('people::customers.show', compact('customer','venta'));
    }


    public function edit(Customer $customer) {
        abort_if(Gate::denies('edit_customers'), 403);

        return view('people::customers.edit', compact('customer'));
    }


    public function update(Request $request, Customer $customer) {
        abort_if(Gate::denies('update_customers'), 403);

        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_documento' => 'required|max:255',
            'customer_phone' => 'required|string|max:255',
            'address'           => 'required|string|max:255',
            //'country'        => 'required|string|max:255',
            //'address'        => 'required|string|max:500',
        ]);

        $customer->update([
            'customer_name'  => $request->customer_name,
            'customer_documento' => $request->customer_documento,
            'customer_phone' => $request->customer_phone,
            'address'           => $request->address,
            'empresa_id'        => \Auth::user()->empresa_id,
            //'address'        => $request->address
        ]);

        toast('Cliente actualizado!', 'success');

        return redirect()->route('customers.index');
    }


    public function destroy(Customer $customer) {
        abort_if(Gate::denies('delete_customers'), 403);

        $customer->delete();

        toast('Cliente eliminado!', 'success');

        return redirect()->route('customers.index');
    }
}
