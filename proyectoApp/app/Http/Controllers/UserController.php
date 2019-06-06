<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function config(){
        return view('user.config');
    }
    public function update(Request $request){

        $id = \Auth::user()->id;
        

        $validate =$this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255' ],
            'email' => ['required', 'string', 'email', 'max:255'],
            ]);

            $user=\Auth::user();

            //$id = $user->id;
        $name=$request->input('name');
        $surname=$request->input('surname');
        $nick=$request->input('nick');
        $email=$request->input('email');
        

        //asignar nuevos valores
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //subir imagen
        $image_path=$request->file('image_path');
            if($image_path){ 
                //nombre unico
                $image_path_name= time().$image_path->getClientOriginalName();
                //guardar imagen con storage
                Storage::disk('users')->put($image_path_name,File::get($image_path));
                //seteo el nombre de la imagen del objeto
                $user->image=$image_path_name;
            }

        //ejecutar consulta 
        $user->update();
        return redirect()->route('config')
                         ->with(['message'=>'Usuario actualizado correctamente']);
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file,200); 

    }
}
