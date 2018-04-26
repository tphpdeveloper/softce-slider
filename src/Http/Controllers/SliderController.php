<?php

namespace Softce\Slider\Http\Controllers;

use Illuminate\Routing\Controller;
use Softce\Slider\Http\Requests\SlideRequest;
use Softce\Slider\Module\Slider;
use \Mage2\Ecommerce\DataGrid\Facade as DataGrid;
use File;

class SliderController extends Controller
{

    public function __construct()
    {
        //$this->middleware(['admin', 'auth', 'main_lang']);
    }

    public function index()
    {
        $dataGrid = DataGrid::model(Slider::query())
            ->column('id',['sortable' => true])
            ->linkColumn('path', ['label' => 'Изображение'], function ($model) {
                return '
                    <img style="width: 100px;" src="'.asset('uploads/slider/'.$model->path).'" alt="" >
                    <input type="file" name="slide['.$model->id.']" >
                ';
            })
            ->linkColumn('text', ['label' => 'Текст'], function ($model) {
                return '
                    <textarea class="ckeditor" name="text">'.$model->text.'</textarea>
                ';
            })
            ->linkColumn('', [], function ($model) {
                return "
                
                <form id='admin-slider-destroy-" . $model->id . "' class='inline-form'
                    method='POST'
                    action='" . route('admin.slider.destroy', $model->id) . "'>                    
                    <input name='_method' type='hidden' value='DELETE' />
                    " . csrf_field() . "
                    
                    <a href='#' data-destroy=\"jQuery('#admin-slider-destroy-$model->id').submit()\"  class='btn btn-danger js-delete' >
                        <i class ='fa fa-trash'></i>
                    </a>
                </form>
            ";
            });

        return view('slider::admin-slide')
            ->with('dataGrid', $dataGrid);
    }

    public function store(SlideRequest $request)
    {
        $new_slide = $request->file('new_slide');
        if($new_slide) {
            $name_file = time() . '.' . $new_slide->getClientOriginalExtension();
            $new_slide->move(public_path('uploads/slider', $name_file));
            Slider::create([
                'path' => $name_file
            ]);

            return redirect()->route('admin.slider')->with('notificationText', 'Слайд успешно добавлен');
        }

        return redirect()->route('admin.slider')->with('errorText', 'Для создания слайда нужно изображение');
    }

    public function destroy($id_slide)
    {
        $slide = Slider::find($id_slide);
        if($slide){
            File::remove(public_path('uploads/slider/'.$slide->path));
            $slide->destroy();
        }

    }

}