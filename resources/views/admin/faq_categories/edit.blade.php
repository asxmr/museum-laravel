@extends('layouts.admin')

@section('title', 'FAQ Categorie bewerken')

@section('page-header')
    <h1 class="admin-page-title">Categorie bewerken</h1>
    <p class="admin-page-subtitle">
        Pas de eigenschappen van deze FAQ-categorie aan om de structuur van je veelgestelde vragen scherp te houden.
    </p>
@endsection

@section('content')

    <form action="{{ route('admin.faq-categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.faq_categories._form')
    </form>

@endsection
