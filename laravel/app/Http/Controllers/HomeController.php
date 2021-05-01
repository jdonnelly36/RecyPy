<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use App\Models\RecipeStep;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;

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
//        var_dump(request('tags'));
        $recipe->save();
        foreach (explode(',', request('tags')) as $t)
            $recipe->tags()->attach(intval($t));

        // there are better ways to do this but this is easy and allows quick changes
        $steps = request('steps');
        foreach ($steps as $s) {
            var_dump($s);
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
        $recipe = Recipe::where('id', request('id'))->with('ingredients', 'steps', 'author', 'comments', 'tags')->first()->toJson();

        return $recipe;
    }

    public function searchRecipes() {
        $recipe = new Recipe();
        // ingredients string to array
        $recipe_ids = [];
        if (request('ingredients') != '') {
            $ing = explode(',', request('ingredients'));
//            var_dump($ing);
            // get all recipe ids with those ingredients
            $recipe_ids = Ingredient::whereIn('name', $ing)->pluck('recipe_id')->toArray();
        }

        // check tags
        if (request('tags') != '') {
//            var_dump(explode(',', request('tags')));
            $tags = DB::table('recipe_tag_pivot')->whereIn('tag_id', explode(',', request('tags')))->pluck('recipe_id')->toArray();
            if ($recipe_ids != null)
                $recipe_ids = array_merge($recipe_ids, $tags);
            else
                $recipe_ids = $tags;
        }

        if (request('name') != '')
            $recipe = $recipe->orWhere('name', 'like', '%'.request('name').'%');
        if (request('desc') != '')
            $recipe = $recipe->orWhere('description', 'like', '%'.request('desc').'%');

        if ($recipe_ids != [])
            $recipe = $recipe->whereIn('id', $recipe_ids);
        if ($recipe_ids == [] && (request('ingredients') != '' or request('tags') != null))
            $recipe = $recipe->orWhereIn('id', [-1]);

        $recipe = $recipe->with('ingredients', 'steps', 'author', 'comments', 'tags')->get();

        return $recipe;
    }

    public function likeRecipe() {
        $r = Recipe::find(request('id'));
        $r->likes()->attach(Auth::id());
        $r->save();

        return request('id');
    }
}
