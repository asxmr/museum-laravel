<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;

class FaqController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::with(['faqs' => function ($query) {
                $query->where('is_active', true)
                      ->orderBy('sort_order')
                      ->orderBy('question');
            }])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('faq.index', compact('categories'));
    }
}
