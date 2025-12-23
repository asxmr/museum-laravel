@extends('layouts.admin')

@section('title', 'Gebruiker bewerken')

@section('page-header')
    <h1 class="admin-page-title">Gebruiker bewerken</h1>
    <p class="admin-page-subtitle">
        Pas de gegevens, rol en toegangsrechten van deze gebruiker aan
        binnen het online museum.
    </p>
@endsection

@section('content')

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        @include('admin.users.form')

    </form>

@endsection
