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
                            <a class="vote-up {{ Auth::guest() ? 'off': '' }}"
                                onclick="event.preventDefault(); document.getElementById('vote-up-answer-{{$answer->id}}').submit();"
                            >
                                <i class="fas fa-caret-up"></i>
                            </a>
                            <form action="{{route('answer.vote', $answer->id) }}" method="POST" id="vote-up-answer-{{$answer->id}}">
                                @csrf
                                <input type="hidden" value="1" name="vote">
                            </form>
                            <span class="vote-count">{{$answer->votes_count}}</span>
                            <a class="vote-down {{ Auth::guest() ? 'off' : ''}}"
                                onclick="event.preventDefault(); document.getElementById('vote-down-answer-{{$answer->id}}').submit();"
                            >
                                <i class="fas fa-caret-down"></i>
                            </a>
                            <form action="{{route('answer.vote', $answer->id)}}" id="vote-down-answer-{{$answer->id}}" method="POST">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                            @can('accept', $answer)
                                <a class="{{$answer->accepted}} mt-2"
                                    onclick="event.preventDefault();
                                    document.getElementById('accept-'+{{$answer->id}}).submit();
                                ">
                                <form action="{{route('answer.accept', $answer->id)}}" id="accept-{{$answer->id}}" method="POST">
                                    @csrf
                                </form>
                                    <i class="fas fa-check"></i>
                                </a>
                            @else
                                @if ($answer->is_best)
                                    <a class="{{$answer->accepted}} mt-2">
                                        <i class="fas fa-check"></i>
                                    </a>
                                @endif
                            @endcan
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
