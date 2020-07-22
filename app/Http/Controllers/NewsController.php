<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel;
use App\Models\CategoryModel;

class NewsController extends Controller
{
    private $pathViewController = 'new.pages.home.';
    private $params = [];

    public function __construct(){
    }

    public function index(Request $request){
        $sliderModel = new SliderModel();
        $itemsListSlider = $sliderModel->listItems(null,['task' => 'news_list_items']);

        $categoryModel = new CategoryModel();
        $itemsListCategoryIndex = $categoryModel->listItems(null,['task' => 'news_list_items_category_index']);
        return view( $this->pathViewController . 'index',[
            'params'                    => $this->params,
            'itemsListSlider'           => $itemsListSlider,
            'itemsListCategoryIndex'    => $itemsListCategoryIndex,
        ]);
    }
}