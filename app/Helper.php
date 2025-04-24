<?php

use Carbon\Carbon;

function status($message, $code)
{
    return json_encode((object)["status" => $code, "message" => $message]);
}

function diffForHumans($str)
{
    Carbon::setLocale('vi');
    $carbon = Carbon::createFromFormat('Y-m-d H:i:s', $str);
    return $carbon->diffForHumans();
}

function formatDateTime($str)
{
    Carbon::setLocale('vi');
    $carbon = Carbon::createFromFormat('Y-m-d H:i:s', $str);
    return $carbon->format('d/m/Y h:i:s');
}


function toSlug($string)
{
    $search = array(
        '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
        '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
        '#(ì|í|ị|ỉ|ĩ)#',
        '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
        '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
        '#(ỳ|ý|ỵ|ỷ|ỹ)#',
        '#(đ)#',
        '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
        '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
        '#(Ì|Í|Ị|Ỉ|Ĩ)#',
        '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
        '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
        '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
        '#(Đ)#',
        "/[^a-zA-Z0-9\-\_]/",
    );
    $replace = array(
        'a',
        'e',
        'i',
        'o',
        'u',
        'y',
        'd',
        'A',
        'E',
        'I',
        'O',
        'U',
        'Y',
        'D',
        '-',
    );
    $string = preg_replace($search, $replace, $string);
    $string = preg_replace('/(-)+/', '-', $string);
    $string = strtolower($string);
    return $string;
}

function toAttrJson($data, $list = []){
    if (count($list)){
        $tmp = array();
        $data = (array)$data;
        foreach ($list as $key){
            $tmp[$key] = $data[$key];
        }
        return json_encode($tmp);
    }
    return json_encode($data);
}

function getIDTK(){
    return session()->get(\App\StaticString::SESSION_IDTK);
}

function isLogin(){
    return session()->exists(\App\StaticString::SESSION_ISLOGIN);
}

function getSSKey($key){
    return session()->get($key);
}

function shortContent($noi_dung, $length=90){
    return Str::limit(strip_tags($noi_dung), $length);
}

function toLazzy($noi_dung){
    $pattern = '/<img(.*?)src=["\'](.*?)["\'](.*?)>/i';
    $replacement = '<img$1data-src="$2"$3 class"lazyload">';
    return preg_replace($pattern, $replacement, $noi_dung);
}
