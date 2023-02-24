<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Product;
use App\Traits\SharedTrait;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Backend\Product\StoreImageProductFormRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Product\StoreProductRequest;
use App\Http\Requests\Backend\Product\UpdateProductRequest;
use App\Models\CartTemp;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Color;
use App\Models\ProductColor;
use App\Models\Size;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use SharedTrait, UploadImageTrait;

    // ========================================================================
    // ========================= Index Function ===============================
    // ==================== Created By Layth Al-Dwairi ========================
    // ========================================================================
    public function index(Route $route)
    {
        try {
            $products = Product::all();
            return view('admin.products.index', compact('products'));
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ========================= Create Function ==============================
    // ==================== Created By Layth Al-Dwairi ========================
    // ========================================================================
    public function create(Route $route)
    {
        try {
            $categories = Category::where('status', 1)->get();
            return view('admin.products.create', compact('categories'));
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ========================== Store Function ==============================
    // ==================== Created By Layth Al-Dwairi ========================
    // ========================================================================
    public function store(StoreProductRequest $request, Route $route)
    {
        try {
            $request_data = [
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'status' => $request->status,
                'created_by' => Auth::user()->id,
            ];

            if (isset($request->image)) {
                $orginal_image = $request->file('image');
                $upload_location = 'storage/images/products/';
                $request_data['image'] = $this->saveFile($orginal_image, $upload_location);
            }

            DB::transaction(function () use ($request_data, $request) {
                $product = Product::create($request_data);
                $product->categories()->attach($request->category_ids);
            });

            return redirect()->route('super_admin.products-index')->with('success', 'A New Product has been Added Successfully');
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ========================== Show Function ===============================
    // ==================== Created By Layth Al-Dwairi ========================
    // ========================================================================
    public function show(Route $route, $id)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                return view('admin.products.show', compact('product'));
            } else {
                return redirect()->route('super_admin.products-index')->with('error', 'Product Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ========================== Edit Function ===============================
    // ==================== Created By Layth Al-Dwairi ========================
    // ========================================================================
    public function edit($id, Route $route)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                $categories = Category::where('status', 1)->get();
                $productCategoriesArray = $productTagsArray = [];
                foreach ($product->categories as $productCategory) {
                    array_push($productCategoriesArray, $productCategory->pivot->category_id);
                }
                return view('admin.products.edit', compact('product', 'categories', 'productCategoriesArray'));
            } else {
                return redirect()->route('super_admin.products-index')->with('danger', ' The required Product Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ========================== Update Function =============================
    // ==================== Created By Layth Al-Dwairi ========================
    // ========================================================================
    public function update(UpdateProductRequest $request, $id, Route $route)
    {
        try {
            if (!isset($request->category_ids)) {
                return redirect()->back()->with('danger', 'Please select some categories');
            }

            $product = Product::find($id);
            if ($product) {
                $update_data = [
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'quantity' => $request->quantity,
                    'status' => $request->status,
                ];

                // Upload Image Section :
                if (isset($request->image)) {
                    $orginal_image = $request->file('image');
                    $upload_location = 'storage/images/products/';
                    $file_name = $this->saveFile($orginal_image, $upload_location);
                    File::delete($orginal_image . $product->image);
                    $update_data['image'] = $file_name;
                }

                DB::transaction(function () use ($update_data, $product, $request) {
                    $product->update($update_data);
                    $product->categories()->sync($request->category_ids);
                });
                return redirect()->route('super_admin.products-index')->with('success', 'The Product Has Updated Successfully');
            } else {
                return redirect()->route('super_admin.products-index')->with('danger', 'The Product Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ========================= Soft Delete Function =========================
    // ===================== Created By :Layth Al-Dwairi ======================
    // ========================================================================
    public function softDelete($id, Route $route)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                DB::transaction(function () use ($product) {
                    $product->delete();
                });

                return redirect()->route('super_admin.products-index')->with('success', 'The Deletion process has been successful');
            } else {
                return redirect()->back()->with('danger', 'This record is not in the records');
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

    // ========================================================================
    // ====================== Show Soft Delete Function =======================
    // ==================== Created By : Layth Al-Dwairi ======================
    // ========================================================================
    public function showSoftDelete(Request $request, Route $route)
    {
        try {
            $products = new Product();
            $products = $products->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.products.trashed', compact('products'));
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

    // ========================================================================
    // ==================== Soft Delete Restore Function ======================
    // ==================== Created By : Layth Al-Dwairy ======================
    // ========================================================================
    public function softDeleteRestore($id, Route $route)
    {
        try {
            $product = Product::onlyTrashed()->find($id);
            if ($product) {
                DB::transaction(function () use ($product) {
                    $product->restore();
                });
                return redirect()->route('super_admin.products-showSoftDelete')->with('success', 'Restore Completed Successfully');
            } else {
                return redirect()->back()->with('danger', 'This section does not exist in the records');
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

    // ========================================================================
    // ======================= Active/Inactive Single =========================
    // ==================== Created By : Layth Al-Dwairy ======================
    // ========================================================================
    public function activeInactiveSingle($id, Route $route)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                if ($product->status == 'Active') {
                    $product->status = 2;  // 2 => Inactive
                } elseif ($product->status == 'Inactive') {
                    $product->status = 1;  // 1 => Active
                }
                $product->save();
                return redirect()->back()->with('success', 'The process has successfully');
            } else {
                return redirect()->back()->with('danger', 'This record is not in the records');
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

    // ========================================================================
    // ========================= Delete One Quantity ==========================
    // ==================== Created By : Layth Al-Dwairy ======================
    // ========================================================================
    public function deleteOneQuantity($id, Route $route)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                if ($product->quantity >= 1) {
                    $product->quantity = $product->quantity - 1;
                } else {
                    return redirect()->back()->with('danger', 'Quantity is zero');
                }
                $product->save();
                return redirect()->back()->with('success', 'The process has successfully');
            } else {
                return redirect()->back()->with('danger', 'This record is not in the records');
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
