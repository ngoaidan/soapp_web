@extends('layouts.admin')
@section('body_right')

                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Vị Trí</th>
                                <th>Email</th>
                                <th>Số Bàn</th>
                                <th>FB</th>
                                <th>Di Động</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($shop as $index => $item)
                            <tr class="odd gradeX" align="center">
                                <td>{!! $index + 1 !!}</td>
                                <td>{!! $item['location'] !!}</td>
                                <td>{!! $item['email'] !!}</td>
                                <td>{!! $item['tel'] !!}</td>
                                <td>{!! $item['facebook'] !!}</td>
                                <td>{!! $item['phone'] !!}</td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.about.getEditShop', $item['id']) !!}">Edit</a></td>
                            </tr>
                        @endforeach()
                        </tbody>
                    </table>
@endsection