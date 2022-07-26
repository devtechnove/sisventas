<?php

namespace Modules\Sale\Http\Controllers;
use Illuminate\Routing\Controller;
use Modules\Sale\Entities\Sale;
use Modules\Sale\Entities\Caja;
use Modules\Sale\Entities\Contabilidad;
use Modules\Product\Entities\LineaProducto;
use Modules\Expense\Entities\Expense;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request){
        $buscar = $request->get('buscar');

        if(!$buscar){
            $mytime = Carbon::now('America/Caracas');
            //dd($mytime);
            $buscar=$mytime->format('Y-m-d');
        }

        $cajas = DB::table('cajas')
        ->where('fecha','=',$buscar) 
        ->get();

     

        return view('admin.cajas.index',compact('buscar','cajas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $deno = DB::table('denominacions')
        ->orderby('id','desc')
        ->get();

        $caja = DB::table('cajas')
        ->get();



        
        $mytime = Carbon::now('America/Caracas');
        $fecha=$mytime->format('Y-m-d');

         $today = getdate();
        $data_month = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        //$config = \DB::table('configuraciones')->first();
        $current_month = $today['mon'];
        $current_year = $today['year'];
        $mes_actual =$data_month[$current_month - 1];
        //dd($mes_actual);

        $nombre_dia = date('w');
        switch($nombre_dia)
        {
            case 1: $nombre_dia="Lunes";
            break;
            case 2: $nombre_dia="Martes";
            break;
            case 3: $nombre_dia="Miercoles";
            break;
            case 4: $nombre_dia="Jueves";
            break;
            case 5: $nombre_dia="Viernes";
            break;
            case 6: $nombre_dia="Sabado";
            break;
        }
        //dd($nombre_dia);

        return view('admin.cajas.create',compact('deno','caja','fecha','mes_actual','nombre_dia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          try {

            /*OBTENER DATOS DE LA CAJA */
            $cantidades = $request->get('cantidad');
            $denominacion = $request->get('denominacion');
            $valor = $request->get('valor');

            $deno = $request->get('deno');
            $cont = 0;

            /*OBTENER LA FECHA */
            $mytime = Carbon::now('America/Lima');
            $fecha=$mytime->format('Y-m-d');

            /**OBTENER MES */
            $today = getdate();

        

            $valid_caja = DB::table('cajas')
            ->where([
                ['caja','=',$request->get('caja')],
                ['fecha','=',$fecha],
                ['estado','=','Abierta']
            ])
            ->first();

            if($valid_caja){ 
                 $notification = array(
                'message' => '¡Ya se aperturó una caja para ese cajero este día!',
                'alert-type' => 'error'
            );
                return redirect()->back()->with($notification);
            };

            /**Obtener hora local*/
            $hora = new DateTime("now", new DateTimeZone('America/Lima'));

            /*OBTENER FECHA*/

            $codigo_caja = uniqid();

            $caja = new Caja;
            $caja->codigo = $codigo_caja;
            $caja->fecha = $fecha;
            $caja->hora = $hora->format('H:i:s');
            $caja->user_id=auth()->user()->id;
            $caja->monto = $request->get('monto');
            $caja->caja = 1;
            $caja->estado = 'Abierta';
            $caja->mes=$today['mon'];
            $caja->monto_cierre = '0';
            $caja->year = $today['year'];
            $caja->save();

           

        

            $notification = array(
                'message' => '¡Ya se aperturó una caja para ese cajero este día!',
                'alert-type' => 'error'
            );
                return redirect()->to('admin/panel/contabilidad')->with($notification);
        } catch (\Exception $e) {
            
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function data_caja(Request $request, $codigo)
    {
         $caja = DB::table('cajas')
        ->where('codigo','=',$codigo)
        ->first();

        $venta = Sale::where('idcaja',$caja->id)
        ->get();
        //dd($venta);
        return view('sale::ventas.venta_caja',compact('venta','caja'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function edit(Caja $caja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Caja $caja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caja $caja)
    {
        //
    }
}
