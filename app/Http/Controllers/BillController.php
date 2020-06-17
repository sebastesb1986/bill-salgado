<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormBillRequest;
use App\Imports\BillsImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;
use App\Bill;

class BillController extends Controller
{
    public function index (Request $request)
    {

        if ($request->ajax()) {

            $bill = Bill::select(['id', 'name', 'lastname', 'document', 'phone', 'email', 'address',
                                'city', 'store', 'article', 'quantity', 'price', 'tax', 'total', 'deleted_at'])
                        ->withTrashed();
                        return Datatables::of($bill)
            
            ->addIndexColumn()
            // BOTONES DE EDICIÓN Y ELIMINACIÓN
            ->addColumn('action', function ($value) {
                
                $button = '<a href="' .route('bill.edit', $value->id).'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pencil-alt"></i></a>';

                if($value->deleted_at != null){
                    $button .= '<button value="'.$value->id.'" class="btn btn-info btn-circle btn-sm" OnClick="Restore(this);"><i class="fa fa-undo"></i></button>';

                }
                else{
                    $button .= '<button value="'.$value->id.'" class="btn btn-danger btn-circle btn-sm remove" OnClick="Delete(this);"><i class="fa fa-times"></i></button>';
                }
                return $button;
            })

            //->editColumn('id', '{{$id}}')
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('bills.index');

    }

    public function importView ()
    {

        return view('bills.import');

    }

    public function create ()
    {

        return view('bills.create');

    }

    public function store (FormBillRequest $request)
    {
        // Calculo de valores para IVA, precio y total
        $tax = $request->tax;
        $vCal = ($request->price * $request->quantity);
        $price =  ($vCal * $tax );
        $total = ($vCal + $price);

        // Campos a ingresar para la tabla bills
        $data = [

            'name' => $request->name,
            'lastname' => $request->lastname,
            'password' => $request->password,
            'document' => $request->document,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'store' => $request->store,
            'article' => $request->article,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'tax' => $tax,
            'total' => $total,

        ];

        // insertar datos en la tabla bills
        $bill = Bill::create($data);

        return redirect()->route('bill.index')
                ->with('success', 'Factura(s) <strong>'.$bill->city.'</strong> Ingresado exitosamente!');

        
    }

    public function import (Request $request)
    {
        // Mensaje de notificación
        $message = "<strong> Archivo(s) obligatorio(s) </strong> "; 

        // Validar archivos
        $alert = [

            'excel.*.mimes' => 'El archivo :attribute debe tener la extensión xlsx, xls ó csv para completar la importación!',

        ];

        $rules = [

            'excel.*' => 'required|mimes:xlsx, xls, csv',

        ];

        // Validación de archivos importados
        $this->validate($request, $rules, $alert);

        // Importar uno o mas archivos
        $archives = $request->file('excel');
        $import = new BillsImport;

        if ($request->hasFile('excel')) 
        {
            
            foreach ($archives as $archive) 
            {

                Excel::queueImport($import, $archive);

            }

            $message = "<strong> Sincronización exitosa! </strong> ";

        }

        return redirect(route('sheet'))->with(['success' => $message]);
        
    }

    public function edit (Bill $bill)
    {

        return view('bills.edit', [
            
            'bills' => $bill,
            
        ]);

    }

    public function update (Bill $bill, FormBillRequest $request)
    {
        // Calculo de valores para IVA, precio y total
        $tax = $request->tax;
        $vCal = ($request->price * $request->quantity);
        $price =  ($vCal * $tax );
        $total = ($vCal + $price);

        // Actualizar User
        $bill->update([

            'name' => $request->name,
            'lastname' => $request->lastname,
            'password' => $request->password,
            'document' => $request->document,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'store' => $request->store,
            'article' => $request->article,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'tax' => $tax,
            'total' => $total,
            
        ]);

        return redirect()->route('bill.index')
                ->with('warning', 'Factura(s) <strong>'.$bill->city.'</strong> Actualizada exitosamente!');

    }

    public function restore(Request $request, $id)
    {
       //Indicamos que la busqueda se haga en los registros eliminados con withTrashed
 
        $bill = Bill::withTrashed()->findOrFail($id);
        $bill->restore();

        if ($request->ajax()) {
            return response()->json();
        }
       
    }
    
    public function destroy(Request $request, $id)
    {
        $contact = Bill::findOrFail($id);
        $contact->delete();

        if ($request->ajax()) {
            return response()->json();
        }
        
    }


}
