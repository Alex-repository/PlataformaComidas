@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @include('includes.message')
        @foreach($images as $image)
                <!-- clase de la publicacion para aplicar css-->
                <div class="card pub_image">
                    <!-- cabecera de la publicacion -->
                    <div class="card-header">
                        <!-- datos del usuario que publica ordenado por fecha -->
                        <div class="data-user">

                            <!-- ruta para ir a detalles de la imagen -->
                            <a href="{{route('image.detail',['id'=>$image->id])}}"></a>

                            {{$image->user->name.' '.$image->user->surname}}

                            <span class="nickname">
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
                        <div class="image-container"> 

                            <img src="{{route ('image.file',['filename'=>$image->image_path])}}" alt="">

                        </div>
                    </div>
                    <!-- recetas de la publicacion -->
                    <div class="description">
                        
                      <span class="nickname">{{'@'.$image->user->nick}} </span>
                      <!-- utilizacion de helper para fechas -->
                      <span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($image->created_at)}}</span>  
                       <p> {{$image->description}} </p> 
                            
                    </div>
                    <!-- likes de la publicacion -->
                    <div class="likes">

                        <img src="{{asset('img/star-black.png')}}" alt="">

                    </div>
                     <!-- comentarios de la publicacion -->
                    <div class="comments">

                        <a href="" class="btn btn-sm btn-warning btn_comments">
                            <!-- contar cantidad de comentarios de la img-->
                            Comentarios {{count($image->comments)}}
                        </a>

                    </div>  
                </div>
        @endforeach
        <!-- Paginacion -->
        <div class="clearfix"></div>
        <!-- metodo para generar en laravel movimiento entre paginas-->
        {{$images->links()}}
        </div>
    </div>
</div>
@endsection
