<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required'
        ]);
        $validData['slug'] = unique_slug($validData['slug'], Page::class);

        Page::create($validData);
        return to_route('page.index')->with('flash.banner', 'تم إنشاء الصفحة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $validData = $request->validate([
            'title' => 'required',
            'slug' => [
                'required',
                Rule::unique('pages', 'slug')->ignore($page->id)
            ],
            'content' => 'required'
        ]);

        $page->update($validData);

        return to_route('page.index')->with('flash.banner', 'تم تعديل الصفحة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return back()->with('flash.banner', 'تم حذف الصفحة بنجاح');
    }
}
