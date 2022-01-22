<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\Customer;
use App\Loan;

class ApiRegistrosController extends Controller
{
    public function index(Request $request)
    {
        // return response()->json($request);
        # Validacion
        // string $rfc = "", string $start = "", string $end = ""
        if (!isset($request->rfc) && !isset($request->start) && !isset($request->end)) {
            // ningun parametro es enviado
            return response()->json([
                'success' => false, 
                'message' => 'Parametros nos enviados.'
            ], 400);
        } else if (!isset($request->rfc) && isset($request->start) && !isset($request->end)) {
            // solo se mando la fecha de inicio de busqueda
            return response()->json([
                'success' => false, 
                'message' => 'Rango de fechas invalido.'
            ], 400);
        } else if (!isset($request->rfc) && !isset($request->start) && isset($request->end)) {
            // solo se mando la fecha de fin de busqueda
            return response()->json([
                'success' => false, 
                'message' => 'Rango de fechas invalido.'
            ], 400);
        } else if (!isset($request->rfc) && isset($request->start) && isset($request->end)) {
            // se mandan las dos fechas se busca
            return $this->busquedaFechas($request->start, $request->end);
        } else if (isset($request->rfc) && (isset($request->start) || isset($request->end))) {
            // se mandan rfc y posible fecha
            return $this->busquedaRFC($request->rfc);
        } else if (isset($request->rfc) && !isset($request->start) && !isset($request->end)) {
            // se mandan rfc y posible fecha
            return $this->busquedaRFC($request->rfc);
        }
        
    }

    static function busquedaRFC($rfc)
    {
        # variable a retornar
        $data = [];

        # buscar
        $customer = Customer::where('rfc', $rfc)->first();

        if (!empty($customer)) {
            // datos de cliente
            $data['datos_cliente'] = $customer;

            // datos de domicilio
            $address = Address::where('customer_id', $customer->id)->first();
            $data['datos_domicilio'] = $address;

            // datos de credito
            $loan = Address::where('customer_id', $customer->id)->first();
            $data['datos_credito'] = $loan;

        } else {
            return response()->json([
                'success' => true, 
                'datos' => $data,
                'message' => 'No se encontraron datos rfc'
            ], 404);
        }

        return response()->json([
            'success' => true, 
            'datos' => $data
        ], 200);
    }

    static function busquedaFechas($start, $end)
    {
        # variable a retornar
        $data = [];

        # formatos de fechas
        $start = date('Y-m-d', strtotime($start));
        $end = date('Y-m-d', strtotime($end));

        # Busqueda
        // datos de cliente
        $customer = Customer::whereBetween('created_at', [$start, $end])->get();

        if (!empty($customer)) {
            $a = 0;
            foreach ($customer as $c) {
                $data[$a]['datos_cliente'] = $c;

                // datos de domicilio
                $address = Address::where('customer_id', $c->id)->first();
                $data[$a]['datos_domicilio'] = $address;

                // datos de credito
                $loan = Address::where('customer_id', $c->id)->first();
                $data[$a]['datos_credito'] = $loan;

                $a++;
            }
        } else {
            return response()->json([
                'success' => true, 
                'datos' => $data,
                'message' => 'No se encontraron datos'
            ], 404);
        }


        return response()->json([
            'success' => true, 
            'datos' => $data
        ], 200);
    }
}
