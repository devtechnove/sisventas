<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Expense\Entities\Expense;
use Modules\Product\Entities\Product;
use Modules\Purchase\Entities\Purchase;
use Modules\Purchase\Entities\PurchasePayment;
use Modules\PurchasesReturn\Entities\PurchaseReturn;
use Modules\PurchasesReturn\Entities\PurchaseReturnPayment;
use Modules\Sale\Entities\Sale;
use Modules\Sale\Entities\SalePayment;
use Modules\SalesReturn\Entities\SaleReturn;
use Modules\SalesReturn\Entities\SaleReturnPayment;

class HomeController extends Controller
{

    public function index() {

     if (\Auth::user()->hasRole('Vendedor')) {

            return redirect('/sales/create');
        }

        else
        {

        $tasa = $this->bolivares();
        //dd($tasa);

        $sales = Sale::completed()->sum('total_amount');
        $sale_returns = SaleReturn::completed()->sum('total_amount');
        $purchase_returns = PurchaseReturn::completed()->sum('total_amount');
        $product_costs = 0;
        $sales_completed = Sale::completed()->with('saleDetails')->get();

        foreach ($sales_completed as $sale) {
            foreach ($sale->saleDetails as $saleDetail) {
                $product_costs += $saleDetail->product->product_cost;
            }
        }

        $revenue = ($sales - $sale_returns) / 100;
        $profit = $revenue - $product_costs;

        return view('home', [
            'revenue'          => $revenue,
            'sale_returns'     => $sale_returns / 100,
            'purchase_returns' => $purchase_returns / 100,
            'profit'           => $profit,
            'tasa'             => $tasa
        ]);
       }
    }


    public function currentMonthChart() {
        abort_if(!request()->ajax(), 404);

        $currentMonthSales = Sale::whereMonth('date', date('m'))
                ->whereYear('date', date('Y'))
                ->sum('total_amount') / 100;

        $currentMonthPurchases = Purchase::whereMonth('created_at', date('m'))
                ->whereYear('date', date('Y'))
                ->sum('total_amount') / 100;


        $currentMonthExpenses = Expense::whereMonth('date', date('m'))
                ->whereYear('date', date('Y'))
                ->sum('amount') / 100;


        return response()->json([
            'sales'     => $currentMonthSales,
            'purchases' => $currentMonthPurchases,
            'expenses'  => $currentMonthExpenses
        ]);
    }


    public function salesPurchasesChart() {
        //abort_if(!request()->ajax(), 404);

        $sales = $this->salesChartData();

        $purchases = $this->purchasesChartData();
        //dd($purchases);
        return response()->json(['sales' => $sales, 'purchases' => $purchases]);
    }


    public function paymentChart() {
        abort_if(!request()->ajax(), 404);

        $dates = collect();
        foreach (range(-11, 0) as $i) {
            $date = Carbon::now()->addMonths($i)->format('m-Y');
            $dates->put($date, 0);
        }

        $date_range = Carbon::today()->subYear()->format('Y-m-d');

        $sale_payments = SalePayment::where('date', '>=', $date_range)
            ->select([
                DB::raw("to_char(date, 'YYYY-MM') as month"),
                DB::raw("SUM(amount) as amount")
            ])
            ->groupBy('date')->orderBy('date')
            ->get()->pluck('amount', 'date');

        $sale_return_payments = SaleReturnPayment::where('date', '>=', $date_range)
            ->select([
                DB::raw("to_char(date, 'YYYY-MM') as month"),
                DB::raw("SUM(amount) as amount")
            ])
            ->groupBy('date')->orderBy('date')
            ->get()->pluck('amount', 'date');

        $purchase_payments = PurchasePayment::whereMonth('created_at', date('m'))
            ->select([
                DB::raw("to_char(date, 'YYYY-MM') as month"),
                DB::raw("SUM(amount) as amount")
            ])
            ->groupBy('date')->orderBy('date')
            ->get()->pluck('amount', 'date');

        $purchase_return_payments = PurchaseReturnPayment::where('date', '>=', $date_range)
            ->select([
                //DB::raw("to_char(date, 'YYYY-MM') as month"),
                DB::raw("SUM(amount) as amount")
            ])
            ->groupBy('date')->orderBy('date')
            ->get()->pluck('amount', 'date');

        $expenses = Expense::where('date', '>=', $date_range)
            ->select([
                //DB::raw("to_char(date, 'YYYY-MM') as month"),
                DB::raw("SUM(amount) as amount")
            ])
            ->groupBy('date')->orderBy('date')
            ->get()->pluck('amount', 'date');

        $payment_received = array_merge_numeric_values($sale_payments, $purchase_return_payments);
        $payment_sent = array_merge_numeric_values($purchase_payments, $sale_return_payments, $expenses);

        $dates_received = $dates->merge($payment_received);
        $dates_sent = $dates->merge($payment_sent);

        $received_payments = [];
        $sent_payments = [];
        $months = [];

        foreach ($dates_received as $key => $value) {
            $received_payments[] = $value;
            $months[] = $key;
        }

        foreach ($dates_sent as $key => $value) {
            $sent_payments[] = $value;
        }

        return response()->json([
            'payment_sent' => $sent_payments,
            'payment_received' => $received_payments,
            'months' => $months,
        ]);
    }

    public function salesChartData() {
        $dates = collect();
        foreach (range(-6, 0) as $i) {
            $date = Carbon::now()->addDays($i)->format('d-m-y');
            $dates->put($date, 0);
        }

        $date_range = Carbon::today()->subDays(7);

        $sales = Sale::where('date', '<>', $date_range)
            ->groupBy('date')
            ->orderBy('date')
            ->get([
                //DB::raw(DB::raw("DATE_TRUNC(date,'%d-%m-%y') as date")),
                DB::raw('sum(cast(total_amount as double precision))'),
            ])
            ->pluck('sum', 'date');
        //dd($sales);

        $dates = $dates->merge($sales);

        $data = [];
        $days = [];
        foreach ($dates as $key => $value) {
            $data[] = $value / 100;
            $days[] = $key;
        }

        return response()->json(['data' => $data, 'days' => $days]);
    }


    public function purchasesChartData() {
        $dates = collect();
        foreach (range(-6, 0) as $i) {
            $date = Carbon::now()->addDays($i)->format('d-m-y');
            $dates->put($date, 0);
        }

        $date_range = Carbon::today()->subDays(6)->format('d-m-y');

        $purchases = Purchase::whereMonth('date', date('m'))
            ->groupBy('date')
            ->orderBy('date')
            ->get([
              //  DB::raw(DB::raw("DATE_TRUNC(date,'%d-%m-%y') as date")),
                DB::raw('SUM(total_amount) AS count'),
            ])
            ->pluck('count', 'date');

            //dd($purchases);


        $dates = $dates->merge($purchases);

        $data = [];
        $days = [];
        foreach ($dates as $key => $value) {
            $data[] = $value / 100;
            $days[] = $key;
        }

        //dd($data);

        return response()->json(['data' => $data, 'days' => $days]);

    }

      public function bolivares()
    {
        $tbolivares = \DB::table('tasas')->where('fecha_emision',date('Y-m-d'))->count();

        return $tbolivares;
    }
}
