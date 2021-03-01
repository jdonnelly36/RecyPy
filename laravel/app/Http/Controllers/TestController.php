<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recipe;
use App\Models\RecipeType;

class TestController extends Controller {
    public function getUsers() {
        return User::with('favorites', 'recipes')->get();
    }

    public function getRecipes() {
        return Recipe::with('type', 'creator')->get();
    }

    public function getFavorites() {
        $user = User::find(1)->get();
        return $user->favorites();
    }

    public function getTypes() {
        return RecipeType::all();
    }
}
