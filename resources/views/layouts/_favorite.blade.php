<a class="favorite mt-2 {{Auth::guest() ? 'off': ($model->is_favorite ? 'favorited' : '')}}"
    onclick="event.preventDefault(); document.getElementById('favorite-'+{{$model->id}}).submit()"
>
    <i class="fa fa-star"></i>
</a>
@if($model->is_favorite)
<form id="favorite-{{$model->id}}" action="{{route('question.unfavorite', $model->id)}}" method="POST">
    @csrf
    @method('DELETE')
</form>
@else
    <form id="favorite-{{$model->id}}" action="{{route('question.favorite', $model->id)}}" method="POST">
        @csrf
    </form>
@endif
<span class="favorite-count">{{$model->favorite_count}}</span>
