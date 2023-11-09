@extends('layout.layout')
@section('title','Пост')
@section('content')
@include('partials.navbar')

    <div class="subheader mt-5 ml-3">
        <h3 class="subheader-title">
              <span>
                  Автор - {{$post->user->name}}
              </span>
        </h3>
    </div>

    <form action="{{route('search_comments')}}" method="get">
        <div class="border-faded bg-faded p-3 mb-g d-flex mt-3">
            @csrf
            <input type="text" id="search" name="search"
                   class="form-control shadow-inset-2 form-control-lg" placeholder="Найти комментарий">
            <input type="hidden" name='id' value="{{$post->id}}">
            <div class="btn-group btn-group-lg btn-group-toggle hidden-lg-down ml-3" data-toggle="buttons">
                <button class="btn btn-info">Поиск</button>
            </div>
        </div>
    </form>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title text-center">{{$post->title}}</h5>
                        <p class="card-text text-center">{{$post->body}}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <h5>Комментарии</h5>

                    @if(count($comments))
                    @foreach($comments as $comment)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h3 class="text-info">{{$comment->user->name}}</h3>
                                <p class="card-text">{{$comment->comment}}</p>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
    @else
        <p>Записей не найдено...</p>
    @endif
        </div>
    </div>

    @include('partials.scripts')

@endsection

