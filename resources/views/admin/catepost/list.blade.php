@extends('layouts.admin')
@section('body_right')

@if(Session::has('flash_message_action'))
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="alert alert-success">
        {!! Session::get('flash_message_action') !!}
    </div>
</div>
@endif
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
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirm_delete('Bạn chắc chắn xóa !')" href="{!! route('admin.catepost.getDelete', $item['id']) !!}"> Delete</a></td> 
                            </tr>
                        @endforeach()
                        </tbody>
                    </table>
@endsection