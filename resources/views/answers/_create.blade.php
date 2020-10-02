
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h5>Post Your Answer</h5>
                </div>
                <hr>
                <form action="{{route('questions.answers.store', $question->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" rows="4" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"></textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('body')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
