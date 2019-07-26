{{ Form::open(array('url' => '/secret-two')) }}
				{{Form::label('code', 'Code')}}
				{{ Form::text('code')}}
				{{ Form::label('username', 'Username')}}
				{{ Form::text('username')}}
			    {{Form::submit('Submit')}}
{{ Form::close() }}