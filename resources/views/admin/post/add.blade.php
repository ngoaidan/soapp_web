@extends('layouts.admin')
@section('body_right')

    <div class="col-lg-7" style="padding-bottom:120px">
        <form action="{!! route('admin.post.getAdd') !!}" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="form-group">
                <label>Tiêu đề</label>
                <input class="form-control" name="txtTitle" placeholder="Vui lòng nhập tiêu đề" value="{!! old('txtTitle') !!}" />
                <div style="color:red">{!! $errors->first('txtTitle') !!}</div>
            </div>
            <div class="form-group">
                <label>Danh Mục Bài Viết</label>
                <select class="form-control" name="cate_id">
                    <option value="0">Vui Lòng Chọn</option>
                    @foreach($parent as $catePost)
                    <option value="{!! $catePost['id'] !!}" @if(old('cate_id') == $catePost['id']) selected  @endif>{!! $catePost['name'] !!}</option>
                    @endforeach
                </select>
                <div style="color:red">{!! $errors->first('cate_id') !!}</div>
             </div>
            <div class="form-group">
                <label>Ảnh hiển thị</label>
                <div class="col-xs-12 thumbnail">
                    <img src="{!! old('image_link') !!}" id="image_link">
                    <hr>
                <input class="form-control" name="txtAltImage" placeholder="Chú thích ảnh" value="{!! old('txtAltImage') !!}"  />
                </div>
                <input type="hidden" name="image_link" id="link_avatar" value="{!! old('image_link') !!}" >
                <button type="button" class="btn btn-large btn-block btn-default" onclick="BrowseServer();">Chọn Ảnh</button>
                <div style="color:red">{!! $errors->first('image_link') !!}</div>
            </div>
            <div class="form-group">
                <label for="product_select">Chọn thẻ</label><br>
                <select multiple id="product_select" style="width:100%" name="tags[]">
                @foreach($listTags as $key => $tag)
                    <option value="{!! $key !!}" @if(old('tags') == $key) selected='selected'   @endif >{!! $tag !!}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Giới thiệu</label>
                <textarea class="form-control" rows="3" name="txtIntro">{!! old('txtIntro') !!}</textarea>
                <div style="color:red">{!! $errors->first('txtIntro') !!}</div>
            </div>
            <div class="form-group">
                <label>Keywords</label>
                <input class="form-control" name="txtKeyword" placeholder="Vui lòng nhập Keywords" value="{!! old('txtKeyword') !!}" />
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="3" name="txtDescription">{!! old('txtDescription') !!}</textarea>
            </div>
            <div class="form-group">
                <label>Nội Dung</label>
                <textarea class="form-control" rows="3" name="txtContent">{!! old('txtContent') !!}</textarea>
                <script type="text/javascript">ckeditor('txtContent')</script>
            </div>
            <button type="submit" class="btn btn-default">Add</button>
            <button type="reset" class="btn btn-default">Reset</button>
        <form>
    </div>
<script type="text/javascript">
    function BrowseServer()
    {
        // You can use the "CKFinder" class to render CKFinder in a page:
        var finder = new CKFinder();
        finder.basePath = '../';    // The path for the installation of CKFinder (default = "/ckfinder/").
        finder.selectActionFunction = SetFileField;
        finder.popup();
    }
    // This is a sample function which is called when a file is selected in CKFinder.
    function SetFileField( fileUrl )
    {
      document.getElementById( 'link_avatar' ).value = fileUrl;
      document.getElementById( 'image_link' ).src = document.getElementById( 'link_avatar' ).value;
    }
</script>
@endsection()
