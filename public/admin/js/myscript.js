$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});

$(document).ready(function() {
    $('#dataTables-example-tags').DataTable({
        responsive: true
    });
});



$("div.alert").delay(3000).slideUp();

//xác nhận xóa dữ liệu
function confirm_delete (msg){
    if(window.confirm(msg)){
        return true;
    }
    return false;
}
$(document).ready(function (){
    $("#id_addImage").click(function (){
       $("#id_vitri").append('html');
    });
});

$(document).ready(function (){
    $("a#delImg").click(function (){
        var url = 'http://localhost:8080/LeThai/Laravel/laravel-project/admin/product/delimg/';
        var _token = $("form[name='editProduct']").find("input[name='_token']").val();
        var idHinh = $(this).parent().find("img").attr("idHinh");
        var srcHinh = $(this).parent().find("img").attr("src");
        $.ajax({
            url:url + idHinh,
            type:'GET',
            cache:false,
            data:{"_token":_token, "idHinh":idHinh, "srcHinh":srcHinh},
            success:function(respone){
                if(respone == 'Okie'){
                    $("#thumb"+idHinh).remove();
                }else{
                    alert("Không xóa được");
                }
            }
        })
    });
});