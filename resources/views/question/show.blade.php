@extends('question.master')
@push('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
@endpush
    @section('content')
        <div class="d-flex align-items-center p-3 my-3  bg-purple rounded shadow-sm">
            <div class="ml-auto">
                <a href="{{route('questions.index')}}" class="btn btn-primary">Back To All Questions</a>
            </div>
        </div>
        <div class="container">
            @include('layouts._message')
            <div class="my-3 p-3 bg-white rounded shadow-sm">

                <h3 class="border-bottom border-gray pb-2 mb-0 media-body">{{$question->title}}</h3>
                <div class="media text-muted pt-3">
                    <div class="d-flex flex-column vote-control">
                        <a class="vote-up {{ Auth::guest() ? 'off': '' }}"
                                onclick="event.preventDefault(); document.getElementById('vote-up-question-{{$question->id}}').submit();"
                            >
                                <i class="fas fa-caret-up"></i>
                            </a>
                            <form action="{{route('question.vote', $question->id) }}" method="POST" id="vote-up-question-{{$question->id}}">
                                @csrf
                                <input type="hidden" value="1" name="vote">
                            </form>
                            <span class="vote-count">{{$question->vote}}</span>
                            <a class="vote-down {{ Auth::guest() ? 'off' : ''}}"
                                onclick="event.preventDefault(); document.getElementById('vote-down-question-{{$question->id}}').submit();"
                            >
                                <i class="fas fa-caret-down"></i>
                            </a>
                            <form action="{{route('question.vote', $question->id)}}" id="vote-down-question-{{$question->id}}" method="POST">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                        <a class="favorite mt-2 {{Auth::guest() ? 'off': ($question->is_favorite ? 'favorited' : '')}}"
                            onclick="event.preventDefault(); document.getElementById('favorite-'+{{$question->id}}).submit()"
                        >
                            <i class="fa fa-star"></i>
                        </a>
                        @if($question->is_favorite)
                        <form id="favorite-{{$question->id}}" action="{{route('question.unfavorite', $question->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        @else
                            <form id="favorite-{{$question->id}}" action="{{route('question.favorite', $question->id)}}" method="POST">
                                @csrf
                            </form>
                        @endif
                        <span class="favorite-count">{{$question->favorite_count}}</span>
                    </div>
                    <div class="media-body">
                        <p class="media-body">
                            {!! $question->body_html !!}
                        </p>
                        <div class="float-right mt-2">
                            <div class="media">
                                <div class="media-body">
                                    <small>Asked By: <strong class="text-gray-dark">{{$question->user->name}}</strong></small>
                                    <img src="{{$question->user->avatar}}">
                                    <div class="media mt-2">
                                        <div class="media-body text-center">
                                            <span><small>{{$question->created_date}}</small></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @include('answers._index', [
                'answers'      => $question->answers,
                'answersCount' => $question->answers_count
            ])
            @include('answers._create')
        </div>
    @endsection

    @push('js')
        <script src="{{asset('js/app.js')}}"></script>
    @endpush
