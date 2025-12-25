@extends('layouts.admin')

@section('title', 'FAQ Vraag bewerken')

@section('page-header')
    <h1 class="admin-page-title">FAQ Vraag bewerken</h1>
    <p class="admin-page-subtitle">
        Pas deze veelgestelde vraag aan en zorg dat alle informatie correct en helder blijft voor bezoekers.
    </p>
@endsection

@section('content')

    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.faqs._form')
    </form>

@endsection
