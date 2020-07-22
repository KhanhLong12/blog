<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleModel as MainModels;
use App\Models\CategoryModel;
use App\Http\Requests\ArticleRequest as MainRequests;

class ArticleController extends Controller
{
    private $pathViewController = 'admin.pages.article.';
    private $model;
    private $controllerName = 'article';
    private $params = [];

    public function __construct(){
        $this->params['pagination']['totalItemsPerPage'] = 5;//tạo mảng chứa pagination và trong đó có totalItemsPerPage =1
        $this->model = new MainModels();//khởi tạo đối tượng SliderModel (ở bên phần model)
        view()->share('controllerName' , $this->controllerName);
    }

    public function index(Request $request){
        $this->params['filter']['status'] = $request->input('filter_status', 'all');//cho vào mảng ['filte']['status'], $request->input('filter_status', 'all') lấy dữ liệu của filter_status từ bên route
        $this->params['search']['field'] = $request->input('search_field', 'all');
        $this->params['search']['value'] = $request->input('search_value', '');
        $items = $this->model->listItems($this->params,['task' => 'admin_list_items']);

        $itemsCountStatus = $this->model->countItems($this->params,['task' => 'admin_count_items_group_by_status']);

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
        $categoryModel = new CategoryModel();
        $itemCategories = $categoryModel->listItems(null,['task' => 'get-itemCategories']);
        array_splice($itemCategories, 0, 0, 'Category');

        return view( $this->pathViewController . 'form',[
                'item' => $item,
                'itemCategories' => $itemCategories
        ]);

    }

    public function save(MainRequests $request){
        // dd($request);
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