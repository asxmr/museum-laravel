@extends('layouts.admin')
 
@section('title', 'Nieuws')
 
@section('content')
    <p> Deze pagina wordt later uitgewerkt.</p>
@endsection
 
 <style>
    .admin-form-card {
        background: rgba(6, 6, 10, 0.9);
        border-radius: 18px;
        padding: 18px 18px 22px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.6);
        margin-top: 12px;
    }

    .admin-form-grid {
        display: grid;
        gap: 18px;
    }

    .admin-form-field {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .admin-field-label {
        font-size: 12px;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        font-family: Georgia, "Times New Roman", serif;
        color: rgba(249, 247, 244, 0.8);
    }

    .admin-input,
    .admin-textarea,
    .admin-file,
    .admin-input--small {
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, 0.16);
        background: rgba(8, 8, 14, 0.92);
        color: #fdf7f3;
        font-size: 14px;
        padding: 9px 12px;
        outline: none;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.5);
        transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
        width: 100%;
    }

    .admin-input:focus,
    .admin-textarea:focus,
    .admin-file:focus {
        border-color: rgba(123, 27, 56, 0.9);
        box-shadow: 0 0 0 1px rgba(123, 27, 56, 0.7), 0 12px 28px rgba(0, 0, 0, 0.7);
        background: rgba(10, 9, 16, 0.98);
    }

    .admin-textarea {
        resize: vertical;
        min-height: 140px;
    }

    .admin-field-error {
        font-size: 12px;
        color: #fca5a5;
    }

    .admin-form-actions {
        margin-top: 24px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn-admin-secondary,
    .btn-admin-primary {
        border-radius: 999px;
        padding: 8px 18px;
        font-size: 13px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid transparent;
        transition: 0.15s ease;
    }

    .btn-admin-secondary {
        background: rgba(255, 255, 255, 0.1);
        color: rgba(249, 247, 244, 0.8);
        border-color: rgba(255, 255, 255, 0.25);
    }

    .btn-admin-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-1px);
    }

    .btn-admin-primary {
        background: linear-gradient(120deg, #7B1B38, #b94d6a);
        color: #fff;
        font-weight: 600;
        box-shadow: 0 12px 26px rgba(0, 0, 0, 0.75);
    }

    .btn-admin-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 32px rgba(0, 0, 0, 0.9);
    }

    .admin-image-preview {
        margin-top: 8px;
    }

    .admin-image-preview img {
        height: 90px;
        border-radius: 10px;
        box-shadow: 0 10px 22px rgba(0, 0, 0, 0.6);
        border: 1px solid rgba(255,255,255,0.15);
    }
</style>


@csrf

<div class="admin-form-card">

    <div class="admin-form-grid">

        <div class="admin-form-field">
            <label class="admin-field-label">Titel</label>
            <input type="text" name="title"
                value="{{ old('title', $news->title ?? '') }}"
                class="admin-input">
            @error('title')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="admin-form-field">
            <label class="admin-field-label">Inhoud</label>
            <textarea name="content" rows="6"
                class="admin-textarea">{{ old('content', $news->content ?? '') }}</textarea>
            @error('content')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="admin-form-field">
            <label class="admin-field-label">Afbeelding (optioneel)</label>
            <input type="file" name="image" class="admin-file">
            @error('image')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror

            @isset($news)
                @if ($news->image_url)
                    <div class="admin-image-preview">
                        <p class="admin-field-label" style="font-size:10px;opacity:0.7;">Huidige afbeelding:</p>
                        <img src="{{ $news->image_url }}" alt="">
                    </div>
                @endif
            @endisset
        </div>

        <div class="admin-form-field">
            <label class="admin-field-label">Publicatiedatum (optioneel)</label>
            <input type="datetime-local" name="published_at"
                value="{{ old('published_at', isset($news->published_at) ? $news->published_at->format('Y-m-d\TH:i') : '') }}"
                class="admin-input">
            @error('published_at')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <div class="admin-form-actions">
        <a href="{{ route('admin.news.index') }}" class="btn-admin-secondary">
            Annuleren
        </a>

        <button type="submit" class="btn-admin-primary">
            Opslaan
        </button>
    </div>

</div>
