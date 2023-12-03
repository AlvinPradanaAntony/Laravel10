<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'name'      => 'Dashboard',
                'route'     => 'dashboard',
                'ordering'  => 1,
                'is_active' => 1,
            ],
            [
                'name'      => 'Setting',
                'route'     => '',
                'ordering'  => 1,
                'is_active' => 1,
            ],
            [
                'name'      => 'Permission',
                'route'     => 'permission.index',
                'ordering'  => 2,
                'parent'    => 2,
                'is_active' => 1,
            ],
            [
                'name'      => 'Role',
                'route'     => 'role.index',
                'ordering'  => 2,
                'parent'    => 2,
                'is_active' => 1,
            ],
            [
                'name'      => 'Menu',
                'route'     => 'menu.index',
                'ordering'  => 3,
                'parent'    => 2,
                'is_active' => 1,
            ]
        ];
  
        foreach ($links as $key => $menu) {
            Menu::create($menu);
        }
    }
}
