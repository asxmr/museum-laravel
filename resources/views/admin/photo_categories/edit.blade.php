@extends('layouts.admin')

@section('title', 'Fotocategorie bewerken')

@section('page-header')
    <h1 class="admin-page-title">Fotocategorie bewerken</h1>
    <p class="admin-page-subtitle">
        Werk deze fotocategorie bij zodat je galerij mooi gestructureerd blijft.
    </p>
@endsection

@section('content')

    <form action="{{ route('admin.photo-categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.photo_categories._form')
    </form>

@endsection
