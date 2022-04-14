<form class="{{ $class ?? '' }}" method="post" action="{{ $route }}">
    @csrf
    <div class="form-group">
        <input type="text" name="body" class="form-control body" />
        <input type="hidden" name="parent_id" class="parent_id" value="" />
        <input type="hidden" name="model_class" value="{{ $model::class }}" />
        <input type="hidden" name="model_id" value="{{ $model->id }}" />
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-warning submit" value="Add Comment" />
    </div>
</form>
