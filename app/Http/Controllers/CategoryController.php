<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Category List";
        $categories = Category::where('is_delete', 0)->get();
        return view('admin.category.index', ['title' => $title, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Add Category";
        $parents = Category::where('is_delete', 0)->get();
        return view('admin.category.add', ['title' => $title, 'parents' => $parents]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = new Category;
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->image = $request->input('image');
        $category->parent_id = $request->input('parent_id');
        $category->is_active = $request->has('is_active') ? 1 : 0;
        $category->is_delete = 0;
        $category->save();

        return redirect('/category');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect('/category');
    }

    public function getdetail(string $id = null)
    {
        return redirect('/category');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::where('is_delete', 0)->findOrFail($id);
        $invalidIds = array_merge([$category->id], $this->getDescendantIds($category->id));
        $parents = Category::where('is_delete', 0)
            ->whereNotIn('id', $invalidIds)
            ->get();

        return view('admin.category.edit', ['category' => $category, 'parents' => $parents]);
    }

    public function update(Request $request, string $id)
    {
        $category = Category::where('is_delete', 0)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $parentId = $request->input('parent_id');
        $invalidIds = array_merge([$category->id], $this->getDescendantIds($category->id));
        if (!empty($parentId) && in_array((int) $parentId, $invalidIds, true)) {
            return back()->withErrors(['parent_id' => 'Parent category is not valid.'])->withInput();
        }

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->image = $request->input('image');
        $category->parent_id = $parentId;
        $category->is_active = $request->has('is_active') ? 1 : 0;
        $category->save();

        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->is_delete = 1;
        $category->save();

        return redirect('/category');
    }

    private function getDescendantIds(int $id): array
    {
        $childIds = Category::where('parent_id', $id)->pluck('id')->toArray();
        $allIds = $childIds;

        foreach ($childIds as $childId) {
            $allIds = array_merge($allIds, $this->getDescendantIds($childId));
        }

        return $allIds;
    }
}
