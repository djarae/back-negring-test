<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class ProductoController extends Controller
{
    public function index(Request $request)
    {
       error_log("Funciona controller y wea");
      
       return 'HOLA';
    }

    public function store(Request $request)
    {

        error_log("rquest es :A ");
        error_log($request);

        $data = array(
            'name' => 'John Doe',
            'age' => 25,
            'city' => 'Example City'
        );

        return  $data;
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
