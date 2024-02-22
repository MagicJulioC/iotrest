<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SensorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        return Sensor::paginate();
    }
    public function show($id)
    {
        return Sensor::find($id);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:sensors',
            'type' => '$required',
            'value' => '$required',
            'date' => '$required',
            'user_id' => '$required'
        ]);
        $sensor = new Sensor();
        $sensor->fill($request->all());
        $sensor->save();
        return $sensor;
    }

     //actualizar un usuario
     public function update(Request $request, $id){
        $sensor = Sensor::find($id);
        if(!$sensor)return response('',404);
        $sensor -> fill($request->all());
        $sensor ->save();
        return $sensor;
    }
    //Eliminar un usuario
    public function delete($id){
        $sensor = Sensor::find($id);
        $sensor ->delete();
        return $sensor;
    }

}
