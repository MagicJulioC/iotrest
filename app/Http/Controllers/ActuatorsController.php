<?php

namespace App\Http\Controllers;

use App\Models\Actuator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ActuatorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        return Actuator::paginate();
    }
    public function show($id)
    {
        return Actuator::find($id);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:actuators',
            'type' => 'required',
            'value' => 'required',
            'date' => 'required',
            'user_id' => 'required'
        ]);
        $actuator = new Actuator();
        $actuator->fill($request->all());
        $actuator->date =date("Y-a-d H-i-s");
        $actuator->user_id = $request->user()->id;
        $actuator->save();
        return $actuator;
    }

     //actualizar un usuario
     public function update(Request $request, $id){
        $actuator = Actuator::find($id);
        if(!$actuator)return response('',404);
        $actuator -> fill($request->all());
        $actuator ->save();
        return $actuator;
    }
    //Eliminar un usuario
    public function delete($id){
        $actuator = Actuator::find($id);
        $actuator ->delete();
        return $actuator;
    }

}
