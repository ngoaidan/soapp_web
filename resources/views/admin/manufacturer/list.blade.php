@extends('layouts.admin')
@section('body_right')

@if(Session::has('flash_message_action'))
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="alert alert-success">
        {!! Session::get('flash_message_action') !!}
    </div>
</div>
@endif

<div class="row">
<div class="col-xs-6 col-sm-6 col-md-12 col-lg-12 col-md-offset-4">
    <form action="{!! route('admin.manufacturer.getAdd') !!}" method="POST" class="form-inline" role="form">
    <input type="hidden" name="_token" id="token_tags" class="form-control" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label class="sr-only" for="tags">Nhà Sản Xuất</label>
            <input type="text" class="form-control" id="tags" name="manufacturer" placeholder="Nhập Nhà Sản Xuất" value="{!! old('manufacturer') !!}">
            <div style="color:red">{!! $errors->first('manufacturer') !!}</div>
        </div>  
        <button type="submit" class="btn btn-primary">Thêm Mới</button>
    </form>
</div>
</div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example-tags">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $index => $item)
                            <tr class="odd gradeX" align="center">
                                <td>{!! $index + 1 !!}</td>
                                <td>{!! $item['name'] !!}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirm_delete('Bạn chắc chắn xóa !')" href="{!! route('admin.manufacturer.getDelete', $item['id']) !!}"> Delete</a></td> 
                            </tr>
                        @endforeach()
                        </tbody>
                    </table>
@endsection