<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        $staff = Staff::where('is_active', true)->get();

        return view('landing.organization', compact('staff'));
    }

    public function show(Staff $staff)
    {
        return view('landing.staff-detail', compact('staff'));
    }
}