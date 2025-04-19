@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))
@section('description')
<p>Sistema encontra-se em manutenção para implementação de novos recursos! Tente novamente mais tarde.</p>
@endsection
