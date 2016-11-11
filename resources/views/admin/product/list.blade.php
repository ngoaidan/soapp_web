@extends('layouts.admin')
@section('body_right')
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <th>STT</th>
                <th>Tên</th>
                <th>Danh Mục</th>
                <th>Giá</th>
                <th>Ngày</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        @if($data && $data != NULL)
        @foreach($data as $index => $product)
            <tr class="odd gradeX" align="center">
                <td>{!! $index + 1 !!}</td>
                <td>{!! $product['pName'] !!}</td>
                <td>{!! $product['cName'] !!}
                <td><?php echo number_format($product['price']) ?></td>
                <td><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($product['created_at']))->diffForHumans();?></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('admin.product.getEdit', $product['id']) !!}">Edit</a></td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirm_delete('Bạn chắc chắn xóa !')" href="{!! route('admin.product.getDelete', $product['id']) !!}"> Delete</a></td>
            </tr>
        @endforeach()
        @endif
        </tbody>
    </table>
@endsection