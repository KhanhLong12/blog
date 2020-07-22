<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    private $table = 'category';
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
        $id = $this->id;
        $checkName  = "bail|required|min:5|unique:$this->table,name";
        if(!empty($id)){
            $checkName  .= ",$id";//bỏ qua check tên trùng nhau id đã có
        } //id khác rỗng
        return [
            'name'                 => $checkName,
            'status'               => 'bail|in:active,inactive',
        ];
    }

    public function messages()
    {
        return [
            'name.required'            => ':attribute không được để trống',
            'name.min'                 => ':attribute phải lớn hơn :min ký tự',
            'name.unique'              => ':attribute đã bị trùng',
            'status.in'                => ':attribute chưa được chọn',
        ];
    }

    public function attributes()
    {
        return [
            'name'          => 'Trường tên',
            'status'        => 'Trường trạng thái',
        ];
    }
}
