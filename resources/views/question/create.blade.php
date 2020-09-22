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
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control {{$errors->has('title') ? is-invalid : ''}}" id="title" aria-describedby="titleHelp">
                <small id="titleHelp" class="form-text text-muted">Put your title here</small>
                @if($errors->has('tilte'))
                    <div class="invalid-feedback">
                        <strong> {{$erros->first('title')}}</strong>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="body">Description</label>
                <textarea rows="6" class="form-control {{$errors->has('body') ? 'is-invalid' : '')}}" id="body" name="body"></textarea>
                @if($errors->has('body'))
                    <div class="invalid-feedback">
                        <strong>{{$errors->first('body')}}</strong>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-outline"> Ask</button>
            </div>
        </form>
    </div>

@endsection
