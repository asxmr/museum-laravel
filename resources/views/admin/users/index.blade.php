@extends('layouts.admin')

@section('title', 'Gebruikers')

@section('page-header')
    <h1 class="admin-page-title">Gebruikers</h1>
    <p class="admin-page-subtitle">
        Beheer alle gebruikers van het online museum en bepaal wie adminrechten heeft.
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
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px;
    }

    .admin-table-title {
        font-size: 14px;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        font-family: Georgia, "Times New Roman", serif;
        color: rgba(249,247,244,0.85);
    }

    .btn-admin-primary {
        border-radius: 999px;
        font-size: 12px;
        padding: 8px 16px;
        text-decoration: none;
        background: linear-gradient(120deg, #7B1B38, #b94d6a);
        color: #fdf7f3;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        box-shadow: 0 12px 26px rgba(0,0,0,0.8);
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
    }

    .admin-table th {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.16em;
        font-weight: 500;
        color: rgba(249,247,244,0.75);
        border-bottom: 1px solid rgba(255,255,255,0.08);
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

    .admin-table td {
        color: rgba(249,247,244,0.9);
    }

    .admin-table-muted {
        color: rgba(249,247,244,0.7);
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        padding: 3px 9px;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.16em;
        font-weight: 600;
    }

    .status-pill--admin {
        background: rgba(22,163,74,0.16);
        color: #bbf7d0;
        border: 1px solid rgba(34,197,94,0.45);
    }

    .status-pill--user {
        background: rgba(255,255,255,0.08);
        color: rgba(249,247,244,0.7);
        border: 1px solid rgba(255,255,255,0.2);
    }

    .admin-table-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
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
    }

    .btn-link-edit {
        color: rgba(191,219,254,0.95);
    }

    .btn-link-delete {
        color: rgba(248,113,113,0.95);
    }

    .btn-link-edit:hover,
    .btn-link-delete:hover {
        text-decoration: underline;
    }

    .admin-table-empty {
        text-align: center;
        padding: 18px;
        font-size: 13px;
        color: rgba(249,247,244,0.6);
    }

    .admin-pagination {
        margin-top: 16px;
    }
</style>


@if (session('status'))
    <div class="admin-flash admin-flash--success">
        {{ session('status') }}
    </div>
@endif


<div class="admin-table-header">
    <div class="admin-table-title">Gebruikerslijst</div>

    <a href="{{ route('admin.users.create') }}" class="btn-admin-primary">
        Nieuwe gebruiker
    </a>
</div>


<div class="admin-table-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Email</th>
                <th>Rol</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td class="admin-table-muted">{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td class="admin-table-muted">{{ $user->email }}</td>
                    <td>
                        @if ($user->is_admin)
                            <span class="status-pill status-pill--admin">Admin</span>
                        @else
                            <span class="status-pill status-pill--user">User</span>
                        @endif
                    </td>
                    <td>
                        <div class="admin-table-actions">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn-link-edit">
                                Bewerken
                            </a>

                            <form action="{{ route('admin.users.destroy', $user) }}"
                                  method="POST"
                                  onsubmit="return confirm('Ben je zeker dat je deze gebruiker wilt verwijderen?');">
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
                    <td colspan="5" class="admin-table-empty">
                        Geen gebruikers gevonden.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


@if ($users instanceof \Illuminate\Pagination\AbstractPaginator)
    <div class="admin-pagination">
        {{ $users->links() }}
    </div>
@endif

@endsection
