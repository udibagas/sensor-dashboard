<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function index(Request $request)
    {
        $navigation = [
            ['icon' => 'el-icon-dashboard', 'label' => 'Dashboard', 'path' => '/', 'role' => '*'],
            ['icon' => 'el-icon-building', 'label' => 'Perusahaan', 'path' => '/perusahaan', 'role' => '*'],
            ['icon' => 'el-icon-location', 'label' => 'Site', 'path' => '/site', 'role' => '*'],
            ['icon' => 'el-icon-location', 'label' => 'Sensor', 'path' => '/sensor', 'role' => '*'],
            ['icon' => 'el-icon-user', 'label' => 'User', 'path' => '/user', 'role' => '*'],
        ];

        return $navigation;
    }
}
