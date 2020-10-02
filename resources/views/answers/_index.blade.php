<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h5>{{$answersCount ." ". Str::plural('Answer', $answersCount) }}</h5>
                </div>
                <hr>
                @foreach ($answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-control">
                            <a class="vote-up">
                                <i class="fas fa-caret-up"></i>
                            </a>
                            <span class="vote-count">12</span>
                            <a class="vote-down">
                                <i class="fas fa-caret-down"></i>
                            </a>
                            <a class="favorite mt-2">
                                <i class="fas fa-check"></i>
                            </a>
                        </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-md-4">
                                    @can('update', $answer)

                                        <a class="btn btn-sm btn-outline-primary" href="{{route('questions.answers.edit', [$question->id, $answer->id])}}">edit</a>

                                    @endcan
                                    @can('delete', $answer)
                                        <form class="question-form" method="POST" action="{{route('questions.answers.destroy', [$question->id, $answer->id])}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure');" >delete</button>
                                        </form>

                                    @endcan
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
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
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
