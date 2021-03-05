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

if (!function_exists('get_recipe_type_dropdown')) {
    // returns an array which can be easily used in a dropdown
    function get_recipe_type_dropdown() {
        $types = \App\Models\RecipeType::all();
        $arr = [];
        foreach ($types as $t)
            array_push($arr, ['name' => $t->name, 'value' => $t->id]);
        return $arr;
    }
}
