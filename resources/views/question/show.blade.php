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
                    <div class="d-flex flex-column counter">
                        <div class="vote">
                            <strong>{{$question->vote}} </strong>{{Str::plural('vote', $question->vote)}}
                        </div>
                        <div class="status {{$question->status}}">
                            <strong>{{$question->answers_count}} </strong>{{Str::plural('answer', $question->answers_count)}}
                        </div>
                        <div class="views">
                            <strong>{{$question->views}} </strong>{{Str::plural('view', $question->views)}}
                        </div>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h5>{{$question->answers_count ." ". Str::plural('Answer', $question->answers_count) }}</h5>
                            </div>
                            <hr>
                            @foreach ($question->answers as $answer)
                                <div class="media">
                                    <div class="media-body">
                                        {!! $answer->body_html !!}
                                        <div class="media float-right">
                                            <div class="media-body">
                                                <small>Answered :</small><strong>{{$answer->user->name}}</strong>
                                                <img src="{{$answer->user->avatar}}">
                                                <div class="media mt-2">
                                                    <div class="media-body text-center">
                                                        <small>{{$answer->date}}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

