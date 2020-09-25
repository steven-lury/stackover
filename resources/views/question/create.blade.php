@extends('question.master')

@section('content')
    <div class="d-flex align-items-center p-3 my-3  bg-purple rounded shadow-sm">

        <h6 class="mb-0 lh-100">Ask A Questions</h6>
        <div class="ml-auto">
            <a href="{{route('questions.index')}}" class="btn btn-primary">Back To Questions</a>
        </div>
        </div>
    </div>

    <div class="container">
        <form method="POST" action="{{route('questions.store')}}">
            @csrf
            @include('question._form', ['btnText' => 'Ask A Question'])
        </form>
    </div>

@endsection
