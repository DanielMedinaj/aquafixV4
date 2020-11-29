<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use App\Models\Cliente;
use App\Http\Requests\LoginFormRequest;
use Error;
use Illuminate\Support\Facades\Console;

class LoginController extends Controller
{
    public function index(){
        return view::make('index');
    }

    public function ShowMenu(){
        
        return view('menu');
    }

    public function ShowNegocio(){
        return view('aquafix2');
    }

    public function showcurriculum(){
        return view('curriculum');
    }


    public function CrearCliente(Request $request){
        
        $clienteNuevo = new Cliente;
        $clienteNuevo->nombre = $request->nombre;
        $clienteNuevo->apellidos = $request->apellido;
        $clienteNuevo->noTel = $request->telefono;
        $clienteNuevo->correo = $request->correo;
        $clienteNuevo->domicilio = $request->domicilio;
        $clienteNuevo->save();
        
        return Redirect::to('negocio')
                    ->with('mensaje', 'Tus datos han sido registrados, te contactaremos');
    
    }
    public function FormCliente(){
         return view('clientes');
    }
    
    public function ShowClientes(){
        //
        $alumnos = Cliente::all();

        return view('listadoalumnos', compact('alumnos'));
   }


   public function showvolumen(){
    //return view('volumen');
    $longitud=$_GET["longitud"];
    $anchura=$_GET["anchura"];
    $profundidad=$_GET["profundidad"];
    $volumen=0;
    if ($longitud != 0 && $anchura != 0 && $profundidad != 0){
        $volumen=$longitud*$anchura*$profundidad;
       // $area=$pi*$radio;
        //print("El volumen de la alberca es:" . $volumen);
        return back()
        ->with('mensaje', "El volumen de la alberca es: ". $volumen);
    
    }elseif($longitud==0){
        return back()
        ->with('mensaje', "No ingresó el valor de longitud");
    }
    elseif($anchura==0){
        return back()
        ->with('mensaje', "No ingresó el valor de anchura");
    }
    elseif($profundidad==0){
        return back()
        ->with('mensaje', "No ingresó el valor de profundidad");
    }    

}
public function showcalculadora(){
    //return view('radio');
    
$pi=3.1416;
$radio=$_GET["radio"];
$area=0;
if ($radio != 0){
    $radio=$radio*$radio;
    $area=$pi*$radio;
   // return("El area del circulo es:" . $area);
  
   
   return back()
   ->with('mensaje', "El area del circulo es: ". $area);

}elseif($radio==0){
    //print("No ingreso ningun valor");
    return back()
   ->with('mensaje', "No ingresó ningun valor");
}
}




    public function logout(){
        Auth::logout();
          
        return Redirect::to('login')
                    ->with('mensaje_error', 'Tu sesión ha sido cerrada.');
                   
                    
    
                }


    public function authenticate(LoginFormRequest $request){
        
       //return $request;
       
         $credentials = $request->only('usuario', 'password');
        
            if (Auth::attempt($credentials))
            
            {
                return view('menu');
            }
            else
            {
                
                //return response()->json([
                    //'status' => 'Ocurrio un error!',
                    //'msg' => 'Usuario no autorizado.',
                //],401);
                //return Redirect::to('login')
                //->withErrors('mensaje_error', 'Tus datos son incorrectos')
                //->withInput();
            return response()->json(['errors' => ['login' => ['Los datos son incorrectos']]], 422);    
            
            
            }
        }
}
