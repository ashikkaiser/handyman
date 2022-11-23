<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    //

    public function index()
    {
        $packages = Package::all();
        return view('backend.packages.index', compact('packages'));
    }

    public function modifyPackage(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'limited_business_pages' => 'required',
            'images_limit' => 'required',
            'map' => 'required',
            'credit' => 'required',
            'stripe_plan_id' => 'required',
            'is_active' => 'required',
        ]);

        $package = Package::findOrNew($request->id);
        $package->name = $request->name;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->duration = $request->duration;
        $package->limited_business_pages = $request->limited_business_pages;
        $package->images_limit = $request->images_limit;
        $package->map = $request->map;
        $package->credit = $request->credit;
        $package->stripe_plan_id = $request->stripe_plan_id;
        $package->is_active = $request->is_active;
        $package->save();

        if ($package->id) {
            return redirect()->route('admin.package.index')->with('success', 'Package updated successfully');
        } else {
            return redirect()->back()->with('success', 'Package has been Created successfully');
        }
    }
}
