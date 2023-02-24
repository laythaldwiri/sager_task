<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Customer;
use App\Traits\SharedTrait;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\FrontEnd\customerSignupRequestFormRequest;
use App\Http\Requests\FrontEnd\Customer\CustomerLoginFormRequest;

class FrontEndController extends Controller
{
    use SharedTrait, UploadImageTrait;

    // ===============================================================
    // ====================== Welcome Function =======================
    // ================= Created by: Layth Al-Dwairi =================
    // ===============================================================
    public function welcome(Route $route)
    {
        try {
            return view('welcome');
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
            $check_old_errors = new SupportTicket();
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' =>  $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ================================================================
    // ============= Customert Login Request Function =================
    // =============== Created By : Layth Al-Dwairi ===================
    // ================================================================
    public function customertLoginRequest(CustomerLoginFormRequest $request, Route $route)
    {
        try {
            // Check If User Auth :
            // ==========================================
            if (Auth::guard('customer')->check()) {
                $output = '<div style="text-align:center; margin-top:250px;">';
                $output .= '<h1> Sager Laravel Task - Customer Dashboard</h1>';
                $output .= '<h3>Test Message : <span style="color:red;">You are already logged in as a customer .. redirect to customer dashboard in real project</span></h3>';
                $output .= '<h1><a href="' . route('welcome') . '">Login As Super Admin</a></h1>';
                $output .= '</div>';
                return $output;
            }

            // Attempt to log the user in
            if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $output = '<div style="text-align:center; margin-top:250px;">';
                $output .= '<h1> Sager Laravel Task - Customer Dashboard</h1>';
                $output .= '<h3>Test Message : <span style="color:green;">Customer logged in successfully .. redirect to customer dashboard in real project</span></h3>';
                $output .= '<h1><a href="' . route('welcome') . '">Login As Super Admin</a></h1>';
                $output .= '</div>';
                return $output;
            }

            // if unsuccessful
            $errors = [
                'username' => 'username or password is incorrect',
            ];
            return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors($errors);
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
            $check_old_errors = new SupportTicket();
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' =>  $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ================================================================
    // ====================== SignUp : Customer =======================
    // ================= Created by: Layth Al-Dwairi ==================
    // ================================================================
    public function customerSignupRequest(customerSignupRequestFormRequest $request, Route $route)
    {
        try {
            // Check If User Auth :
            // ==========================================
            if (Auth::guard('customer')->check()) {
                $output = '<div style="text-align:center; margin-top:250px;">';
                $output .= '<h1> Sager Laravel Task - Customer Dashboard</h1>';
                $output .= '<h3>Test Message : <span style="color:red;">You are already logged in as a customer .. redirect to customer dashboard in real project</span></h3>';
                $output .= '<h1><a href="' . route('welcome') . '">Login As Super Admin</a></h1>';
                $output .= '</div>';
                return $output;
            }

            $request_data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 1, // 1 => Active
            ];

            DB::transaction(function () use ($request_data) {
                Customer::create($request_data);
            });

            // Attempt to log the user in
            if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $output = '<div style="text-align:center; margin-top:250px;">';
                $output .= '<h1> Sager Laravel Task - Customer Dashboard</h1>';
                $output .= '<h3>Test Message : <span style="color:green;">Customer register successfully .. redirect to customer dashboard in real project</span></h3>';
                $output .= '<h1><a href="' . route('welcome') . '">Login As Super Admin</a></h1>';
                $output .= '</div>';
                return $output;
            } else {
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
            $check_old_errors = new SupportTicket();
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' =>  $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }
}
