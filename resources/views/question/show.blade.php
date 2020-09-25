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
                                <strong>{{$question->answers}} </strong>{{Str::plural('answer', $question->answers)}}
                            </div>
                            <div class="views">
                                <strong>{{$question->views}} </strong>{{Str::plural('view', $question->views)}}
                            </div>
                        </div>
                    <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <small>Asked by:</small><strong class="d-block text-gray-dark">{{$question->user->name}}</strong><small>{{$question->created_date}}</small>
                    </p>
                    <p class="media-body">
                        {!! $question->body_html !!}
                    </p>
                    </div>
                </div>
        </div>

    @endsection

