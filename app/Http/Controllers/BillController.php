<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\BillsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Bill;

class BillController extends Controller
{
    public function index ()
    {

        return view('welcome');

    }

    public function create ()
    {

        return "CREAR";

    }

    public function store (Request $request)
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

    public function edit (Request $request)
    {

        return "EDITAR";

    }

    public function update (Request $request)
    {

        return "ACTUALIZAR";

    }

    public function destroy (Request $request)
    {

        return "ELIMINAR";

    }


}
