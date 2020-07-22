<?php

namespace App\Models;

use App\Models\MainModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class CategoryModel extends MainModel
{

    public function __construct(){
        $this->table = 'category';
        $this->currentTable = 'category';
        $this->fieldSearchAccepted = ['id', 'name'];
        $this->itemNotAccepted = ['_token'];
    }

    public function listItems($params = null, $options = null){
    	$result = null;
    	if ($options['task'] == 'admin_list_items') {
    		$query = $this->select('id','name', 'is_home', 'display', 'created','created_by','modified','modified_by','status');

            if ($params['filter']['status'] != 'all'){
                $query->where('status', '=', $params['filter']['status']);
            }

            if ($params['search']['value'] !== ''){
                if ($params['search']['field'] == 'all') {
                    $query->where(function ($query) use ($params) 
                        {
                            foreach ($this->fieldSearchAccepted as $column)
                            {
                                $query->orWhere($column, 'LIKE', "%{$params['search']['value']}%");
                            }
                        });
                }elseif (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
            }

             $result = $query->paginate($params['pagination']['totalItemsPerPage']);
    	}
        if ($options['task'] == 'news_list_Category') {
            $result = self::select('id','name')->where('status','=','active')->limit(6)->get();
        }

        if ($options['task'] == 'news_list_items_category_index') {
            $result = self::select('id','name','display')
                        ->where('status','=','active')
                        ->where('is_home', '=', '1')
                        ->get();
        }

        if ($options['task'] == 'get-itemCategories') {
            $result = self::select('id','name')
                        ->orderby('name','asc')
                        ->where('status','=','active')
                        ->pluck('name','id')//pluck dùng để trả về giá trị 'key' => 'value'
                        ->toArray();
        }

    	return $result;
    }

    public function countItems($params = null, $options = null){
        $result = null;

        if ($options['task'] == 'admin_count_items_group_by_status') {

            $query = $this::groupby('status')
                            ->select(DB::raw('count(id) as count, status'));

            if ($params['search']['value'] !== ''){
                if ($params['search']['field'] == 'all') {
                    $query->where(function ($query) use ($params) 
                        {
                            foreach ($this->fieldSearchAccepted as $column)
                            {
                                $query->orWhere($column, 'LIKE', "%{$params['search']['value']}%");
                            }
                        });
                }elseif (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
            }

            $result = $query->get()->toArray();
        }

        return $result;
    }

    public function saveItem($params = null, $options = null){
        $result = null;
        //thay đổi trạng thái
        if ($options['task'] == 'change-status') {
            $status = ($params['currenStatus'] == 'active')? 'inactive': 'active';
            $result = self::where('id', $params['id'])
                          ->update(['status' => $status]);
        }
        //thay đổi isHome
        if ($options['task'] == 'change-isHome') {
            $isHome = ($params['currenIsHome'] == '0')? '1': '0';

            // dd($params['currenIsHome']);
            $result = self::where('id', $params['id'])
                          ->update(['is_home' => $isHome]);
        }

        //thay đổi hiển thị(display)
        if ($options['task'] == 'change-display') {
            $displayCurrent = $params['currenDisplay'];

            $result = self::where('id', $params['id'])
                          ->update(['display' => $displayCurrent]);
        }

        //thêm mới 
        if ($options['task'] == 'add-item') {
            $params = array_diff_key($params, array_flip($this->itemNotAccepted));//loại bỏ phần tử giống nhau bên $params khi so sánh với array_flip
            $result = self::insert($this->prepareParams($params));
        }
        //chỉnh sửa
        if ($options['task'] == 'edit-item') {
            $params = array_diff_key($params, array_flip($this->itemNotAccepted));//loại bỏ phần tử giống nhau 
            $result = self::where('id', $params['id'])->update($params);
            
        }
        return $result;

    }

    public function deleteItem($params = null, $options = null){
        $result = null;
        if ($options['task'] == 'delete-status') {
            $result = self::where('id', $params['id'])->delete();
        }
        return $result;

    }

    public function getItem($params = null, $options = null){
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','name','status')->where('id', $params['id'])->first();
        }
        return $result;
    }

}
