<style>
    .admin-form-card {
        background: rgba(6, 6, 10, 0.9);
        border-radius: 18px;
        padding: 18px 18px 20px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.6);
        margin-top: 12px;
    }

    .admin-form-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr);
        gap: 14px;
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
    .admin-input--small {
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.16);
        background: rgba(8, 8, 14, 0.9);
        color: #fdf7f3;
        font-size: 14px;
        padding: 8px 12px;
        outline: none;
        transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.55);
    }

    .admin-input--small {
        max-width: 130px;
    }

    .admin-input::placeholder,
    .admin-input--small::placeholder {
        color: rgba(249, 247, 244, 0.45);
    }

    .admin-input:focus,
    .admin-input--small:focus {
        border-color: rgba(123, 27, 56, 0.9);
        box-shadow: 0 0 0 1px rgba(123, 27, 56, 0.7), 0 12px 28px rgba(0, 0, 0, 0.7);
        background: rgba(10, 9, 16, 0.98);
    }

    .admin-field-error {
        font-size: 12px;
        color: #fca5a5;
        margin-top: 2px;
    }

    .admin-form-actions {
        margin-top: 16px;
        display: flex;
        justify-content: flex-end;
        gap: 8px;
    }

    .btn-admin-secondary,
    .btn-admin-primary {
        border-radius: 999px;
        font-size: 13px;
        padding: 8px 16px;
        border: 1px solid transparent;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
        transition: background 0.15s ease, border-color 0.15s ease, transform 0.1s ease, box-shadow 0.15s ease;
        white-space: nowrap;
    }

    .btn-admin-secondary {
        background: rgba(8, 8, 14, 0.2);
        border-color: rgba(255, 255, 255, 0.2);
        color: rgba(249, 247, 244, 0.8);
    }

    .btn-admin-secondary:hover {
        background: rgba(8, 8, 14, 0.5);
        transform: translateY(-1px);
        box-shadow: 0 10px 22px rgba(0, 0, 0, 0.7);
    }

    .btn-admin-primary {
        background: linear-gradient(120deg, #7B1B38, #b94d6a);
        border-color: rgba(0, 0, 0, 0.6);
        color: #fdf7f3;
        font-weight: 600;
        box-shadow: 0 12px 26px rgba(0, 0, 0, 0.75);
    }

    .btn-admin-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.85);
    }

    @media (max-width: 640px) {
        .admin-form-card {
            padding: 14px 12px 16px;
        }
    }
</style>

@csrf

<div class="admin-form-card">
    <div class="admin-form-grid">
        <div class="admin-form-field">
            <label class="admin-field-label">
                Naam categorie
            </label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $category->name ?? '') }}"
                class="admin-input"
            >
            @error('name')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="admin-form-field">
            <label class="admin-field-label">
                Sorteervolgorde
            </label>
            <input
                type="number"
                name="sort_order"
                value="{{ old('sort_order', $category->sort_order ?? 0) }}"
                class="admin-input admin-input--small"
            >
            @error('sort_order')
                <p class="admin-field-error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="admin-form-actions">
        <a href="{{ route('admin.faq-categories.index') }}"
           class="btn-admin-secondary">
            Annuleren
        </a>

        <button type="submit" class="btn-admin-primary">
            Opslaan
        </button>
    </div>
</div>
