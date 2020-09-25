@if (session('successMsg'))
    <div class="alert alert-success fade show alert-dismissible" role="alert">
        <strong>success</strong>{{session('successMsg')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times</span>
        </button>
    </div>
@endif
