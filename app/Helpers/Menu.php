<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class Menu
{

    public static function generateUserMenu($roleId) {
        $menus  = [
            [
                'title' =>  'Dashboard',
                'slug'  =>  'home',
                'icon'  =>  'home',
                'allowed_role_id' => [1,2,3,4]
            ],

            [
                'title' =>  'Master Data',
                'slug'  =>  '#',
                'icon'  =>  'database',
                'submenus' => [
                    [
                        'title' =>  'Data Harga Pasar',
                        'slug'  =>  'harga-pasar',
                        'allowed_role_id' => [1]
                    ],
                ],
                'allowed_role_id' => [1]
            ],
            [
                'title' =>  'User',
                'slug'  =>  'akun',
                'icon'  =>  'users',
                'allowed_role_id' => [1]
            ],
        ];

        return self::filterMenuByRole($menus, $roleId);
    }

    public static function filterMenuByRole($menus, $role_id)
    {
        $filtered_menus	= [];
        foreach ($menus as $menu_index => $menu) {
            $is_menu_allowed	= array_filter(
                $menu["allowed_role_id"],
                function ($value) use ($role_id) {
                    return $value == $role_id;
                }
            );

            if ( ! empty($is_menu_allowed)) {
                $filtered_menus[$menu_index] = [
                    'title' =>  $menu['title'],
                    'slug'  =>  $menu['slug'],
                    'icon'  =>  $menu['icon'],
                    'allowed_role_id' => $menu['allowed_role_id']
                ];
            }

            if (isset($menu['submenus'])) {
                foreach ($menu['submenus'] as $submenu_index => $submenu) {
                    $is_submenu_allowed	= array_filter(
                        $submenu["allowed_role_id"],
                        function ($value) use ($role_id) {
                            return $value == $role_id;
                        }
                    );

                    if ( ! empty($is_submenu_allowed)) {
                        $filtered_menus[$menu_index]['submenus'][$submenu_index] = [
                            'title' =>  $submenu['title'],
                            'slug'  =>  $submenu['slug'],
                            'allowed_role_id' => $submenu['allowed_role_id'],
                        ];
                    }
                }
            }
        }

        return $filtered_menus;
    }
}
