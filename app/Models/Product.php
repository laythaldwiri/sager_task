<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductImage;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'image',
        'status',
        'created_by',
    ];

    // ===================================================================================================================
    // =========================================== Relationship Section ==================================================
    // ===================================================================================================================

    // Relation With Category Model (M2M) :
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }

    // Relation With Category Model (M2M) :
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ===================================================================================================================
    // ============================================ Accessories Section ==================================================
    // ===================================================================================================================

    // Status Field :
    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return 'Active';
        } elseif ($value == 2) {
            return 'Inactive';
        }
    }
}
