@extends('layouts.admin')

@section('title', 'Nieuwe FAQ Vraag')

@section('page-header')
    <h1 class="admin-page-title">Nieuwe FAQ Vraag</h1>
    <p class="admin-page-subtitle">
        Voeg een nieuwe veelgestelde vraag toe aan de collectie, gekoppeld aan een passende categorie.
    </p>
@endsection

@section('content')

    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @include('admin.faqs._form')
    </form>

@endsection
