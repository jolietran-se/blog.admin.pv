<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'content' => 'required',
            // 'status' => 'required',
            'category_id' => 'required',
            'manufacture_id' => 'required',
            'manufacture_id' => 'required',
            'origin_price' => 'required',
            // 'image' => 'required|mimes:jpeg,png,jpg',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống!',
            'description.required' => 'Mô tả không được bỏ trống!',
            'content.required' => 'Nội dung không được bỏ trống!',
            // 'status.required' => 'Trạng thái không được bỏ trống!',
            'category_id.required' => 'Danh mục không được bỏ trống!',
            'manufacture_id.required' => 'Tên nhà cung cấp không được bỏ trống!',
            // 'image.required' => 'Ảnh không được bỏ trống!',
            // 'image.mimes' => 'Ảnh phải là ảnh (jpg, jpeg, png)!',
        ];
    }
}
