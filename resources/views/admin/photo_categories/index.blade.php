@extends('layouts.admin')

@section('title', 'Fotocategorieën')

@section('page-header')
    <h1 class="admin-page-title">Fotocategorieën</h1>
    <p class="admin-page-subtitle">
        Beheer de categorieën van je fotocollectie zodat het museumoverzicht helder en gestructureerd blijft.
    </p>
@endsection

@section('content')

<style>
    .admin-flash {
        border-radius: 999px;
        padding: 8px 14px;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 14px;
        border: 1px solid transparent;
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.6);
    }

    .admin-flash--success {
        background: rgba(22, 101, 52, 0.18);
        border-color: rgba(34, 197, 94, 0.45);
        color: #bbf7d0;
    }

    .admin-table-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 10px;
    }

    .admin-table-title {
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        font-family: Georgia, "Times New Roman", serif;
        color: rgba(249, 247, 244, 0.85);
    }

    .btn-admin-primary {
        border-radius: 999px;
        font-size: 12px;
        padding: 8px 16px;
        border: 1px solid rgba(0, 0, 0, 0.7);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
        white-space: nowrap;
        background: linear-gradient(120deg, #7B1B38, #b94d6a);
        color: #fdf7f3;
        font-weight: 600;
        box-shadow: 0 12px 26px rgba(0, 0, 0, 0.8);
        text-transform: uppercase;
        letter-spacing: 0.12em;
    }

    .btn-admin-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.9);
    }

    .admin-table-card {
        background: rgba(6, 6, 10, 0.96);
        border-radius: 18px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.75);
        overflow: hidden;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .admin-table thead {
        background: linear-gradient(120deg, rgba(123, 27, 56, 0.22), rgba(15, 15, 25, 0.95));
    }

    .admin-table th,
    .admin-table td {
        padding: 10px 14px;
        text-align: left;
    }

    .admin-table th {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.16em;
        font-weight: 500;
        color: rgba(249, 247, 244, 0.75);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .admin-table tbody tr {
        border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        transition: background 0.15s ease, transform 0.1s ease;
    }

    .admin-table tbody tr:nth-child(odd) {
        background: rgba(9, 9, 16, 0.9);
    }

    .admin-table tbody tr:nth-child(even) {
        background: rgba(6, 6, 12, 0.9);
    }

    .admin-table tbody tr:hover {
        background: rgba(123, 27, 56, 0.18);
        transform: translateY(-1px);
    }

    .admin-table td {
        color: rgba(249, 247, 244, 0.9);
        vertical-align: top;
    }

    .admin-table-muted {
        color: rgba(249, 247, 244, 0.7);
    }

    .admin-table-actions {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        white-space: nowrap;
    }

    .btn-link-edit,
    .btn-link-delete {
        background: transparent;
        border: none;
        padding: 0;
        font-size: 11px;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-link-edit {
        color: rgba(191, 219, 254, 0.95);
    }

    .btn-link-edit:hover {
        text-decoration: underline;
    }

    .btn-link-delete {
        color: rgba(248, 113, 113, 0.95);
    }

    .btn-link-delete:hover {
        text-decoration: underline;
    }

    .admin-table-empty {
        text-align: center;
        padding: 18px 14px;
        font-size: 13px;
        color: rgba(249, 247, 244, 0.6);
    }

    @media (max-width: 768px) {
        .admin-table-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

@if (session('status'))
    <div class="admin-flash admin-flash--success">
        {{ session('status') }}
    </div>
@endif

<div class="admin-table-header">
    <div class="admin-table-title">
        Categorieën
    </div>

    <a href="{{ route('admin.photo-categories.create') }}" class="btn-admin-primary">
        Nieuwe categorie
    </a>
</div>

<div class="admin-table-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Omschrijving</th>
                <th>Volgorde</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>
                        {{ $category->name }}
                    </td>

                    <td class="admin-table-muted">
                        {{ $category->description ?? '—' }}
                    </td>

                    <td class="admin-table-muted" style="font-variant-numeric: tabular-nums;">
                        {{ $category->sort_order }}
                    </td>

                    <td>
                        <div class="admin-table-actions">
                            <a href="{{ route('admin.photo-categories.edit', $category) }}"
                               class="btn-link-edit">
                                Bewerken
                            </a>

                            <form action="{{ route('admin.photo-categories.destroy', $category) }}"
                                  method="POST"
                                  onsubmit="return confirm('Deze categorie verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-link-delete">
                                    Verwijderen
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="admin-table-empty">
                        Nog geen fotocategorieën aangemaakt.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
