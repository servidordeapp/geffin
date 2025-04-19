@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
@section('description')
<p>Você não tem permissão para acessar este recurso.</p>
@endsection
