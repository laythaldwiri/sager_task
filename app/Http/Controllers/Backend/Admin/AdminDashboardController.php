<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        // Admin Dashboard: Products Count
        $public_all_products = Product::orderBy('created_at', 'desc')->get();
        $public_active_products = Product::where('status', 1)->orderBy('created_at', 'desc')->get(); // 1 => Active
        $public_inactive_products = Product::where('status', 2)->orderBy('created_at', 'desc')->get(); // 2 => Inctive

        // Admin Dashboard: Categories Count
        $public_all_categories = Category::orderBy('created_at', 'desc')->get();
        $public_active_categories  = Category::where('status', 1)->orderBy('created_at', 'desc')->get(); // 1 => Active
        $public_inactive_categories  = Category::where('status', 2)->orderBy('created_at', 'desc')->get(); // 2 => Inctive

        // Admin Dashboard: Customers Count
        $public_all_customers = Customer::orderBy('created_at', 'desc')->get();
        $public_active_customers  = Customer::where('status', 1)->orderBy('created_at', 'desc')->get(); // 1 => Active
        $public_inactive_customers  = Customer::where('status', 2)->orderBy('created_at', 'desc')->get(); // 2 => Inctive

        return view('admin.index', compact(
            'public_all_products',
            'public_active_products',
            'public_inactive_products',

            'public_all_categories',
            'public_active_categories',
            'public_inactive_categories',

            'public_all_customers',
            'public_active_customers',
            'public_inactive_customers',
        ));
    }
}
