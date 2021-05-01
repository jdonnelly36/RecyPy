<?php
///
/// THIS FILE CONTAINS USEFUL FUNCTIONS THAT MAY POP UP ON MANY PAGES
/// Add to this as needed following this form
/// They can be called from any php on any page
///
if (! function_exists('example')) {
    function example() {
        // do something
    }
}

if (! function_exists('get_all_recipes')) {
    function get_all_recipes() {
        return \App\Models\Recipe::with('author', 'tags', 'ingredients', 'likes')->get();
    }
}

if (! function_exists('get_all_liked_recipes')) {
    function get_all_liked_recipes() {
        return DB::table('likes')->where('user_id', Auth::id())->pluck('recipe_id')->toArray();
    }
}

if (!function_exists('get_recipe_tag_dropdown')) {
    // returns an array which can be easily used in a dropdown
    function get_recipe_tag_dropdown() {
        $types = \App\Models\RecipeTag::all();
        $arr = [];
        foreach ($types as $t)
            array_push($arr, ['name' => $t->name, 'value' => $t->id]);
        return $arr;
    }
}

if (!function_exists('get_all_recipes_dropdown')) {
    // gets all recipes with just name and ids as array
    function get_all_recipes_dropdown() {
        $recipes = \App\Models\Recipe::all();
        $arr = [];
        foreach ($recipes as $r)
            array_push($arr, ['name' => $r->name, 'value' => $r->id]);
        return $arr;
    }
}
