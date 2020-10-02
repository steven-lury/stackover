<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" value="{!! old('title', '') !!}" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" id="title" aria-describedby="titleHelp">
    @if($errors->has('title'))
        <div class="invalid-feedback">
            <strong> {{$errors->first('title')}}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="body">Description</label>
    <textarea rows="6" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}" id="body" name="body">{!! old('body', '')!!}</textarea>
    @if($errors->has('body'))
        <div class="invalid-feedback">
            <strong>{{$errors->first('body')}}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary btn-outline"> {{$btnText}}</button>
</div>
