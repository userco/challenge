{{ Form::open(array('url' => '/secret-one')) }}
				{{Form::label('label', 'Label')}}
				{{ Form::text('label')}}
				{{ Form::label('username', 'Username')}}
				{{ Form::text('username')}}
			    {{Form::submit('Submit')}}
{{ Form::close() }}

	 