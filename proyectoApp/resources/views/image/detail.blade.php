@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        @include('includes.message')
        
                <!-- calse de la publicacion para aplicar css-->
                <div class="card pub_image pub_image_detail">
                    <!-- cabecera de la publicacion -->
                    <div class="card-header">
                        <!-- datos del usuario que publica ordenado por fecha -->
                        <div class="data-user">
                           
                            {{$image->user->name.' '.$image->user->surname}}
                            <span class="nickname">
                            <span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($entrada->created_at)}}</span>
                            {{' | @'.$image->user->nick}}

                            </span>
                        </div>
                        <!-- imagen traida desde usuario por metodo, 
                            sentencia condicional por si usuario posee img avatar-->
                        @if($image->user->image)
                            <div class="container-avatar">

                                <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}"  class="avatar">

                            </div>
                        @endif
                    </div>
                    <!-- cuerpo de la publicacion -->
                    <div class="card-body">
                        <div class="image-detail"> 

                            <img src="{{route ('image.file',['filename'=>$image->image_path])}}" alt="">

                        </div>
                    </div>
                    <!-- recetas de la publicacion -->
                    <div class="description">

                      <span class="nickname">{{'@'.$image->user->nick}} </span>  
                       <p> {{$image->description}} </p> 

                    </div>
                    <!-- likes de la publicacion -->
                    <div class="likes">

                        <img src="{{asset('img/star-black.png')}}" alt="">

                    </div>
                    <div class="clearfix"></div>
                     <!-- comentarios de la publicacion -->
                    <div class="comments">

                            <!-- contar cantidad de comentarios de la img-->
                          <h2>Comentarios {{count($image->comments)}}</h2>  
                         <hr>
                            <!-- aplica comentarios mediante caja de texto y boton de envio-->
                        <form method="POST" action="{{ route('comment.save') }}">
                            @csrf

                            <input type="hidden" name="image_id" value="{{$image->id}}">

                            <p>
                                <textarea class="form-control  {{ $errors->has('content') ? 'is-invalid' : ''}}" name="content" ></textarea>
                            <!-- ante un error de un aviso -->
                            @if($errors->has('content'))

                                <span class="invalid-feedback" role="alert">
                                    <strong>
                                        {{$errors->first('content')}}
                                    </strong>
                                </span>
                            @endif
                            </p>
                            
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </form>
                    </div>  
                </div>
        
        
        </div>
    </div>
</div>
@endsection
