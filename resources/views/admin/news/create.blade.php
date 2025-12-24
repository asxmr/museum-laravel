@extends('layouts.admin')

@section('title', 'Nieuw nieuwsbericht')

@section('page-header')
    <h1 class="admin-page-title">Nieuw nieuwsbericht</h1>
    <p class="admin-page-subtitle">
        Publiceer een nieuw bericht om bezoekers op de hoogte te houden van tentoonstellingen, updates en museumnieuws.
    </p>
@endsection

@section('content')

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.news._form')
    </form>

@endsection
