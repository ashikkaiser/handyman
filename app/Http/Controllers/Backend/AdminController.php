<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.index');
    }

    public function store(Request $request)
    {
        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->role = 'admin';
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect()->back()->with('success', 'Admin Created Successfully');
    }
}
