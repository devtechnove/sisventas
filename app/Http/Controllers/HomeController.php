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

        $date_current = Carbon::now()->toDateTimeString();

        $prev_date1 = $this->getPrevDate(1);
        $prev_date2 = $this->getPrevDate(2);
        $prev_date3 = $this->getPrevDate(3);
        $prev_date4 = $this->getPrevDate(4);
        $prev_date5 = $this->getPrevDate(5);
        $prev_date6 = $this->getPrevDate(6);
        $prev_date7 = $this->getPrevDate(7);

        $emp_count_0 = Sale::whereBetween('created_at',[$date_current,$date_current])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;
        $emp_count_1 = Sale::whereBetween('created_at',[$prev_date1,$date_current])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;
        $emp_count_2 = Sale::whereBetween('created_at',[$prev_date2,$prev_date1])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;
        $emp_count_3 = Sale::whereBetween('created_at',[$prev_date3,$prev_date2])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;
        $emp_count_4 = Sale::whereBetween('created_at',[$prev_date4,$prev_date3])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;
        $emp_count_5 = Sale::whereBetween('created_at',[$prev_date5,$prev_date4])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;
        $emp_count_6 = Sale::whereBetween('created_at',[$prev_date6,$prev_date5])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;
        $emp_count_7 = Sale::whereBetween('created_at',[$prev_date7,$prev_date6])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;



        $prev_date1 = $this->getPrevDate(1);
        $prev_date2 = $this->getPrevDate(2);
        $prev_date3 = $this->getPrevDate(3);
        $prev_date4 = $this->getPrevDate(4);
        $prev_date5 = $this->getPrevDate(5);
        $prev_date6 = $this->getPrevDate(6);
        $prev_date7 = $this->getPrevDate(7);




        $purch_count_0 = Purchase::whereBetween('created_at',[$date_current,$date_current])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;
        $purch_count_1 = Purchase::whereBetween('created_at',[$prev_date1,$date_current])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;
        $purch_count_2 = Purchase::whereBetween('created_at',[$prev_date2,$prev_date1])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;
        $purch_count_3 = Purchase::whereBetween('created_at',[$prev_date3,$prev_date2])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;
        $purch_count_4 = Purchase::whereBetween('created_at',[$prev_date4,$prev_date3])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;
        $purch_count_5 = Purchase::whereBetween('created_at',[$prev_date5,$prev_date4])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;
        $purch_count_6 = Purchase::whereBetween('created_at',[$prev_date6,$prev_date5])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;
        $purch_count_7 = Purchase::whereBetween('created_at',[$prev_date7,$prev_date6])
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount') / 100;

       // dd($purch_count_2);


        $tasa = $this->bolivares();
        //dd($tasa);

        $sales = Sale::where('empresa_id',\Auth::user()->empresa_id)->completed()
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount');
        $sale_returns = SaleReturn::where('empresa_id',\Auth::user()->empresa_id)->completed()
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount');
        $purchase_returns = PurchaseReturn::where('empresa_id',\Auth::user()->empresa_id)->completed()
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->sum('total_amount');
        $product_costs = 0;
        $sales_completed = Sale::completed()->with('saleDetails')->where('empresa_id',\Auth::user()->empresa_id)->get();
        $currentMonthExpenses = Expense::where('empresa_id',\Auth::user()->empresa_id)->sum('amount') / 100;
        $purchase = Purchase::where('empresa_id',\Auth::user()->empresa_id)
         ->sum('total_amount') / 100;





        foreach ($sales_completed as $sale) {
            foreach ($sale->saleDetails as $saleDetail) {
                $product_costs += $saleDetail->product->product_cost;
            }
        }

        $revenue = ($sales - $sale_returns) / 100;
        $profit = $revenue - $product_costs;

         $date_range = Carbon::today()->subDays(7);

        $sales = Sale::where('date', '<>', $date_range)
            ->where('empresa_id',\Auth::user()->empresa_id)
            ->groupBy('date')
            ->orderBy('date')
            ->get([
                //DB::raw(DB::raw("DATE_TRUNC(date,'%d-%m-%y') as date")),
                DB::raw('sum(cast(total_amount as double precision))'),
            ])
            ->pluck('sum', 'date');



        $start_date = date("Y").'-'.'01'.'-'.'01';
        $end_date = '2022-12-31';  //date("Y").'-'.date("m").'-'.cal_days_in_month(CAL_GREGORIAN,date("m"),date(""));;
        $start_date_mes = date("Y").'-'.date("m").'-'.'01';
        $yearly_sale_amount = [];
        $month[] = date("F", strtotime($start_date));


        $revenue_mes = \DB::table('linea_productos')
                        ->whereDate('fecha', '>=' , $start_date_mes)
                        ->whereDate('fecha', '<=' , $end_date)
                        ->sum('total');

        $recent_sale = \DB::table('sales')
                       ->orderBy('id', 'desc')
                       ->where('empresa_id', \Auth::user()->empresa_id)
                       ->take(5)->get();

         $recent_purchase = Purchase::with('purchaseDetails')
                       ->where('empresa_id',\Auth::user()->empresa_id)
                       ->take(5)
                       ->get();

         $products = Product::orderBy('id', 'desc')
                       ->where('empresa_id', \Auth::user()->empresa_id)
                       ->take(5)
                       ->get();


        //dd($products);
         $recent_expense = Expense::with('category')
                       ->whereDate('date', '>=' , $start_date)
                       ->where('empresa_id', \Auth::user()->empresa_id)
                       ->whereDate('date', '<=' , $end_date)
                       ->get();
        //dd($recent_expense);
         $best_selling_qty = \DB::table('sale_details')
                       ->where('empresa_id',\Auth::user()->empresa_id)
                       ->select(\DB::raw('product_id, sum(quantity) as sold_qty'))
                       ->whereDate('created_at', '>=' , $start_date)
                       ->whereDate('created_at', '<=' , $end_date)
                       ->groupBy('product_id')
                       ->orderBy('sold_qty', 'desc')
                       ->take(5)
                       ->get();
        //dd($best_selling_qty);
         $yearly_best_selling_qty = \DB::table('sale_details')
                       ->where('empresa_id',\Auth::user()->empresa_id)
                      ->select(\DB::raw('product_id, sum(quantity) as sold_qty'))
                      ->whereDate('created_at', '>=' , date("Y").'-01-01')
                      ->whereDate('created_at', '<=' , date("Y").'-12-31')
                      ->groupBy('product_id')
                      ->orderBy('sold_qty', 'desc')
                      ->take(5)
                      ->get();
    //dd($yearly_best_selling_qty);
        $yearly_best_selling_price = \DB::table('sale_details')
                      ->where('empresa_id',\Auth::user()->empresa_id)
                      ->select(\DB::raw('product_id, sum(sub_total / 100) as total_price'))
                      ->whereDate('created_at', '>=' , date("Y").'-01-01')
                      ->whereDate('created_at', '<=' , date("Y").'-12-31')
                      ->groupBy('product_id')
                      ->orderBy('total_price', 'desc')
                      ->take(5)
                      ->get();


        $today = getdate();
        $current_month = $today['mon'];
        $current_year = $today['year'];
        $data_month = [
                        'Enero',
                        'Febrero',
                        'Marzo',
                        'Abril',
                        'Mayo',
                        'Junio',
                        'Julio',
                        'Agosto',
                        'Septiembre',
                        'Octubre',
                        'Noviembre',
                        'Diciembre'
                    ];
        $current_month = $today['mon'];

         $mes_actual = $data_month[$current_month - 1];

        return view('home',
                         [
            'revenue'                   => $revenue,
            'sale_returns'              => $sale_returns / 100,
            'purchase_returns'          => $purchase_returns / 100,
            'profit'                    => $profit,
            'tasa'                      => $tasa,
            'currentMonthExpenses'      => $currentMonthExpenses,
            'emp_count_1'               =>  $emp_count_1,
            'emp_count_2'               =>  $emp_count_2,
            'emp_count_3'               =>  $emp_count_3,
            'emp_count_4'               =>  $emp_count_4,
            'emp_count_5'               =>  $emp_count_5,
            'emp_count_6'               =>  $emp_count_6,
            'emp_count_7'               =>  $emp_count_7,
            'emp_count_0'               =>  $emp_count_0,
            'purch_count_0'             =>  $purch_count_0,
            'purch_count_1'             =>  $purch_count_1,
            'purch_count_2'             =>  $purch_count_2,
            'purch_count_3'             =>  $purch_count_3,
            'purch_count_4'             =>  $purch_count_4,
            'purch_count_5'             =>  $purch_count_5,
            'purch_count_6'             =>  $purch_count_6,
            'purch_count_7'             =>  $purch_count_7,
            'purchase'                  =>  $purchase,
            'revenue_mes'               => $revenue_mes,
            'recent_sale'               => $recent_sale,
            'recent_purchase'           => $recent_purchase,
            'products'                  => $products,
            'recent_expense'            => $recent_expense,
            'best_selling_qty'          => $best_selling_qty,
            'yearly_best_selling_qty'   => $yearly_best_selling_qty,
            'mes_actual'                => $mes_actual,
            'yearly_best_selling_price' => $yearly_best_selling_price

        ]);
       }
    }


    public function currentMonthChart() {
        abort_if(!request()->ajax(), 404);

        $currentMonthSales = Sale::whereMonth('date', date('m'))
                ->where('empresa_id',\Auth::user()->empresa_id)
                ->whereYear('date', date('Y'))

                ->where('empresa_id',\Auth::user()->empresa_id)
                ->sum('total_amount') / 100;

        $currentMonthPurchases = Purchase::whereMonth('created_at', date('m'))
                ->where('empresa_id',\Auth::user()->empresa_id)
                ->whereYear('date', date('Y'))

                ->where('empresa_id',\Auth::user()->empresa_id)
                ->sum('total_amount') / 100;


        $currentMonthExpenses = Expense::whereMonth('date', date('m'))
                ->where('empresa_id',\Auth::user()->empresa_id)
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
            ->where('empresa_id',\Auth::user()->empresa_id)
            ->groupBy('date')->orderBy('date')
            ->get()->pluck('amount', 'date');

        $sale_return_payments = SaleReturnPayment::where('date', '>=', $date_range)
            ->select([
                DB::raw("to_char(date, 'YYYY-MM') as month"),
                DB::raw("SUM(amount) as amount")
            ])
            ->where('empresa_id',\Auth::user()->empresa_id)
            ->groupBy('date')->orderBy('date')
            ->get()->pluck('amount', 'date');

        $purchase_payments = PurchasePayment::whereMonth('created_at', date('m'))
            ->select([
                DB::raw("to_char(date, 'YYYY-MM') as month"),
                DB::raw("SUM(amount) as amount")
            ])
            ->where('empresa_id',\Auth::user()->empresa_id)
            ->groupBy('date')->orderBy('date')
            ->get()->pluck('amount', 'date');

        $purchase_return_payments = PurchaseReturnPayment::where('date', '>=', $date_range)
            ->select([
                //DB::raw("to_char(date, 'YYYY-MM') as month"),
                DB::raw("SUM(amount) as amount")
            ])
            ->where('empresa_id',\Auth::user()->empresa_id)
            ->groupBy('date')->orderBy('date')
            ->get()->pluck('amount', 'date');

        $expenses = Expense::where('date', '>=', $date_range)
            ->select([
                //DB::raw("to_char(date, 'YYYY-MM') as month"),
                DB::raw("SUM(amount) as amount")
            ])
            ->where('empresa_id',\Auth::user()->empresa_id)
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
            ->where('empresa_id',\Auth::user()->empresa_id)
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
            ->where('empresa_id',\Auth::user()->empresa_id)
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
        $tbolivares = \DB::table('tasas')
        ->where('fecha_emision',date('Y-m-d'))
        ->where('empresa_id',\Auth::user()->empresa_id)
        ->count();

        return $tbolivares;
    }

     /**
     *  get the sub month of the given integer
     */
    private function getPrevDate($num){
        return \Carbon\Carbon::now()->subDays($num)->toDateTimeString();
    }
}
