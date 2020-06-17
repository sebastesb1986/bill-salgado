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

        $archives = $request->file('excel');
        $import = new BillsImport;

        if ($request->hasFile('excel')) 
        {
            
            foreach ($archives as $archive) 
            {

                Excel::queueImport($import, $archive);

                $message = $archive->getClientOriginalName();

                return redirect(route('sheet'))->with(['message' => $message ]);

            }

            


        }
        
        return redirect(route('sheet'))->with(['message' => 'Vacio']);

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
