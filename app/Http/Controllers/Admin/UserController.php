<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    
    public function create()
    {
        return view('admin.users.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_admin'] = $request->boolean('is_admin');

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('status', 'Gebruiker succesvol aangemaakt.');
    }


    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        $validated['is_admin'] = $request->boolean('is_admin');

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('status', 'Gebruiker succesvol bijgewerkt.');
    }


    public function destroy(User $user)
    {
        
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('status', 'Je kunt jezelf niet verwijderen.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('status', 'Gebruiker verwijderd.');
    }
}
