<?php

namespace Softce\Slider\Http\Controllers;

use Mage2\Ecommerce\Http\Controllers\Admin\AdminController;
use Softce\Slider\Http\Requests\SlideRequest;
use Softce\Slider\Module\Slider;
use \Mage2\Ecommerce\DataGrid\Facade as DataGrid;
use File;

class SliderController extends AdminController
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
                    <img  style="width: 100%;" src="'.asset('uploads/slider/'.$model->path).'" alt="" >
                    <input form="admin-slider-update-'.$model->id.'" type="file" name="slide" >
                ';
            })
            ->linkColumn('text', ['label' => 'Текст'], function ($model) {
                return '
                    <textarea  form="admin-slider-update-'.$model->id.'" style="width: 100%;" class="ckeditor" name="text">'.$model->text.'</textarea>
                ';
            })
            ->linkColumn('', [], function ($model) {
                return "
                
                <form id='admin-slider-update-" . $model->id . "' class='inline-form' method='POST'
                    action='" . route('admin.slider.update', [$model->id]) . "'
                    enctype='multipart/form-data'
                    >                    
                    " . csrf_field() . "
                    " . method_field('PUT') . "
                    
                    
                    <input type='submit' class='btn btn-info' value='Изменить'>
                </form>
                
                
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
            $new_slide->move(public_path('uploads/slider'), $name_file);
            Slider::create([
                'path' => $name_file
            ]);

            return redirect()->route('admin.slider.index')->with('notificationText', 'Слайд успешно добавлен');
        }

        return redirect()->route('admin.slider.index')->with('errorText', 'Для создания слайда нужно изображение');
    }


    public function update(SlideRequest $request, $id)
    {
        //TODO create multiple text or not?
        $slide = Slider::find($id);
        if($slide){
            $new_slide = $request->file('slide');
            $slide->text = $request->text;
            if($new_slide){
                File::delete(public_path('uploads/slider/'.$slide->path));

                $name_file = time() . '.' . $new_slide->getClientOriginalExtension();
                $new_slide->move(public_path('uploads/slider'), $name_file);
                $slide->path = $name_file;
            }
            $slide->save();

            return redirect()->route('admin.slider.index')->with('notificationText', 'Слайд успешно обновлен');
        }
        return redirect()->route('admin.slider.index')->with('errorText', 'Ошибка обновления слайда. Повторите запрос позже!!!');
    }

    public function destroy($id_slide)
    {
        $slide = Slider::find($id_slide);
        if($slide){
            File::delete(public_path('uploads/slider/'.$slide->path));
            $slide->destroy();
            return redirect()->route('admin.slider.index')->with('notificationText', 'Слайд успешно удален');
        }
        return redirect()->route('admin.slider.index')->with('errorText', 'Ошибка удаления слайда. Повторите запрос позже!!!');
    }

}