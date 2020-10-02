@extends('question.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h5>Edit Asnwer Relatd To Question: {{$question->title}}</h5>
                </div>
                <hr>

                    <div class="media">

                        <div class="media-body">
                            <form action="{{route('questions.answers.update', [$question->id, $answer->id])}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <textarea name="body" rows="7" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}">{{old('body',$answer->body)}}</textarea>
                                    @if ($errors->has('body'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('body')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>

            </div>
        </div>
    </div>
</div>


@endsection
