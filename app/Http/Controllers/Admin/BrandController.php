<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function index(): View
    {
        $brands = Brand::latest()->paginate(10);

        return view(
            'admin.brands.index',
            compact('brands')
        );
    }

    public function create(): View
    {
        return view('admin.brands.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['name']
        );

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request
                ->file('logo')
                ->store('brands', 'public');
        }

        Brand::create($validated);

        return redirect()
            ->route('admin.brands.index')
            ->with(
                'success',
                'Brand created successfully.'
            );
    }

    public function edit(Brand $brand): View
    {
        return view(
            'admin.brands.edit',
            compact('brand')
        );
    }

    public function update(
        Request $request,
        Brand $brand
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);

        if ($brand->name !== $validated['name']) {
            $validated['slug'] =
                $this->generateUniqueSlug(
                    $validated['name'],
                    $brand->id
                );
        }

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request
                ->file('logo')
                ->store('brands', 'public');
        }

        $brand->update($validated);

        return redirect()
            ->route('admin.brands.index')
            ->with(
                'success',
                'Brand updated successfully.'
            );
    }

    public function destroy(
        Brand $brand
    ): RedirectResponse {
        if ($brand->products()->exists()) {
            return back()->with(
                'error',
                'This brand has products and cannot be deleted.'
            );
        }

        $brand->delete();

        return redirect()
            ->route('admin.brands.index')
            ->with(
                'success',
                'Brand deleted successfully.'
            );
    }

    private function generateUniqueSlug(
        string $name,
        ?int $ignoreId = null
    ): string {
        $slug = Str::slug($name);

        $originalSlug = $slug;

        $counter = 1;

        while (
            Brand::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) =>
                        $query->where(
                            'id',
                            '!=',
                            $ignoreId
                        )
                )
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;

            $counter++;
        }

        return $slug;
    }
}