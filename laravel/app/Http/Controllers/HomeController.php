<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use App\Models\RecipeStep;
use App\Models\Ingredient;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function addRecipe() {
        $recipe = new Recipe();
        $recipe->name = request('name');
        $recipe->description = request('desc');
        $recipe->user_id = Auth::id();
        $recipe->active_time = 0;
        $recipe->total_time = 0;
        $recipe->save();

        // there are better ways to do this but this is easy and allows quick changes
        $steps = request('steps');
        foreach ($steps as $s) {
            $step = new RecipeStep();
            $step->instructions = $s['description'];
            $step->step_number = $s['number'];
            $step->recipe_id = $recipe->id;
            $step->save();
        }

        $ingredients = request('ingredients');
        foreach ($ingredients as $i) {
            $ingredient = new Ingredient();
            $ingredient->name = $i['name'];
            $ingredient->quantity = $i['amount'];
            $ingredient->unit = $i['unit'];
            $ingredient->notes = '';
            $ingredient->recipe_id = $recipe->id;
            $ingredient->save();
        }

        return 1;
    }

    public function getRecipe() {
        $recipe = Recipe::where('id', request('id'))->with('ingredients', 'steps', 'author', 'comments')->first()->toJson();

        return $recipe;
    }
}
