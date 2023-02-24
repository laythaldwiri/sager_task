<?php

namespace App\Http\Requests\Backend\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|integer|min:1',
            'image' => 'mimes:g3,gif,ief,jpeg,jpg,jpe,ktx,png,btif,sgi,svg,svgz,tiff,tif,webp|max:4048', // Size => 4 MB'
            'status' => 'required|integer',
            'category_ids' => 'required|array',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required',

            'description.required' => 'Description is required',

            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be decimal',
            'price.min' => 'Minimum Price must be 1',

            'quantity.required' => 'Price is required',
            'quantity.integer' => 'On Sale Price Must be integer',
            'quantity.min' => 'Minimum Quantity must be 1',

            'image.required' => 'Image Is Required',
            'image.mimes' => 'The Image must be a file of type: g3, gif, ief, jpeg, jpg, jpe, ktx, png, btif, sgi, svg, svgz, tiff, tif, webp.',
            'image.max' => 'The Image may not be greater than 4048 kilobytes.',

            'status.integer' => 'Status must be an integer',
            'status.required' => 'Status is required',

            'category_ids.required' => 'Category IDs is required',
            'category_ids.array' => 'Category IDs must be an array',
        ];
    }
}
