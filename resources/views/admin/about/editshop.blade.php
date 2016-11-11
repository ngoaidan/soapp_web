@extends('layouts.admin')
@section('body_right')
    <div class="col-lg-7" style="padding-bottom:120px">
        <form action="{!! route('admin.about.getEditShop') !!}" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="id" value="{!! $data['id'] !!}">
        <div class="form-group">
            <label>Vị Trí</label>
            <input class="form-control" name="txtLocation" placeholder="Nhập Vị Trí" value="{!! old('txtLocation', $data['location']) !!}" />
            </div>
            <div class="form-group">
                <label>Điện Thoại Bàn</label>
                <input class="form-control" name="txtTel" placeholder="Điện Thoại Bàn" value="{!! old('txtTel', $data['tel']) !!}" />
                <div style="color:red">{!! $errors->first('txtTel') !!}</div>
            </div>
            <div>
            <label>Điện Thoại Di Động</label>
            <input class="form-control" name="txtPhone" placeholder="Điện Thoại Di Động" value="{!! old('txtPhone', $data['phone']) !!}" />
            <div style="color:red">{!! $errors->first('txtPhone') !!}</div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="txtEmail" placeholder="Nhập Email" value="{!! old('txtEmail', $data['email']) !!}" />
                <div style="color:red">{!! $errors->first('txtEmail') !!}</div>
            </div>
            <div class="form-group">
                <label>Facebook</label>
                <input class="form-control" name="txtFacebook" placeholder="Nhập Facebook" value="{!! old('txtFacebook', $data['facebook']) !!}" />
                <div style="color:red">{!! $errors->first('txtFacebook') !!}</div>
            </div>
            
            <button type="submit" class="btn btn-default">Cập Nhật</button>
            <button type="reset" class="btn btn-default">Reset</button>
        <form>
    </div>
@endsection()            