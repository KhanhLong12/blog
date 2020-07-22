<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel as MainModels;
use App\Http\Requests\CategoryRequest as MainRequests;

class CategoryController extends Controller
{
    private $pathViewController = 'admin.pages.category.';
    private $model;
    private $controllerName = 'category';
    private $params = [];

    public function __construct(){
        $this->params['pagination']['totalItemsPerPage'] = 5;//tạo mảng chứa pagination và trong đó có totalItemsPerPage =1
        $this->model = new MainModels();//khởi tạo đối tượng CategoryModel (ở bên phần model)
        view()->share('controllerName' , $this->controllerName);
    }

    public function index(Request $request){
        $this->params['filter']['status'] = $request->input('filter_status', 'all');//cho vào mảng ['filte']['status'], $request->input('filter_status', 'all') lấy dữ liệu của filter_status từ bên route
        $this->params['search']['field'] = $request->input('search_field', 'all');
        $this->params['search']['value'] = $request->input('search_value', '');
        $items = $this->model->listItems($this->params,['task' => 'admin_list_items']);

        $itemsCountStatus = $this->model->countItems($this->params,['task' => 'admin_count_items_group_by_status']);// [[ 'status', 'count' ]]     
        return view( $this->pathViewController . 'index',[
            'params'            => $this->params,
            'items'             => $items,
            'itemsCountStatus'  => $itemsCountStatus
        ]);
    }

    public function edit(Request $request){

        return view( $this->pathViewController . 'form', [
            'id' => $id
        ]);
    }

    public function status(Request $request){
        $params['currenStatus'] = $request->status;
        $params['id'] = $request->id;
        $this->model->saveItem($params,['task' => 'change-status']);
        return redirect()->route($this->controllerName)->with('status','Thay đổi trạng thái của id '. $params['id'] .' thành công');
    }

    public function isHome(Request $request){
        $params['currenIsHome'] = $request->isHome;
        $params['id'] = $request->id;
        $this->model->saveItem($params,['task' => 'change-isHome']);
        return redirect()->route($this->controllerName)->with('status','Thay đổi trạng thái hiển thị của id '. $params['id'] .' thành công');
    }

    public function changeDisplay(Request $request){
        $params['currenDisplay'] = $request->display;
        $params['id'] = $request->id;
        $this->model->saveItem($params,['task' => 'change-display']);
        return redirect()->route($this->controllerName)->with('status','Thay đổi hiển thị của id '. $params['id'] .' thành công');
    }

    public function delete(Request $request){
        $params['id'] = $request->id;
        $this->model->deleteItem($params,['task' => 'delete-status']);
        return redirect()->route($this->controllerName)->with('status','xóa id '. $params['id'] .' thành công');
    }

    public function form(Request $request){
        $item = null;
        if ($request->id != null) {
            $params['id'] = $request->id;
            $item = $this->model->getItem($params,['task' => 'get-item']);
        }
        
        return view( $this->pathViewController . 'form',[
                'item' => $item
        ]);
    }

    public function save(MainRequests $request){
        if ($request->isMethod('POST')) {
            $params = $request->all();
            $task   = 'add-item';
            $notify = 'thêm bản ghi thành công';
            if ($params['id'] != null) {
                $task   = 'edit-item';
                $notify = 'Thay đổi bản ghi thành công';
            }

        $this->model->saveItem($params,['task' => $task]);
        return redirect()->route($this->controllerName)->with('status',$notify);

        }
    }
}