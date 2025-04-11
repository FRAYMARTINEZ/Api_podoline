<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentsController extends Controller
{
    public function index()
    {
        $department = Department::all();
        return response()->json([
            'success' => true,
            'data' => $department
        ]);
    }
}