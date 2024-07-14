<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SanPhamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Phải sửa thành True
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'ma_san_pham' => 'required|unique:san_phams|max:10',
            // $this->route('san_pham') lấy giá trị ID từ route
            // khi đang cập nhật sản phẩm với ID cụ thể, quy tắc unique sẽ bỏ qua bản ghi có ID đó.
            'ma_san_pham' => 'required|max:10|unique:san_phams,ma_san_pham,' . $this->route('sanpham'),
            'ten_san_pham' => 'required|max:100',
            'gia' => 'required|numeric|min:1|max:999999',
            'so_luong' => 'required|integer|min:1',
            'ngay_nhap' => 'required|date',
            'trang_thai' => 'required|in:1,0',
        ];
    }

    // Hàm trả ra thông báo
    public function messages(): array
    {
        return [
            'ma_san_pham.required' => 'Mã sản phẩm bắt buộc điền.',
            'ma_san_pham.unique' => 'Mã sản phẩm đã tồn tại.',
            'ma_san_pham.max' => 'Mã sản phẩm không được vượt quá 10 ký tự.',
            'ten_san_pham.required' => 'Tên sản phẩm bắt buộc điền.',
            'ten_san_pham.max' => 'Tên sản phẩm không được vượt quá 100 ký tự.',
            'gia.required' => 'Giá bắt buộc điền.',
            'gia.numeric' => 'Giá phải là một số.',
            'gia.min' => 'Giá phải lớn hơn hoặc bằng 1.',
            'gia.max' => 'Giá không được vượt quá 999,999đ.',
            'so_luong.required' => 'Số lượng bắt buộc điền.',
            'so_luong.integer' => 'Số lượng phải là một số nguyên.',
            'so_luong.min' => 'Số lượng phải lớn hơn hoặc bằng 1.',
            'ngay_nhap.required' => 'Ngày nhập bắt buộc điền.',
            'ngay_nhap.date' => 'Ngày nhập phải là một ngày hợp lệ.',
            'trang_thai.required' => 'Trạng thái bắt buộc điền.',
            'trang_thai.in' => 'Nhập lại trạng thái.',
        ];
    }
}
