@extends('layouts.admin')
@section('body_right')

                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Danh Mục Cha</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $index => $item)
                            <tr class="odd gradeX" align="center">
                                <td>{!! $index + 1 !!}</td>
                                <td>{!! $item['name'] !!}</td>
                                <td>
                                    @if($item['parent_id'] == 0)    
                                    {!! "None" !!}
                                    @else
                                    <?php
                                        $parent = DB::table('cates')->where('id', $item['parent_id'])->first();
                                        if(isset($parent->name)) echo $parent->name;
                                    ?>
                                    @endif
                                </td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirm_delete('Bạn chắc chắn xóa !')" href="{!! URL::route('admin.cate.getDelete', $item['id']) !!}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.cate.getEdit', $item['id']) !!}">Edit</a></td>
                            </tr>
                        @endforeach()
                        </tbody>
                    </table>
@endsection