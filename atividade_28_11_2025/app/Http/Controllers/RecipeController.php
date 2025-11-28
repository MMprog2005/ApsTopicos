<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index(Request $request)
{
    $category = $request->query('category');
    if($category){
        $recipes = Recipe::where('category', $category)->latest()->paginate(10);
        // gravar cookie com ultima categoria (30 dias)
        cookie()->queue('last_category', $category, 60*24*30);
    } else {
        $recipes = Recipe::latest()->paginate(10);
    }
    return view('recipes.index', compact('recipes','category'));
}

public function create()
{
    return view('recipes.create');
}

public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'ingredients' => 'required|string',
        'instructions' => 'required|string',
        'category' => 'nullable|string|max:100',
        'prep_time' => 'nullable|integer|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048' // <=2MB
    ]);

    if($request->hasFile('image')){
        $file = $request->file('image');
        $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
        $path = $file->storeAs('public/recipes', $filename);
        $data['image_path'] = 'recipes/'.$filename; // path relativo em storage/app/public
    }

    // opcional: associar user_id se logado
    if(auth()->check()) $data['user_id'] = auth()->user()->id;

    Recipe::create($data);
    return redirect()->route('recipes.index')->with('success','Receita criada com sucesso!');
}

public function show(Recipe $recipe)
{
    return view('recipes.show', compact('recipe'));
}

public function edit(Recipe $recipe)
{
    return view('recipes.edit', compact('recipe'));
}

public function update(Request $request, Recipe $recipe)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'ingredients' => 'required|string',
        'instructions' => 'required|string',
        'category' => 'nullable|string|max:100',
        'prep_time' => 'nullable|integer|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    if($request->hasFile('image')){
        // remover antiga se existir
        if($recipe->image_path){
            Storage::delete('public/'.$recipe->image_path);
        }
        $file = $request->file('image');
        $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
        $path = $file->storeAs('public/recipes', $filename);
        $data['image_path'] = 'recipes/'.$filename;
    }

    $recipe->update($data);
    return redirect()->route('recipes.index')->with('success','Receita atualizada com sucesso!');
}

public function destroy(Recipe $recipe)
{
    if($recipe->image_path){
        Storage::delete('public/'.$recipe->image_path);
    }
    $recipe->delete();
    return redirect()->route('recipes.index')->with('success','Receita excluída com sucesso!');
}
}
