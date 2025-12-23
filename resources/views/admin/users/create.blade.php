@extends('layouts.admin')

@section('title', 'Nieuwe gebruiker')

@section('page-header')
    <h1 class="admin-page-title">Nieuwe gebruiker</h1>
    <p class="admin-page-subtitle">
        Voeg een nieuwe gebruiker toe en bepaal meteen zijn rol en toegangsrechten
        binnen het online museum.
    </p>
@endsection

@section('content')

    <form method="POST" action="{{ route('admin.users.store') }}">
        @include('admin.users.form')
    </form>

@endsection
