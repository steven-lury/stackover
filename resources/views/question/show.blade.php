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
                        @include('layouts._vote', [
                            'model' => $question
                        ])
                        @include('layouts._favorite', [
                            'model' => $question
                        ])
                    </div>
                    <div class="media-body">
                        <p class="media-body">
                            {!! $question->body_html !!}
                        </p>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                @include('layouts._author', [
                                    'label' => 'Asked',
                                    'model' => $question
                                ])
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
