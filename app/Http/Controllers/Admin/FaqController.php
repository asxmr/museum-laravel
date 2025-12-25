<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::with('category')
            ->orderBy('faq_category_id')
            ->orderBy('sort_order')
            ->orderBy('question')
            ->paginate(15);

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $faq = new Faq();
        $categories = FaqCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.faqs.create', compact('faq', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'faq_category_id' => ['required', 'exists:faq_categories,id'],
            'question'        => ['required', 'string', 'max:255'],
            'answer'          => ['required', 'string'],
            'is_active'       => ['nullable', 'boolean'],
            'sort_order'      => ['nullable', 'integer', 'min:0'],
        ]);

        Faq::create([
            'faq_category_id' => $validated['faq_category_id'],
            'question'        => $validated['question'],
            'answer'          => $validated['answer'],
            'is_active'       => $request->has('is_active'),
            'sort_order'      => $validated['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.faqs.index')
            ->with('status', 'FAQ-vraag aangemaakt.');
    }

    public function edit(Faq $faq)
    {
        $categories = FaqCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.faqs.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'faq_category_id' => ['required', 'exists:faq_categories,id'],
            'question'        => ['required', 'string', 'max:255'],
            'answer'          => ['required', 'string'],
            'is_active'       => ['nullable', 'boolean'],
            'sort_order'      => ['nullable', 'integer', 'min:0'],
        ]);

        $faq->update([
            'faq_category_id' => $validated['faq_category_id'],
            'question'        => $validated['question'],
            'answer'          => $validated['answer'],
            'is_active'       => $request->has('is_active'),
            'sort_order'      => $validated['sort_order'] ?? $faq->sort_order,
        ]);

        return redirect()
            ->route('admin.faqs.index')
            ->with('status', 'FAQ-vraag bijgewerkt.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()
            ->route('admin.faqs.index')
            ->with('status', 'FAQ-vraag verwijderd.');
    }
}
