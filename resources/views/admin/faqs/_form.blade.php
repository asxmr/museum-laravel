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
        gap: 16px;
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
    .admin-select,
    .admin-textarea,
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

    .admin-textarea {
        resize: vertical;
        min-height: 120px;
    }

    .admin-input--small {
        max-width: 130px;
    }

    .admin-select option {
        background: #111;
        color: #fff;
    }

    .admin-input:focus,
    .admin-textarea:focus,
    .admin-select:focus {
        border-color: rgba(123, 27, 56, 0.9);
        box-shadow: 0 0 0 1px rgba(123, 27, 56, 0.7), 0 12px 28px rgba(0, 0, 0, 0.7);
        background: rgba(10, 9, 16, 0.98);
    }

    .admin-field-error {
        font-size: 12px;
        color: #fca5a5;
    }

    .admin-checkbox-group {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 4px;
    }

    .admin-checkbox {
        width: 18px;
        height: 18px;
        border-radius: 6px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        cursor: pointer;
        accent-color: #7B1B38;
    }

    .admin-checkbox-label {
        font-size: 13px;
        color: rgba(249, 247, 244, 0.8);
    }

    .admin-form-actions {
        margin-top: 20px;
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
</style>



@csrf

<div class="admin-form-card">

    <div class="admin-form-grid">

        <div class="admin-form-field">
            <label class="admin-field-label">Categorie</label>
            <select name="faq_category_id" class="admin-select">
                <option value="">-- Kies een categorie --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('faq_category_id', $faq->faq_category_id ?? null) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('faq_category_id')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="admin-form-field">
            <label class="admin-field-label">Vraag</label>
            <input type="text" name="question"
                value="{{ old('question', $faq->question ?? '') }}"
                class="admin-input">
            @error('question')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="admin-form-field">
            <label class="admin-field-label">Antwoord</label>
            <textarea name="answer" rows="5" class="admin-textarea">{{ old('answer', $faq->answer ?? '') }}</textarea>
            @error('answer')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="admin-checkbox-group">
            <input type="checkbox" name="is_active" id="is_active"
                   value="1"
                   class="admin-checkbox"
                   @checked(old('is_active', $faq->is_active ?? true))>
            <label for="is_active" class="admin-checkbox-label">
                Actief (zichtbaar op publieke FAQ-pagina)
            </label>
        </div>

        <div class="admin-form-field">
            <label class="admin-field-label">Sorteervolgorde</label>
            <input type="number" name="sort_order"
                   value="{{ old('sort_order', $faq->sort_order ?? 0) }}"
                   class="admin-input admin-input--small">
            @error('sort_order')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>

    </div>

  
    <div class="admin-form-actions">
        <a href="{{ route('admin.faqs.index') }}" class="btn-admin-secondary">
            Annuleren
        </a>

        <button type="submit" class="btn-admin-primary">
            Opslaan
        </button>
    </div>

</div>
