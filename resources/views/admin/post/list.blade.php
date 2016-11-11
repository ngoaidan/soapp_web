@extends('layouts.admin')

@section('body_right')
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <th style="width: 8%">Ảnh</th>
                <th>Tiêu Đề</th>
                <th>Danh Mục</th>
                <th>Lượt Xem</th>
                <th>Edit</th>
                <th>Delete</th>   
            </tr>
        </thead>
        <tbody>
        @if(isset($data) && $data != NULL)
        @foreach($data as $index => $item)
            <tr class="odd gradeX" align="center">
                <td><img src="{!! $item['image_thumbnail'] !!}" class="img-responsive"></td>
                <td>{!! $item['title'] !!}</td>
                <td>{!! $item['cName'] !!}</td>
                <td>{!! $item['views'] !!}</td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.post.getEdit', $item['id']) !!}">Edit</a></td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirm_delete('Bạn chắc chắn xóa !')" href="{!! URL::route('admin.post.getDelete', $item['id']) !!}"> Delete</a></td>
            </tr>
        @endforeach()
        @endif
        </tbody>
    </table>
@endsection