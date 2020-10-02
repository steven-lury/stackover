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
                        <a class="vote-up">
                            <i class="fa fa-caret-up"></i>
                        </a>
                        <span class="vote-count">12</span>
                        <a class="vote-down">
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <a class="favorite mt-2">
                            <i class="fa fa-star"></i>
                        </a>
                        <span class="favorite-count">33</span>
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
