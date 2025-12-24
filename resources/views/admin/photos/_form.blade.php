<style>
    .admin-form-card {
        background: rgba(6, 6, 10, 0.92);
        border-radius: 18px;
        padding: 18px 18px 22px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.65);
        margin-top: 12px;
        position: relative;
        overflow: hidden;
    }

    .admin-form-card::after {
        content: "";
        position: absolute;
        right: -90px;
        top: -90px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: #7B1B38;
        opacity: 0.07;
        pointer-events: none;
    }

    .admin-form-grid {
        display: grid;
        gap: 18px;
        position: relative;
        z-index: 1;
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
        color: rgba(249, 247, 244, 0.82);
    }

    .admin-input,
    .admin-textarea,
    .admin-input--small {
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, 0.16);
        background: rgba(8, 8, 14, 0.92);
        color: #fdf7f3;
        font-size: 14px;
        padding: 9px 12px;
        box-shadow: 0 8px 18px rgba(0,0,0,0.5);
        outline: none;
        transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease, transform 0.12s ease;
    }

    select.admin-input {
        background: rgba(8, 8, 14, 0.92);
        color: #fdf7f3;
    }

    .admin-textarea {
        min-height: 110px;
        resize: vertical;
        line-height: 1.6;
    }

    .admin-input:focus,
    .admin-textarea:focus {
        border-color: rgba(123, 27, 56, 0.95);
        box-shadow: 0 0 0 1px rgba(123, 27, 56, 0.75), 0 12px 28px rgba(0,0,0,0.75);
        background: rgba(10, 9, 16, 0.98);
        transform: translateY(-1px);
    }

    .admin-input--small {
        max-width: 160px;
    }

    .admin-field-error {
        font-size: 12px;
        color: #fca5a5;
    }

    /* Image preview */
    .admin-image-preview {
        margin-bottom: 10px;
    }

    .admin-image-preview img {
        border-radius: 12px;
        width: 96px;
        height: 96px;
        object-fit: cover;
        box-shadow: 0 12px 28px rgba(0,0,0,0.6);
        border: 1px solid rgba(255, 255, 255, 0.14);
    }

    .admin-file {
        padding: 10px 12px;
    }

    .admin-file::file-selector-button {
        border: 1px solid rgba(255,255,255,0.18);
        background: rgba(255,255,255,0.08);
        color: rgba(249,247,244,0.9);
        border-radius: 999px;
        padding: 8px 12px;
        margin-right: 10px;
        cursor: pointer;
        transition: 0.15s ease;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        font-size: 11px;
        font-family: Georgia, "Times New Roman", serif;
    }

    .admin-file::file-selector-button:hover {
        background: rgba(255,255,255,0.14);
        transform: translateY(-1px);
    }


    .admin-checkbox-row {
        display: flex;
        gap: 10px;
        align-items: center;
        padding: 10px 12px;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        background: rgba(8, 8, 14, 0.65);
        box-shadow: 0 8px 18px rgba(0,0,0,0.45);
    }

    .admin-checkbox {
        width: 17px;
        height: 17px;
        accent-color: #7B1B38;
        cursor: pointer;
        flex: 0 0 auto;
    }

    .admin-checkbox-label {
        font-size: 13px;
        color: rgba(249, 247, 244, 0.82);
        line-height: 1.4;
    }


    .admin-form-actions {
        margin-top: 22px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        position: relative;
        z-index: 1;
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
        white-space: nowrap;
    }

    .btn-admin-secondary {
        background: rgba(255,255,255,0.10);
        color: rgba(249,247,244,0.85);
        border-color: rgba(255,255,255,0.22);
    }

    .btn-admin-secondary:hover {
        background: rgba(255,255,255,0.18);
        transform: translateY(-1px);
    }

    .btn-admin-primary {
        background: linear-gradient(120deg, #7B1B38, #b94d6a);
        color: #fff;
        font-weight: 600;
        box-shadow: 0 12px 26px rgba(0,0,0,0.78);
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .btn-admin-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 32px rgba(0,0,0,0.92);
    }
</style>

@csrf

<div class="admin-form-card">

    <div class="admin-form-grid">

        <div class="admin-form-field">
            <label class="admin-field-label">Categorie</label>
            <select name="photo_category_id" class="admin-input">
                <option value="">-- Kies een categorie --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('photo_category_id', $photo->photo_category_id ?? null) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('photo_category_id')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="admin-form-field">
            <label class="admin-field-label">Titel</label>
            <input type="text"
                   name="title"
                   value="{{ old('title', $photo->title ?? '') }}"
                   class="admin-input">
            @error('title')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="admin-form-field">
            <label class="admin-field-label">Beschrijving</label>
            <textarea name="description" class="admin-textarea">{{ old('description', $photo->description ?? '') }}</textarea>
            @error('description')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="admin-form-field">
            <label class="admin-field-label">Afbeelding</label>

            @if (!empty($photo->image_url))
                <div class="admin-image-preview">
                    <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}">
                </div>
            @endif

            <input type="file"
                   name="image"
                   accept="image/*"
                   class="admin-input admin-file">
            @error('image')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="admin-form-field">
            <label class="admin-field-label">Datum genomen</label>
            <input type="date"
                   name="taken_at"
                   value="{{ old('taken_at', optional($photo->taken_at ?? null)->format('Y-m-d')) }}"
                   class="admin-input admin-input--small">
            @error('taken_at')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="admin-form-field">
            <label class="admin-field-label">Publicatie</label>

            <div class="admin-checkbox-row">
                <input type="checkbox"
                       id="is_published"
                       name="is_published"
                       class="admin-checkbox"
                       value="1"
                       @checked(old('is_published', $photo->is_published ?? true))>
                <label for="is_published" class="admin-checkbox-label">
                    Zichtbaar in de publieke galerij
                </label>
            </div>
        </div>

        <div class="admin-form-field">
            <label class="admin-field-label">Sorteervolgorde</label>
            <input type="number"
                   name="sort_order"
                   value="{{ old('sort_order', $photo->sort_order ?? 0) }}"
                   class="admin-input admin-input--small">
            @error('sort_order')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <div class="admin-form-actions">
        <a href="{{ route('admin.photos.index') }}" class="btn-admin-secondary">
            Annuleren
        </a>

        <button type="submit" class="btn-admin-primary">
            Opslaan
        </button>
    </div>

</div>
