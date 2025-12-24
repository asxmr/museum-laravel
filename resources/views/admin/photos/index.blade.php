@extends('layouts.admin')

@section('title', 'Foto’s beheren')

@section('page-header')
    <h1 class="admin-page-title">Foto’s beheren</h1>
    <p class="admin-page-subtitle">
        Beheer de volledige fotocollectie van het museum: pas titels, categorieën, populariteit en zichtbaarheid aan.
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
        margin-bottom: 14px;
        box-shadow: 0 10px 24px rgba(0,0,0,0.6);
    }

    .admin-flash--success {
        background: rgba(22, 101, 52, 0.18);
        border: 1px solid rgba(34, 197, 94, 0.45);
        color: #bbf7d0;
    }

    .admin-table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        gap: 12px;
    }

    .admin-table-title {
        font-size: 14px;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        font-family: Georgia, serif;
        color: rgba(249,247,244,0.85);
    }

    .btn-admin-primary {
        border-radius: 999px;
        padding: 8px 18px;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        background: linear-gradient(120deg, #7B1B38, #b94d6a);
        color: #fff;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 12px 26px rgba(0,0,0,0.8);
        white-space: nowrap;
    }

    .btn-admin-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 16px 32px rgba(0,0,0,0.9);
    }

    .admin-table-card {
        background: rgba(6,6,10,0.96);
        border-radius: 18px;
        border: 1px solid rgba(255,255,255,0.08);
        box-shadow: 0 18px 40px rgba(0,0,0,0.75);
        overflow: hidden;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .admin-table thead {
        background: linear-gradient(120deg, rgba(123,27,56,0.22), rgba(15,15,25,0.95));
    }

    .admin-table th,
    .admin-table td {
        padding: 10px 14px;
        text-align: left;
        vertical-align: middle;
    }

    .admin-table th {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.16em;
        color: rgba(249,247,244,0.75);
        border-bottom: 1px solid rgba(255,255,255,0.08);
        white-space: nowrap;
    }

    .admin-table tbody tr:nth-child(odd) {
        background: rgba(9,9,16,0.9);
    }

    .admin-table tbody tr:nth-child(even) {
        background: rgba(6,6,12,0.9);
    }

    .admin-table tbody tr:hover {
        background: rgba(123,27,56,0.18);
        transform: translateY(-1px);
    }

    .admin-photo-thumb img {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 10px 24px rgba(0,0,0,0.6);
        border: 1px solid rgba(255,255,255,0.15);
    }

    .admin-table-muted {
        color: rgba(249,247,244,0.7);
    }

    .status-pill {
        border-radius: 999px;
        padding: 3px 9px;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.16em;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
    }

    .status-pill--yes {
        background: rgba(22,163,74,0.16);
        color: #bbf7d0;
        border: 1px solid rgba(34,197,94,0.45);
    }

    .status-pill--no {
        background: rgba(127,29,29,0.16);
        color: #fecaca;
        border: 1px solid rgba(248,113,113,0.6);
    }

    .metric-pill {
        border-radius: 999px;
        padding: 3px 9px;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        border: 1px solid rgba(255,255,255,0.14);
        background: rgba(255,255,255,0.06);
        color: rgba(249,247,244,0.85);
        font-variant-numeric: tabular-nums;
        white-space: nowrap;
    }

    .metric-pill--fav {
        border-color: rgba(123, 27, 56, 0.30);
        background: rgba(123, 27, 56, 0.14);
    }

    .metric-pill--com {
        border-color: rgba(191, 219, 254, 0.25);
        background: rgba(191, 219, 254, 0.10);
    }

    .metric-icon {
        opacity: 0.9;
        font-size: 12px;
        line-height: 1;
    }

    .admin-table-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        white-space: nowrap;
    }

    .btn-link-edit,
    .btn-link-delete {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        background: none;
        border: none;
        cursor: pointer;
        text-decoration: none;
        padding: 0;
    }

    .btn-link-edit { color: #bfdbfe; }
    .btn-link-delete { color: #f87171; }

    .btn-link-edit:hover,
    .btn-link-delete:hover {
        text-decoration: underline;
    }

    .admin-table-empty {
        text-align: center;
        padding: 18px;
        color: rgba(249,247,244,0.6);
    }

    .admin-pagination {
        margin-top: 16px;
    }

    @media (max-width: 900px) {
        .admin-table th:nth-child(6),
        .admin-table td:nth-child(6),
        .admin-table th:nth-child(7),
        .admin-table td:nth-child(7) {
            display: none; 
        }
    }
</style>

@if (session('status'))
    <div class="admin-flash admin-flash--success">
        {{ session('status') }}
    </div>
@endif

<div class="admin-table-header">
    <div class="admin-table-title">Fotogalerij</div>

    <a href="{{ route('admin.photos.create') }}" class="btn-admin-primary">
        Nieuwe foto
    </a>
</div>

<div class="admin-table-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Titel</th>
                <th>Categorie</th>
                <th>Gepubliceerd</th>
                <th>Volgorde</th>
                <th>Favorieten</th>
                <th>Comments</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @forelse ($photos as $photo)
                <tr>
                    <td class="admin-photo-thumb">
                        @if ($photo->image_url)
                            <img src="{{ $photo->image_url }}" alt="">
                        @else
                            <span class="admin-table-muted">—</span>
                        @endif
                    </td>

                    <td>{{ $photo->title }}</td>

                    <td class="admin-table-muted">
                        {{ $photo->category->name ?? '—' }}
                    </td>

                    <td>
                        <span class="status-pill {{ $photo->is_published ? 'status-pill--yes' : 'status-pill--no' }}">
                            {{ $photo->is_published ? 'Ja' : 'Nee' }}
                        </span>
                    </td>

                    <td class="admin-table-muted" style="font-variant-numeric: tabular-nums;">
                        {{ $photo->sort_order }}
                    </td>

                    <td>
                        <span class="metric-pill metric-pill--fav" title="Aantal keer gefavoriet">
                            <span class="metric-icon">❤</span>
                            {{ $photo->favorites_count ?? 0 }}
                        </span>
                    </td>

                    <td>
                        <span class="metric-pill metric-pill--com" title="Aantal reacties">
                            <span class="metric-icon">💬</span>
                            {{ $photo->comments_count ?? 0 }}
                        </span>
                    </td>

                    <td>
                        <div class="admin-table-actions">
                            <a href="{{ route('admin.photos.edit', $photo) }}" class="btn-link-edit">
                                Bewerken
                            </a>

                            <form action="{{ route('admin.photos.destroy', $photo) }}"
                                  method="POST"
                                  onsubmit="return confirm('Deze foto verwijderen? (Favorieten & comments worden ook verwijderd)');">
                                @csrf
                                @method('DELETE')
                                <button class="btn-link-delete">Verwijderen</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="admin-table-empty">
                        Nog geen foto’s toegevoegd.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($photos instanceof \Illuminate\Pagination\AbstractPaginator)
    <div class="admin-pagination">
        {{ $photos->links() }}
    </div>
@endif

@endsection
