@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
@section('description')
<p>Você excedeu o limite de solicitações para essa rota. Aguarde alguns minutos e tente novamente.</p>
@endsection
