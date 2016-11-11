<?php 
function convert_vi_to_en($str)
{
	$unicode = array(
           'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
           'd'=>'đ',
           'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
           'i'=>'í|ì|ỉ|ĩ|ị',
           'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
           'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
           'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
           'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
           'D'=>'Đ',
           'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
           'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
           'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
           'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
           'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
       );

    foreach($unicode as $nonUnicode=>$uni) {
      $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
	  $str = str_replace(' ', '-', $str);
    $str = strtolower($str);
	  
    return $str;
	}

function cate_parent($data, $parent = 0, $str = '--', $select = 0)
{
    foreach ($data as $val) {
      if ($val['parent_id'] == $parent) {
        if ($val['id'] == $select && $select != 0) {
          echo "<option value='" .$val['id']. "' selected='selected'>" .$str . $val['name']. "</option>";
        }else{
          echo "<option value='" .$val['id']. "'>" .$str . $val['name']. "</option>";
        }
        cate_parent($data, $val['id'], $str.'--', $select);
      }
    }
}

function convertStringDate2String($date, $fromFormat, $toFormat) {
    $datetime = new DateTime();
    $datetime = $datetime->createFromFormat($fromFormat, $date);
    if ($datetime) {
      return $datetime->format($toFormat);
    }
    return null;
}
