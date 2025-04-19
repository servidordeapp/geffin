@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))
@section('description')
<p>Ocorreu um erro interno no servidor. Mas não se preocupe, nossa equipe está trabalhando para resolver o problema.</p>
@endsection
