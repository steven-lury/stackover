    @php
        if ($model instanceof App\Models\Answer) {
            $name = 'answer';
            $route = 'answer.vote';
        }elseif($model instanceof App\Models\Question){
            $name = 'question';
            $route = 'question.vote';
        }
        $formId = $name.'-'.$model->id;
    @endphp

    <a class="vote-up {{ Auth::guest() ? 'off': '' }}"
        onclick="event.preventDefault(); document.getElementById('vote-up-{{$formId}}').submit();"
    >
        <i class="fas fa-caret-up"></i>
    </a>
    <form action="{{route($route, $model->id) }}" method="POST" id="vote-up-{{$formId}}">
        @csrf
        <input type="hidden" value="1" name="vote">
    </form>
    <span class="vote-count">{{$model->votes_count}}</span>
    <a class="vote-down {{ Auth::guest() ? 'off' : ''}}"
        onclick="event.preventDefault(); document.getElementById('vote-down-{{$formId}}').submit();"
    >
        <i class="fas fa-caret-down"></i>
    </a>
    <form action="{{route($route, $model->id)}}" id="vote-down-{{$formId}}" method="POST">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
