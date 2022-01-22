<?php

namespace App\Http\Controllers;

use App\Address;
use App\Customer;
use App\Loan;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function salvarRegistro(Request $request)
    {
        $exist_rfc = Customer::where('rfc', $request->datos_personal['rfc'])->first();

        if (!$exist_rfc) {
            $customer = Customer::create([
                'nombre' => $request->datos_personal['nombre'],
                'apellido_paterno' => $request->datos_personal['apellido_paterno'],
                'apellido_materno' => $request->datos_personal['apellido_materno'],
                'rfc' => $request->datos_personal['rfc'],
                'fecha_nacimiento' => $request->datos_personal['fecha_nacimiento'],
                'ingresos' => $request->datos_personal['ingresos'],
                'egresos' => $request->datos_personal['egresos'],
                'no_dependientes' => $request->datos_personal['no_dependientes'],
                'estado_civil' => $request->datos_personal['estado_civil'],
                'genero' => $request->datos_personal['genero'],
                'ultimo_grado_estudios' => $request->datos_personal['ultimo_grado_estudios'],
                'status_id' => 1,
            ]);
    
            $address = Address::create([
                'customer_id' => $customer->id,
                'calle' => $request->datos_domicilio['calle'],
                'no_exterior' => $request->datos_domicilio['no_exterior'],
                'no_interior' => $request->datos_domicilio['no_interior'],
                'colonia' => $request->datos_domicilio['colonia'],
                'municipio' => $request->datos_domicilio['municipio'],
                'estado' => $request->datos_domicilio['estado'],
                'cp' => $request->datos_domicilio['cp'],
                'status_id' => 5,
            ]);
    
            $loan = Loan::create([
                'customer_id' => $customer->id,
                'monto' => $request->datos_credito['monto'],
                'plazo' => $request->datos_credito['plazo'],
                'pago_mensual' => $request->datos_credito['pago_mensual'],
                'tasa_interes' => $request->datos_credito['tasa_interes'],
            ]);
    
            if ($customer && $address && $loan) {
                return response()->json(['success' => true, 'rfc' => $customer->rfc]);
            }

            return response()->json(['success' => false]);

        } else {
            if ($exist_rfc->status_id == 3) {
                return response()->json(['success' => false, 'message' => 'Oferta Aceptada!', 'rfc' => $exist_rfc->rfc]);
            } else if ($exist_rfc->status_id == 4) {
                return response()->json(['success' => false, 'message' => 'Oferta Rechazada!', 'rfc' => $exist_rfc->rfc]);
            }
            return response()->json(['success' => true, 'rfc' => $exist_rfc->rfc]);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $rfc)
    {
        return view('proceso', ['rfc' => $rfc]);
    }

    public function getDatosCliente(string $rfc)
    {
        $data = [];
        $customer = Customer::where('rfc', $rfc)->first();
        $address = Address::where('customer_id', $customer->id)->first();
        // $loan = Loan::where('customer_id', $customer->id)->first();

        $data['datos_cliente'] = $customer;
        $data['datos_domicilio'] = $address;
        // $data['datos_credito'] = $loan;

        // dd($data);
        return response()->json($data);
    }

    public function getDatosCredito(string $rfc)
    {
        $data = [];
        $customer = Customer::where('rfc', $rfc)->first();
        $loan = Loan::where('customer_id', $customer->id)->first();

        if ($customer->status_id == 3 || $customer->status_id == 4) {
            $customer->nueva_fecha = date('Y-m-d', strtotime("+1 month", strtotime($customer->updated_at)));
        }

        $data['datos_cliente'] = $customer;
        $data['datos_credito'] = $loan;

        // dd($customer);
        return response()->json($data);
    }

    public function salvarCambios(Request $request)
    {
        $customer = Customer::find($request->cliente['id']);
        

        if ($customer) {
            $address = Address::where('customer_id', $customer->id)->first();
            $address->calle = strtoupper($request->domicilio['calle']);
            $address->no_exterior = strtoupper($request->domicilio['no_exterior']);
            $address->no_interior = strtoupper($request->domicilio['no_interior']);
            $address->colonia = strtoupper($request->domicilio['colonia']);
            $address->municipio = strtoupper($request->domicilio['municipio']);
            $address->estado = strtoupper($request->domicilio['estado']);
            $address->cp = strtoupper($request->domicilio['cp']);
            $address->status_id = 6;
            
            if ($address->save()) {
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['success' => false]);
    }

    public function updateOferta(Request $request)
    {
        $customer = Customer::where('rfc', $request->rfc)->first();
        $customer->status_id = $request->status;
        
        if ($customer->save()) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
