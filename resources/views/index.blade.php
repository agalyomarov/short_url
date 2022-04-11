@extends('layouts.main')
@section('content')
    <div class="row" style="margin-top:3%">
        <h1 style="text-align: center">Сокращение ссылок</h1>
        <div class="input-field col s6 offset-s3" style="margin-top:5%">
            <input id="url" type="text" name="url" class="url-name">
            <label for="url">Введите url</label>
            <p style="color:red;" class="hidden error-message"></p>
        </div>
        <div class="input-field col s6 offset-s3">
            @csrf
            <button type="button" class="btn send-url waves-effect waves-light red">СОКРАТИТЬ</button>
        </div>
        <div style="text-align:center;" class="col s6 offset-s3 short-url hidden">
            <h3>Сокращенный ссылка</h3>
            <a href="#"></a>
        </div>
    </div>
@endsection
