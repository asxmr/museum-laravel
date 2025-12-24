@extends('layouts.admin')

@section('title', 'Nieuwe foto toevoegen')

@section('page-header')
    <h1 class="admin-page-title">Nieuwe foto toevoegen</h1>
    <p class="admin-page-subtitle">
        Voeg een nieuwe foto toe aan de collectie en koppel ze aan de juiste categorie
        in het online museum.
    </p>
@endsection

@section('content')

    <form action="{{ route('admin.photos.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @include('admin.photos._form')

    </form>

@endsection
