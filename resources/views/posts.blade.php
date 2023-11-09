@extends('layout.layout')
@section('title','Посты')
@section('content')
@include('partials.navbar')

@if(session()->has('error'))
    <div class="alert alert-info">
        {{session('error')}}
        {{session()->forget('error')}}
    </div>
@endif

<form action="{{route('search_posts')}}" method="get">
    <div class="border-faded bg-faded p-3 mb-g d-flex mt-3">
        @csrf
        <input type="text" id="search" name="search"
               class="form-control shadow-inset-2 form-control-lg" placeholder="Найти пользователя">
        <div class="btn-group btn-group-lg btn-group-toggle hidden-lg-down ml-3" data-toggle="buttons">
            <button class="btn btn-info">Поиск</button>
        </div>
    </div>
</form>
    <div class="container text-center">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mt-4">
            @if(count($posts))
            @foreach($posts as $post)
                <div class="col">
                    <div class="card h-100 d-flex flex-column justify-content-between">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <p class="card-text">{{$post->body}}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('post',$post->id)}}" class="btn btn-primary">Прочитать Пост</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
                {{ $posts->appends(['search' => request()->search])->links() }}
    </div>
            @else
                <p>Записей не найдено...</p>
            @endif

@include('partials.scripts')

@endsection
