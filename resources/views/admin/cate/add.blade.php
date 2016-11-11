@extends('layouts.admin')
@section('body_right')
@if(count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li>{!! $error !!}</li>
        @endforeach
    </ul>
</div>
@endif
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{!! route('admin.cate.getAdd') !!}" method="POST">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <div class="form-group">
                                <label>Chọn Danh Mục Cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Vui Lòng Chọn</option>
                                    <?php cate_parent($parent); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên Danh Mục</label>
                                <input class="form-control" name="txtCateName" placeholder="Tên Danh Mục" value="{!! old('txtCateName') !!}" />
                                <div>{!! $errors->first('txtCateName') !!}</div>
                            </div>
                            <div class="form-group">
                                <label>Vị Trí</label>
                                <input class="form-control" name="txtOrder" placeholder="Vị Trí" value="{!! old('txtOrder') !!}" />
                            </div>
                            <div class="form-group">
                                <label>Keywords</label>
                                <input class="form-control" name="txtKeywords" placeholder="Keywords" value="{!! old('txtKeywords') !!}" />
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name="txtDescription">{!! old('txtDescription') !!}</textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Category Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
@endsection()