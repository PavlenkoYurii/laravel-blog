<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8" >
        {!! Form::text('title', null, ['class' => 'form-control', 'required', 'autofocus']) !!}
        <input type="hidden" name="image" value="" id="image">

        <div id="demo"></div>
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    </div>
</div>
<div class="form-group">
    <div class="col-md-8 col-md-offset-2">
        <button type="submit" class="btn btn-primary" id="image_button">
            Find
        </button>
    </div>
</div>
<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
    {!! Form::label('body', 'Body', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::textarea('body', null, ['class' => 'form-control', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('body') }}</strong>
        </span>
    </div>
</div>

<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
    {!! Form::label('category_id', 'Category', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('category_id') }}</strong>
        </span>
    </div>
</div>

@php
    if(isset($post)) {
        $tag = $post->tags->pluck('name')->all();
    } else {
        $tag = null;
    }
@endphp

<div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
    {!! Form::label('tags', 'Tag', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::select('tags[]', $tags, $tag, ['class' => 'form-control select2-tags', 'required', 'multiple']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('tags') }}</strong>
        </span>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>


var bob;
var image = [];
var  text  = '';

$(document).ready(function(){
		$("#image_button").click(function(){
				 bob =  $("#title").val();
				$.get( `/api/image/${bob}`, function( data ) {
						console.log(data)
						image = data;
						for ( var i = 0; i < image.length; i++) {
								text += '<div class="col-md-4"> <img class="image_size" src='+image[i]+ '> </div>';
						}
						document.getElementById("demo").innerHTML = text;

				});
		});
			$("#demo").click(function(e){
					var image_src = $(e.target).attr('src');
					$("#image").val(image_src);
	 });
});

</script>
