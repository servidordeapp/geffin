@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))
@section('description')
<p>Você não está autorizado para acessar essa rota.</p>
@endsection
