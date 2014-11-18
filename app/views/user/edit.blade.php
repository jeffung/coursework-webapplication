@extends('layouts.master')

@section('navbar')

{{Form::open(['route'=>'user.search', 'class' => "navbar-form navbar-left form-inline"])}}
<div class="form-group">
{{Form::text('keyword', null, ['placeholder' => 'Search for Username',  'class' => 'form-control', 'size' => '25'])}}
  </div>
{{Form::submit('Search', ['class' => 'btn btn-default'])}}
{{ link_to_route('user.create', 'new User', [], ['class' => 'btn btn-info']) }}

{{Form::close()}}

@stop

@section('content')
    <h1> Edit User</h1>

    {{ Form::model($user, ['method'=>'PUT', 'route'=>['user.update', $user->id]]) }}

        <div>
            <dt>{{ Form::label('username', 'Username: ') }}</dt>
            <dd><div>{{ Form::text('username' ) }}
                {{ $errors->first('username') }}</div></dd>
        </div>

        <div>
            <dt>{{ Form::label('password', 'Password: ') }}</dt>
            <dd><div>{{ Form::password('password') }}
                {{ $errors->first('password') }}</div></dd>
       </div>

        <div>
            <dt>{{ Form::label('type', 'Type: ') }}</dt>
            <dd><div>{{ Form::text('Type') }}
                {{ $errors->first('type') }}</div></dd>
       </div>

        <div>
            <dt>{{ Form::label('name', 'Name: ') }}</dt>
            <dd><div>{{ Form::text('name' ) }}
                {{ $errors->first('name') }}</div></dd>
        </div>

        <div>
            <dt>{{ Form::label('email', 'Email: ') }}</dt>
            <dd><div>{{ Form::text('email' ) }}
                {{ $errors->first('email') }}</div></dd>
        </div>

        <div>
            <dt>{{ Form::label('phone', 'Phone Number: ') }}</dt>
            <dd><div>{{ Form::text('phone' ) }}
                {{ $errors->first('phone') }}</div></dd>
        </div>

        <div>
            {{ Form::submit('Edit Contact', ['class' => 'btn btn-info'])}}
        </div>

    {{ Form::close() }}
@stop


