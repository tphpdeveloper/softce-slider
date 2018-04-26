@extends('mage2-ecommerce::admin.layouts.app')

@section('content')

    <div class="box">
        <div class="box-header">
            <h2>
                <i class="fa fa-list-ul"></i>
                <span class="main-title-wrap">Список слайдов</span>
            </h2>
            <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <fieldset>
                    <legend>Добавить новый слайд</legend>
                    <input type="file" name="new_slide" value="Создать слайд">
                    @if($errors->has('new_slide'))
                        <div class="alert alert-danger">{{ $errors->first('new_slide') }}</div>
                    @endif
                    <br >
                    <input class="btn btn-info" type="submit" value="Отправить">
                </fieldset>
            </form>

        </div>
        <div class="box-body">
            {!! $dataGrid->render() !!}
        </div>
    </div>
@stop