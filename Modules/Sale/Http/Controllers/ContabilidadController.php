<?php

namespace Modules\Sale\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Modules\Sale\Entities\Sale;
use Modules\Sale\Entities\Caja;
use Modules\Sale\Entities\Contabilidad;
use Modules\Product\Entities\LineaProducto;
use Modules\Expense\Entities\Expense;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Redirect;

class ContabilidadController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $buscar = $request->get('buscar');

        if(!$buscar){
            $mytime = Carbon::now('America/Lima');
            $buscar=$mytime->format('Y-m-d');
        }

        //$config = DB::table('configuraciones')->first();
        $cajas = DB::table('cajas')
        ->orderBy('id','DESC')
        ->get();
        //dd($cajas);
        return view('sale::cajas.index',compact('buscar','cajas'));
    }

    public function abrir_caja(){
        $deno = DB::table('denominacions')
        ->orderby('id','desc')
        ->get();

        $caja = DB::table('cajas')
        ->get();

        //$config = DB::table('configuraciones')->first();

        //$cajas = explode(",",$config->cajas);

        
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

        return view('sale::cajas.create',compact('deno','caja','fecha','mes_actual','nombre_dia'));
    }

    public function store_abrir_caja(Request $request){



        try {

            /*OBTENER DATOS DE LA CAJA */
            $cantidades = $request->get('cantidad');
            $denominacion = $request->get('denominacion');
            $valor = $request->get('valor');

            $deno = $request->get('deno');
            $cont = 0;

            /*OBTENER LA FECHA */
            $mytime = Carbon::now('America/Caracas');
            $fecha=$mytime->format('Y-m-d');

            /**OBTENER MES */
            $today = getdate();

            $valid_caja = DB::table('cajas')
            ->where([
                ['estado','<>','Cerrada'],
                ['fecha','=',$fecha]
            ])
            ->first();
           // dd($valid_caja);
            if($valid_caja){
                Session::flash('warning', 'Ya se aperturó una caja para ese cajero este día');
                return redirect()->back();
            };

            /**Obtener hora local*/
            $hora = new DateTime("now", new DateTimeZone('America/Caracas'));

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

            //$user = User::findOrFail(auth()->user()->id);
            //$user->caja =$codigo_caja;
            //$user->update();

            while($cont<count($cantidades)){
                $contabilidad = new Contabilidad;
                $contabilidad->denominacion = $denominacion[$cont];
                $contabilidad->valor = $valor[$cont];
                $contabilidad->cantidad = $cantidades[$cont];
                $contabilidad->idcaja =$caja->id;
                $contabilidad->modo = 'Apertura';
                $contabilidad->save();

                $cont = $cont+1;
            }
           

            Session::flash('success', 'Se abrió la caja para el día hoy: '. $fecha .' - '. $hora->format('H:i:s'));
            return Redirect::to('panel/contabilidad');
        } catch (\Exception $e) {
            dd($e);
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }

    public function cerrar_caja($id){
        //$config = DB::table('configuraciones')->first();

        $deno = DB::table('denominacions')
        ->orderby('id','desc')
        ->get();

        $caja = DB::table('cajas')
        ->where('id','=',$id)
        ->first();

        $venta = Sale::where('date',$caja->fecha)
        ->get();

        $mytime = Carbon::now('America/Caracas');
        $fecha=$mytime->format('Y-m-d');


        return view('sale::cajas.cerrar',compact('deno','caja','fecha','venta'));
    }

    public function store_cerrar_caja(Request $request,$id){
       

       // dd($request);
        try {

            $cantidades = $request->get('cantidad');
            $denominacion = $request->get('denominacion');
            $valor = $request->get('valor');

            $cont = 0;

            $mytime = Carbon::now('America/Lima');
            $fecha=$mytime->format('Y-m-d');

            $hora = new DateTime("now", new DateTimeZone('America/Lima'));

            $caja = Caja::findOrFail($id);
            if($request->get('monto') < $caja->monto ){
                Session::flash('warning', 'No se puede cerrar caja con un monto inferior al monto base.');
                return redirect()->back();
            }
            //dd($request->get('monto') == 0);

            if ($request->get('monto') == 0 ) {
             $caja->monto_cierre = $request->total_cierre;
             $caja->estado = 'Cerrada';
             $caja->hora_cierre= $hora->format('H:i:s');
             $caja->update();



            while($cont<count($cantidades)){
                $contabilidad = new Contabilidad;
                $contabilidad->denominacion = $denominacion[$cont];
                $contabilidad->valor = $valor[$cont];
                $contabilidad->cantidad = $cantidades[$cont];
                $contabilidad->idcaja =$caja->id;
                $contabilidad->modo = 'Clausura';
                $contabilidad->save();

                $cont = $cont+1;
            }

            Session::flash('success', 'Se cerró la caja el día hoy: '. $fecha .' - '. $hora->format('H:i:s'));
            return Redirect::to('panel/contabilidad');

            }
            else
            {

            $caja->monto_cierre = $request->get('monto');
            $caja->estado = 'Cerrada';
            $caja->hora_cierre= $hora->format('H:i:s');
            $caja->update();



            while($cont<count($cantidades)){
                $contabilidad = new Contabilidad;
                $contabilidad->denominacion = $denominacion[$cont];
                $contabilidad->valor = $valor[$cont];
                $contabilidad->cantidad = $cantidades[$cont];
                $contabilidad->idcaja =$caja->id;
                $contabilidad->modo = 'Clausura';
                $contabilidad->save();

                $cont = $cont+1;
            }

            }


          

            Session::flash('success', 'Se cerró la caja el día hoy: '. $fecha .' - '. $hora->format('H:i:s'));
            return Redirect::to('panel/contabilidad');

        } catch (\Exception $e) {
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }

    public function semanal(Request $request){

        $today = getdate();
        $data_month = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $current_month = $today['mon'];
        

        if(is_null($request->get('year'))){
            $current_year = $today['year'];
        }else{
            $current_year = $request->get('year');
        }

        //$config = DB::table('configuraciones')->first();

        $caja_mes_anterior = DB::table('cajas') 
        ->select(DB::raw('sum(cast(monto as double precision))'))
        ->select(DB::raw('sum(cast(monto_cierre as double precision))'))
        ->where([
            ['mes','=',$today['mon']-1],
            ['year','=',$current_year]
        ])
        ->first();


        $caja_mes_actual = DB::table('cajas')
        ->select(DB::raw('sum(cast(monto as double precision))'))
        ->select(DB::raw('sum(cast(monto_cierre as double precision))'))
        ->where([
            ['mes','=',$today['mon']],
            ['year','=',$current_year]
        ])
        ->first();



        /*PORCENTAJES*/
   


        $caja_1 = DB::table('cajas')
        ->select(DB::raw('sum(cast(monto as double precision))'))
        ->select(DB::raw('sum(cast(monto_cierre as double precision))'))
        ->where([
            ['mes','=',1],
            ['year','=',$current_year]
        ])
        ->first();


        $caja_2 = DB::table('cajas')
        ->select(DB::raw('sum(cast(monto as double precision))'))
        ->select(DB::raw('sum(cast(monto_cierre as double precision))'))
        ->where([
            ['mes','=',2],
            ['year','=',$current_year]
        ])
        ->first();



        $caja_3 = DB::table('cajas')
        ->select(DB::raw('sum(cast(monto as double precision))'))
        ->select(DB::raw('sum(cast(monto_cierre as double precision))'))
        ->where([
            ['mes','=',3],
            ['year','=',$current_year]
        ])
        ->first();

  
  
        $caja_4 = DB::table('cajas')
        ->select(DB::raw('sum(cast(monto as double precision))'))
        ->select(DB::raw('sum(cast(monto_cierre as double precision))'))
        ->where([
            ['mes','=',4],
            ['year','=',$current_year]
        ])
        ->first();

    

        $caja_5 = DB::table('cajas')
        ->select(DB::raw('sum(cast(monto as double precision))'))
        ->select(DB::raw('sum(cast(monto_cierre as double precision))'))
        ->where([
            ['mes','=',5],
            ['year','=',$current_year]
        ])
        ->first();

  

        $caja_6 = DB::table('cajas')
        ->select(DB::raw('sum(cast(monto as double precision))'))
        ->select(DB::raw('sum(cast(monto_cierre as double precision))'))
        ->where('mes','=',6)
        ->first();



        $caja_7 = DB::table('cajas')
        ->select(DB::raw('sum(cast(monto as double precision))'))
        ->select(DB::raw('sum(cast(monto_cierre as double precision))'))
        ->where([
            ['mes','=',7],
            ['year','=',$current_year]
        ])
        ->first();


        $caja_8 = DB::table('cajas')
        ->select(DB::raw('sum(cast(monto as double precision))'))
        ->select(DB::raw('sum(cast(monto_cierre as double precision))'))
        ->where([
            ['mes','=',8],
            ['year','=',$current_year]
        ])
        ->first();


      
        $caja_9 = DB::table('cajas')
        ->select(DB::raw('sum(cast(monto as double precision))'))
        ->select(DB::raw('sum(cast(monto_cierre as double precision))'))
        ->where([
            ['mes','=',9],
            ['year','=',$current_year]
        ])
        ->first();


        $caja_10 = DB::table('cajas')
        ->select(DB::raw('sum(cast(monto as double precision))'))
        ->select(DB::raw('sum(cast(monto_cierre as double precision))'))
        ->where([
            ['mes','=',10],
            ['year','=',$current_year]
        ])
        ->first();

        

        $caja_11 = DB::table('cajas')
        ->select(DB::raw('sum(cast(monto as double precision))'))
        ->select(DB::raw('sum(cast(monto_cierre as double precision))'))
        ->where([
            ['mes','=',11],
            ['year','=',$current_year]
        ])
        ->first(); 


        $caja_12 = DB::table('cajas')
        ->select(DB::raw('sum(cast(monto as double precision))'))
        ->select(DB::raw('sum(cast(monto_cierre as double precision))'))
        ->where([
            ['mes','=',12],
            ['year','=',$current_year]
        ])
        ->first();


        return view('sale::cajas.semanal',compact('caja_1','caja_2','caja_3','caja_4','caja_5','caja_6','caja_7','caja_8','caja_9','caja_10','caja_11','caja_12','current_year','caja_mes_anterior','caja_mes_actual'));
    }

    public function historial(Request $request){
        $buscar = $request->get('buscar');

        //$config = DB::table('configuraciones')->first();

        $cajas = DB::table('cajas')
        ->where('fecha','LIKE','%'.$buscar.'%')
        ->orderby('id','desc')
        ->paginate(15);

        if($request->ajax()){
            return response()->json(view('sale::cajas.historial',compact('cajas','buscar'))->render());
        }

        return view('sale::cajas.historial',compact('cajas','buscar'));
    }

    public function gastos(){
        $mytime = Carbon::now('America/Lima');
        $fecha=$mytime->format('Y-m-d');

        $caja = DB::table('cajas')
        ->where('user_id','=',auth()->user()->id)
        ->first();

        $config = DB::table('configuraciones')
        ->first();

        if($caja == null){
            Session::flash('danger', 'El usuario no cuenta con una caja asignada');
            return redirect()->back();
        }

        $idcaja = $caja->{'id'};

        $gastos = Gastos::where('idcaja','=',$idcaja)
        ->orderby('id','desc')
        ->get();

        return view('sale::cajas.gasto',compact('fecha','idcaja','gastos','config','caja'));
    }

    public function store_gasto(Request $request){
        $validator = $request->validate([
            'idcaja' => 'required', 
            'detalle' => 'required',
            'precio_gasto' => 'required|numeric',
            'nota' => 'required',
        ]);
        try {
            $gasto = new Gastos;
            $gasto->idcaja = $request->get('idcaja');
            $gasto->detalle = $request->get('detalle');
            $gasto->precio_gasto = $request->get('precio_gasto');
            $gasto->nota = $request->get('nota');
            $gasto->save();

            Session::flash('success', 'Se agregó el gasto a su caja');
            return redirect()->back();

        } catch (\Exception $e) {
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }
}
