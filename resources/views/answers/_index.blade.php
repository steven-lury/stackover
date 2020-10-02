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
