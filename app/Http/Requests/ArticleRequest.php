<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    private $table = 'article';
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
        $checkThumb = 'bail|required|image';
        if(!empty($id)){
            $checkThumb = 'bail|image';
            $checkName  .= ",$id";//bỏ qua check tên trùng nhau id đã có
        } //id khác rỗng
        return [
            'name'                 => $checkName,
            'status'               => 'bail|in:active,inactive',
            'content'              => 'required|min:5',
            'category_id'          => 'notIn:0',
            'thumb'                => $checkThumb,
        ];
    }

    public function messages()
    {
        return [
            'name.required'            => ':attribute không được để trống',
            'content.required'         => ':attribute không được để trống',
            'name.min'                 => ':attribute phải lớn hơn :min ký tự',
            'content.min'              => ':attribute phải lớn hơn :min ký tự',
            'name.unique'              => ':attribute đã bị trùng',
            'status.in'                => ':attribute chưa được chọn',
            'category_id.not_in'       => ':attribute chưa được chọn',
            'thumb.required'           => ':attribute chưa được chọn',
        ];
    }

    public function attributes()
    {
        return [
            'name'          => 'Trường tên',
            'content'       => 'Trường nội dung',
            'status'        => 'Trường trạng thái',
            'thumb'         => 'Trường ảnh',
            'category_id'   => 'Danh mục cha',
        ];
    }
}
