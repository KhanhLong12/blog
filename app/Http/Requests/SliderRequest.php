<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    private $table = 'slider';
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
        $checkThumb = 'bail|required|image';
        $checkName  = "bail|required|min:5|unique:$this->table,name";
        if(!empty($id)){
            $checkThumb = 'bail|image';
            $checkName  .= ",$id";//bỏ qua check tên trùng nhau id đã có
        } //id khác rỗng
        return [
            'name'                 => $checkName,
            'description'          => 'bail|required',
            'link'                 => 'bail|required|url',
            'status'               => 'bail|in:active,inactive',
            'thumb'                => $checkThumb,
        ];
    }

    public function messages()
    {
        return [
            'name.required'            => ':attribute không được để trống',
            'name.min'                 => ':attribute phải lớn hơn :min ký tự',
            'name.unique'              => ':attribute đã bị trùng',
            'description.required'     => ':attribute không được để trống',
            'link.required'            => ':attribute không được để trống',
            'link.url'                 => ':attribute không hợp lệ',
            'status.in'                => ':attribute chưa được chọn',
            'thumb.required'           => ':attribute chưa được chọn',
        ];
    }

    public function attributes()
    {
        return [
            'name'          => 'Trường tên',
            'description'   => 'Trường mô tả',
            'link'          => 'Trường đường dẫn',
            'status'        => 'Trường trạng thái',
            'thumb'         => 'Trường ảnh',
        ];
    }
}
