@extends('layouts.admin')
@section('body_right')

                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tiêu Đề</th>
                                <th>Keywords</th>
                                <th>Description</th>
                                <th>Icon</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $index => $item)
                            <tr class="odd gradeX" align="center">
                                <td>{!! $index + 1 !!}</td>
                                <td>{!! $item['title'] !!}</td>
                                <td>{!! $item['meta_key'] !!}</td>
                                <td>{!! $item['meta_desc'] !!}</td>
                                <td><img src="{!! $item['image_thumb'] !!}"></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.about.getEdit', $item['id']) !!}">Edit</a></td>
                            </tr>
                        @endforeach()
                        </tbody>
                    </table>
@endsection