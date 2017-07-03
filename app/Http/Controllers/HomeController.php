<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.$user = new User($request->all());
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function registro(){
        return view('register');
    }
    public function registrar(Request $request){
        $this->validate($request,
            [   'name' => 'required|min:5|max:35',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric'
            ],
            [
                'name.required' => 'El nombre es requerido',
                'name.min' => ' El nombre debe tener minimo 5 caracteres.',
                'name.max' => ' El nombre no debe ser mayor a 35 caracteres.',
                'email.required' => 'El correo es requerido',
                'email.unique'=>'El correo esta ya registrado en la base de datos',
                'email.email' =>'El correo debe ser un formato valido',
                'phone.required'=> 'El telefono es requerido',
                'phone.numeric'=> 'El telefono debe ser un valor numerico'
            ]);
        try{
            $user = new User($request->all());
            $user->save();
            return response()->json(['success', 'message'=>'se ha guardado correctamente'],200); 
        }
        catch(Exception $e){
            return response()->json(['error','message'=>'Hubo un error al guardar'],404);
        }
}
}