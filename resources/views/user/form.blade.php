<div class="box box-info padding-1">
    <div class="box-body">

        <input type="hidden" name="user" value="{{ $user->id ?? '' }}">

        <div class="form-group">
            {{ Form::label('name', 'Nombre interno') }}
            {{ Form::text('name', $user->name ?? old('name'), ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre interno']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('username', 'Nombre de usuario') }}
            {{ Form::text('username', $user->username ?? old('username'), ['class' => 'form-control' . ($errors->has('username') ? ' is-invalid' : ''), 'placeholder' => 'username']) }}
            {!! $errors->first('username', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('identificacion', 'Identificación') }}
            {{ Form::text('identificacion', $user->identificacion ?? old('identificacion'), ['class' => 'form-control' . ($errors->has('identificacion') ? ' is-invalid' : ''), 'placeholder' => 'Documento de identidad']) }}
            {!! $errors->first('identificacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('nombre_completo', 'Nombre completo') }}
            {{ Form::text('nombre_completo', $user->nombre_completo ?? old('nombre_completo'), ['class' => 'form-control' . ($errors->has('nombre_completo') ? ' is-invalid' : ''), 'placeholder' => 'Nombre completo del usuario']) }}
            {!! $errors->first('nombre_completo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('correo', 'Correo') }}
            {{ Form::email('correo', $user->correo ?? old('correo'), ['class' => 'form-control' . ($errors->has('correo') ? ' is-invalid' : ''), 'placeholder' => 'ejemplo@correo.com']) }}
            {!! $errors->first('correo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('telefono', 'Teléfono') }}
            {{ Form::text('telefono', $user->telefono ?? old('telefono'), ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Número de contacto']) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
    </div>
</div>
