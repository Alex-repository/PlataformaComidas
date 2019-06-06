<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function _constructo(){
        $this->middleware('auth');
    }
    /*guardar comentario por post */       
    public function save(Request $request){
        //validacion
        $validate = $this->validate($request,[
            'image_id'=>'integer|required',
            'content'=> 'string|required'
        ]);
        //recoger datos
        
        $image_id = $request->input('image_id');
        $content = $request->input('content');
    }
}
