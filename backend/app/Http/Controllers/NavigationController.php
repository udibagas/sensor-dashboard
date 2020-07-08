<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function index(Request $request)
    {
        $navigation = [
            ['icon' => 'el-icon-data-analysis', 'label' => 'Dashboard', 'path' => '/', 'role' => '*'],
            ['icon' => 'el-icon-office-building', 'label' => 'Perusahaan', 'path' => '/perusahaan', 'role' => '*'],
            ['icon' => 'el-icon-location-outline', 'label' => 'Site', 'path' => '/site', 'role' => '*'],
            ['icon' => 'el-icon-place', 'label' => 'Sensor', 'path' => '/sensor', 'role' => '*'],
            ['icon' => 'el-icon-user', 'label' => 'User', 'path' => '/user', 'role' => '*'],
        ];

        return $navigation;
    }
}
