@extends('layouts.admin')

@section('title', 'Nieuwsbericht bewerken')

@section('page-header')
    <h1 class="admin-page-title">Nieuwsbericht bewerken</h1>
    <p class="admin-page-subtitle">
        Werk dit nieuwsbericht bij en houd je bezoekers op de hoogte met actuele informatie.
    </p>
@endsection

@section('content')

    <form action="{{ route('admin.news.update', $news) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @include('admin.news._form')

    </form>

@endsection
