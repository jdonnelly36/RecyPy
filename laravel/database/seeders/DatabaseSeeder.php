<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\RecipeTag;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();

        // create some fake recipes
//        $r = new Recipe();
//        $r->name = 'Test recipe 1';
//        $r->created_at = date('Y-m-d');
//        $r->type_id = 1;
//        $r->creator_id = 1;
//        $r->save();
//
//        $r = new Recipe();
//        $r->name = 'Test recipe 2';
//        $r->created_at = date('Y-m-d');
//        $r->type_id = 1;
//        $r->creator_id = 1;
//        $r->save();
//
//        $r = new Recipe();
//        $r->name = 'Test recipe 2';
//        $r->created_at = date('Y-m-d');
//        $r->type_id = 2;
//        $r->creator_id = 1;
//        $r->save();
//
        $t = new RecipeTag();
        $t->name = 'Unhealthy';
        $t->save();

        $t = new RecipeTag();
        $t->name = 'Healthy';
        $t->save();

        $u = new User();
        $u->name = 'Spencer Campbell';
        $u->email = 'f@f';
        $u->password = '$2y$10$3FjPiDaeYMVW/J008GVBI.rBQN3hx2nn6SMdr.BFsl2qMmm0lwL8G';
        $u->save();
    }
}
