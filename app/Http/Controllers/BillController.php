<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;

class BillController extends Controller
{
    public function index ()
    {

        return "HOLA MUNDO";

    }

    public function create ()
    {

        return "CREAR";

    }

    public function store (Request $request)
    {

        // 

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
