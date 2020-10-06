@can('accept', $model)
    <a class="{{$model->accepted}} mt-2"
        onclick="event.preventDefault();
        document.getElementById('accept-'+{{$model->id}}).submit();
    ">
    <form action="{{route('answer.accept', $model->id)}}" id="accept-{{$model->id}}" method="POST">
        @csrf
    </form>
        <i class="fas fa-check"></i>
    </a>
@else
    @if ($model->is_best)
        <a class="{{$model->accepted}} mt-2">
            <i class="fas fa-check"></i>
        </a>
    @endif
@endcan
