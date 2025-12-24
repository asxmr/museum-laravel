@extends('layouts.admin')

@section('title', 'Nieuwe fotocategorie')

@section('page-header')
    <h1 class="admin-page-title">Nieuwe fotocategorie</h1>
    <p class="admin-page-subtitle">
        Voeg een nieuwe categorie toe om je fotocollectie beter te structureren in het online museum.
    </p>
@endsection

@section('content')

    <form action="{{ route('admin.photo-categories.store') }}" method="POST">
        @include('admin.photo_categories._form')
    </form>

@endsection
