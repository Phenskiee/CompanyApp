<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dropdown;

use App\Repositories\AppRepository;

class AppController extends Controller
{
    public function __construct(protected AppRepository $app) {}

    public function index() {
        return view('app');
    }

    public function dashboardCounts() {
        $data = $this->app->dashboard();

        return response()->json($data, 200);
    }

    // STATUS DROPDOWN
    public function getDropdownStatus() {
        $dropdownList = $this->app->dropDownStatus();

        return response()->json([
            'dropdownList' => $dropdownList,
        ], 200);
    }

    // PLATFORM DROPDOWN
    public function getDropdownPlatform() {
        $platform = $this->app->dropDownPlatform();

        return response()->json([
            'dropdownList' => $platform
        ], 200);
    }

    // SETUP DROPDOWN
    public function getDropdownSetup() {
        $setup = $this->app->dropDownSetup();

        return response()->json([
            'dropdownList' => $setup
        ], 200);
    }

    // PERSONAL INFORMATION
    public function getPersonalInfo() {
        $personal = $this->app->personalInfo();    

        return response()->json($personal, 200);  
    }
}