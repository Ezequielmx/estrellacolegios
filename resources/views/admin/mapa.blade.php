@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
<div id="map" style="height: calc(100vh - 65px);">
    <iframe
        src="https://app.powerbi.com/view?r=eyJrIjoiYjJlZjJiMjYtN2RiNC00MmE5LThmN2MtNWQxMmE3MTU3MTE2IiwidCI6IjMxNWVjODU4LTYxZGUtNDJhNS1iNTEyLTNkOTQwNmI3MTJjMyJ9"
        width="100%" height="100%"
        frameborder="0">
    </iframe>

</div>
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@stop