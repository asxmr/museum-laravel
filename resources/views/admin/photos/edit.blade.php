@extends('layouts.admin')

@section('title', 'Foto bewerken')

@section('page-header')
    <h1 class="admin-page-title">Foto bewerken</h1>
    <p class="admin-page-subtitle">
        Werk deze foto bij en zorg dat alle details, metadata en categorieën
        correct blijven binnen je fotocollectie.
    </p>
@endsection

@section('content')

    @if (session('status'))
        <div class="admin-flash admin-flash--success" style="margin-bottom: 14px;">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('admin.photos.update', $photo) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @include('admin.photos._form')

    </form>

    @if (!empty($comments) && $comments->count())
        <style>
            .admin-comments-card {
                margin-top: 16px;
                background: rgba(6,6,10,0.92);
                border-radius: 18px;
                padding: 16px;
                border: 1px solid rgba(255,255,255,0.08);
                box-shadow: 0 18px 40px rgba(0,0,0,0.65);
            }

            .admin-comments-title {
                font-size: 12px;
                letter-spacing: 0.16em;
                text-transform: uppercase;
                font-family: Georgia, serif;
                color: rgba(249,247,244,0.78);
                margin-bottom: 10px;
            }

            .admin-comment-row {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 12px;
                padding: 10px 0;
                border-top: 1px solid rgba(255,255,255,0.06);
            }

            .admin-comment-row:first-of-type {
                border-top: none;
                padding-top: 0;
            }

            .admin-comment-meta {
                font-size: 11px;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: rgba(249,247,244,0.65);
                margin-bottom: 6px;
            }

            .admin-comment-body {
                font-size: 13px;
                color: rgba(249,247,244,0.9);
                line-height: 1.6;
                white-space: pre-wrap;
                word-break: break-word;
            }

            .btn-link-delete {
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 0.14em;
                background: none;
                border: none;
                cursor: pointer;
                padding: 0;
                color: #f87171;
                white-space: nowrap;
            }

            .btn-link-delete:hover {
                text-decoration: underline;
            }
        </style>

    @endif

@endsection