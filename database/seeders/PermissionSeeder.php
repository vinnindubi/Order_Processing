<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        $permissions=['create-customer','update-customer','delete-customer','view-customers','create-order','update-order','delete-order','view-order','view-products','edit-products','delete-products','update-products'];
            foreach($permissions as $permission){
                Permission::create([
                    "name"=>$permission
                ]);
            }
    }
}
