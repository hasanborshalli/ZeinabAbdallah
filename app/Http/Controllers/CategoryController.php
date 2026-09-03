<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryImage;
use App\Models\Package;
use App\Models\Theme;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {

        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'highlight' => 'nullable|string|max:255',
            'highlight_ar' => 'nullable|string|max:255',
            'icon' => 'required|string|max:255',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'notes' => 'nullable|array',
            'notes.*.note' => 'nullable|string|max:255',
            'notes.*.note_ar' => 'nullable|string|max:255',
        ]);

        $notes = $this->cleanNotes($fields['notes'] ?? []);
        unset($fields['notes']);

        $image = $request->file('main_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/assets/images/categories'), $imageName);
            $fields['main_image']= '/assets/images/categories/' . $imageName;

        $category = Category::create($fields);

        $category->notes()->createMany($notes);

        return redirect()->route('admin.categories.page')->with('success', 'Category added successfully.');
    }
    public function editCategory(Request $request,Category $category){
        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'highlight' => 'nullable|string|max:255',
            'highlight_ar' => 'nullable|string|max:255',
            'icon' => 'required|string|max:255',
            'main_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'notes' => 'nullable|array',
            'notes.*.note' => 'nullable|string|max:255',
            'notes.*.note_ar' => 'nullable|string|max:255',
        ]);

        $notes = $this->cleanNotes($fields['notes'] ?? []);
        unset($fields['notes']);

        if (isset($fields['main_image'])) {
            $image = $request->file('main_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/assets/images/categories'), $imageName);
            $fields['main_image'] = '/assets/images/categories/' . $imageName;
        }
        $category->update($fields);

        $category->notes()->delete();
        $category->notes()->createMany($notes);

        return redirect()->route('admin.categories.page')->with(['success'=>'Category edited successfully']);
    }

    public function deleteCategory(Category $category){
        $category->delete();
        return redirect()->route('admin.categories.page')->with('success','Category Deleted Successfully.');
    }

    public function deletePackage(Package $package){
        $package->delete();
        return redirect()->route('admin.categories.page')->with('success','Package Deleted Successfully.');
    }
    public function deleteCategoryImage(CategoryImage $categoryImage){
        $categoryImage->delete();
        return redirect()->route('admin.gallery.page')->with('success','Image Deleted Successfully.');
    }
    /**
     * Turn the submitted notes[{i}][note/note_ar] rows into create-ready
     * arrays, dropping blank rows left over from the repeatable form fields.
     * A row is kept as long as the English text is filled in — the `note`
     * column is required, `note_ar` is an optional translation of it.
     */
    protected function cleanNotes(array $notes): array
    {
        return collect($notes)
            ->map(fn ($note) => [
                'note' => trim((string) ($note['note'] ?? '')),
                'note_ar' => trim((string) ($note['note_ar'] ?? '')) ?: null,
            ])
            ->filter(fn ($note) => $note['note'] !== '')
            ->values()
            ->all();
    }
    public function editPackage(Request $request, Package $package)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration_min_minutes' => ['required', 'integer', 'min:1'],
            'duration_max_minutes' => ['required', 'integer', 'min:1', 'gte:duration_min_minutes'],
            'is_active' => ['sometimes', 'boolean'],
            'features' => ['nullable', 'array'],
            'features.*.description' => ['nullable', 'string', 'max:255'],
            'features.*.description_ar' => ['nullable', 'string', 'max:255'],
            'theme_limit' => ['required', 'integer', 'min:0'],
        ]);

        $features = $this->cleanFeatures($fields['features'] ?? []);
        unset($fields['features']);

        $fields['is_active'] = $request->boolean('is_active');

        $package->update($fields);

        $package->features()->delete();
        $package->features()->createMany($features);

        return redirect()->route('admin.categories.page')->with('success', 'Package edited successfully.');
    }

    public function addPackage(Request $request, Category $category)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration_min_minutes' => ['required', 'integer', 'min:1'],
            'duration_max_minutes' => ['required', 'integer', 'min:1', 'gte:duration_min_minutes'],
            'is_active' => ['sometimes', 'boolean'],
            'features' => ['nullable', 'array'],
            'features.*.description' => ['nullable', 'string', 'max:255'],
            'features.*.description_ar' => ['nullable', 'string', 'max:255'],
            'theme_limit' => ['required', 'integer', 'min:0'],
        ]);

        $features = $this->cleanFeatures($fields['features'] ?? []);
        unset($fields['features']);

        if(isset($fields['is_active'])){
            $fields['is_active'] = true;
        } 

        $package = $category->packages()->create($fields);

        $package->features()->createMany($features);

        return redirect()->route('admin.categories.page')->with('success', 'Package added successfully.');
    }

    /**
     * Turn the submitted features[{i}][description/description_ar] rows into
     * create-ready arrays. Unlike notes, both languages are required columns
     * on `features`, so a row is only kept when both sides are filled in —
     * a row missing one side can't be saved anyway, so it's dropped silently
     * rather than blocking the whole package save over one leftover row.
     */
    protected function cleanFeatures(array $features): array
    {
        return collect($features)
            ->map(fn ($feature) => [
                'description' => trim((string) ($feature['description'] ?? '')),
                'description_ar' => trim((string) ($feature['description_ar'] ?? '')),
            ])
            ->filter(fn ($feature) => $feature['description'] !== '' && $feature['description_ar'] !== '')
            ->values()
            ->all();
    }
    public function addImage(Request $request,Category $category){
       
        $fields = $request->validate([
            
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);
        $fields['category_id']=$category->id;
        
         if (isset($fields['image'])) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/assets/images/categories'), $imageName);
            $fields['image'] = '/assets/images/categories/' . $imageName;
        }
        CategoryImage::create($fields);
        return redirect()->back()->with('success', 'Image added successfully.');
    }
    public function addTheme(Request $request){
        $fields=$request->validate([
            'name'=>['required','string','max:255'],
            'name_ar'=>['required','string','max:255'],
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id'=>['required','exists:categories,id']
        ]);
        
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/assets/images/themes'), $imageName);
            $fields['image'] = '/assets/images/themes/' . $imageName;
        
        Theme::create($fields);
        return redirect()->route('admin.themes.page')->with('success','Theme added successfully');
    }
    public function editTheme(Request $request,Theme $theme)
    {
         $fields=$request->validate([
            'name'=>['required','string','max:255'],
            'name_ar'=>['required','string','max:255'],
            'image'=>'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id'=>['required','exists:categories,id']
        ]);
         if (isset($fields['image'])) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/assets/images/themes'), $imageName);
            $fields['image'] = '/assets/images/themes/' . $imageName;
        }
        Theme::update($fields);
        return redirect()->route('admin.themes.page')->with('success','Theme edited successfully');
    }
    public function deleteTheme(Theme $theme){
        $theme->delete();
        return redirect()->route('admin.themes.page')->with('success','Theme deleted successfully');
    }
    
}