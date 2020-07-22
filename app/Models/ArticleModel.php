<?php

namespace App\Models;

use App\Models\MainModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ArticleModel extends MainModel
{

    public function __construct(){
        $this->table = 'article';
        $this->currentTable = 'article';
        $this->fieldSearchAccepted = ['name', 'content'];
        $this->itemNotAccepted = ['_token', 'thumb_current'];
    }

    public function listItems($params = null, $options = null){
    	$result = null;
    	if ($options['task'] == 'admin_list_items') {
    		$query = $this->select('id','name', 'content','thumb','created','created_by','modified','modified_by','status');

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

        // if($options['task'] == 'news_list_items'){
        //     $result = self::select('id', 'name', 'thumb')
        //                 ->where('status','=','active')
        //                 ->limit(5)
        //                 ->get();
        // }

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
        //thêm mới 
        if ($options['task'] == 'add-item') {

            $params['thumb'] = $this->updateThumb($params['thumb']);
            $params = array_diff_key($params, array_flip($this->itemNotAccepted));//loại bỏ phần tử giống nhau bên $params khi so sánh với array_flip
            $result = self::insert($this->prepareParams($params));
        }
        //chỉnh sửa
        if ($options['task'] == 'edit-item') {

            if (!empty($params['thumb'])) {
                $this->deleteThumb($params['thumb_current']);
                $params['thumb'] = $this->updateThumb($params['thumb']);

            }
            $params = array_diff_key($params, array_flip($this->itemNotAccepted));//loại bỏ phần tử giống nhau 
            $result = self::where('id', $params['id'])->update($params);
            
        }
        return $result;

    }

    public function deleteItem($params = null, $options = null){
        $result = null;
        if ($options['task'] == 'delete-status') {
            $item = self::getItem($params,['task' => 'get-thumb']);
            $this->deleteThumb($item['thumb']);
            $result = self::where('id', $params['id'])->delete();
        }
        return $result;

    }

    public function getItem($params = null, $options = null){
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','name', 'content' , 'category_id','status', 'thumb')->where('id', $params['id'])->first();
        }
        if ($options['task'] == 'get-thumb') {
            $result = self::select('id','thumb')->where('id', $params['id'])->first();
        }
        return $result;
    }

}
