<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\BillsImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;
use App\Bill;

class BillController extends Controller
{
    public function index ()
    {

        if ($request->ajax()) {

            $bill = Bill::select(['id', 'name', 'lastname', 'document', 'phone', 'email', 'address',
                                'city', 'store', 'article', 'quantity', 'price', 'tax', 'total', 'deleted_at'])
                        ->withTrashed();
                        return Datatables::of($bill)
            
            // BOTONES DE EDICIÓN Y ELIMINACIÓN
            ->addColumn('action', function ($value) {
                $button = '<button value="'.$value->id.'" class="btn btn-link btn-default" OnClick="Mostrar(this);" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i></button>';
                
                if($value->deleted_at != null){
                    $button .= '<button value="'.$value->id.'" class="btn btn-link btn-info" OnClick="Restaurar(this);"><i class="fa fa-undo"></i></button>';

                }
                else{
                    $button .= '<button value="'.$value->id.'" class="btn btn-link btn-danger remove" OnClick="Eliminar(this);"><i class="fa fa-times"></i></button>';
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

    public function store (Request $request)
    {

        // Campos a ingresar para la tabla bills
        $data = [

            'name' => $request->username,
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
            'tax' => $request->tax,
            'total' => $request->total,

        ];

        // insertar datos en la tabla bills
        $bill = Bill::create($data);

        return redirect()->route('bills.index')
                ->with('success', 'Factura(s) <strong>'.$bill->name.'</strong> Ingresado exitosamente!');

        
    }

    public function import (Request $request)
    {
        // Mensaje de notificación
        $message = "Archivo(s) obligatorio(s)";

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

            $message = "Importación exitosa!";

        }

        return redirect(route('sheet'))->with(['message' => $message]);

        
        
    }

    public function edit (Bill $bill)
    {

        return view('bills.edit', [
            
            'bills' => $bill,
            
        ]);

    }

    public function update (Bill $bill, Request $request)
    {

        // Actualizar User
        $bill->update([

            'name' => $request->username,
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
            'tax' => $request->tax,
            'total' => $request->total,
            
        ]);

        return redirect()->route('bills.index')
                ->with('warning', 'Factura(s) <strong>'.$bill->name.'</strong> Actualizada exitosamente!');

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
