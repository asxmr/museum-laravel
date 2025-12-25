<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.faq_categories.index', compact('categories'));
    }

    public function create()
    {
        $category = new FaqCategory();

        return view('admin.faq_categories.create', compact('category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        FaqCategory::create([
            'name'       => $validated['name'],
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.faq-categories.index')
            ->with('status', 'FAQ-categorie aangemaakt.');
    }

    public function edit(FaqCategory $faqCategory)
    {
        $category = $faqCategory;

        return view('admin.faq_categories.edit', compact('category'));
    }

    public function update(Request $request, FaqCategory $faqCategory)
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $faqCategory->update([
            'name'       => $validated['name'],
            'sort_order' => $validated['sort_order'] ?? $faqCategory->sort_order,
        ]);

        return redirect()
            ->route('admin.faq-categories.index')
            ->with('status', 'FAQ-categorie bijgewerkt.');
    }

    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();

        return redirect()
            ->route('admin.faq-categories.index')
            ->with('status', 'FAQ-categorie verwijderd.');
    }
}
