<?php
/**
 * Created by PhpStorm.
 * User: Nhuan
 * Date: 3/8/2015
 * Time: 10:51 PM
 */
class ResourceController extends \BaseController
{
    public function upload()
    {
        $inputFile = Input::file('file1');
        $response = null;
//        return Response::json(dd($inputFile));
        $max_size = 1;
            //kiểm tra kích thước ảnh
            if ($inputFile->getSize() > $max_size * 1024 * 1024) {
                echo "File quá lớn";
                die;
            }
            else {

                $filetype =$inputFile->getClientOriginalExtension();
                $type_invalid = array("jpg", "gif", "bmp", "png", "jpeg");
                if (in_array($filetype, $type_invalid)) {
//                    //upload
                    $path = public_path().'/assets/' .Auth::user()->username . '/image/';
                    if (!is_dir($path)) {
                        mkdir($path, 0777, true);
                    }
                    $filename = $inputFile->getClientOriginalName();
                    $is_success = $inputFile->move($path,$filename);
                    if ($is_success) {
                        //echo "Luu thanh cong </br>";
                        $response = URL::to(Auth::user()->username.'/'.$filename);
                        // echo $filepath;
                    } else {
                        //echo "Lưu không thành công";
                        $response="Lưu không thành công";
                        die;
                    }
                } else {
                    //echo "Không hỗ trợ định dạng " . $filetype . "Chỉ nhận những định dạng sau: " . implode(", ", $type_invalid);
                    $response="Không hỗ trợ định dạng " . $filetype . "Chỉ nhận những định dạng sau: " . implode(", ", $type_invalid);
                    die;
                }
            }
        return Response::json($response);
    }

    public function uploadImage($input)
    {
        $inputFile = $input;
        $response = null;
//        return Response::json(dd($inputFile));
        $max_size = 1;
        //kiểm tra kích thước ảnh
        if ($inputFile->getSize() > $max_size * 1024 * 1024) {
            echo "File quá lớn";
            die;
        }
        else {

            $filetype =$inputFile->getClientOriginalExtension();
            $type_invalid = array("jpg", "gif", "bmp", "png", "jpeg");
            if (in_array($filetype, $type_invalid)) {
//                    //upload
                $path = public_path().'/assets/' .Auth::user()->username . '/image/';
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }
                $filename = $inputFile->getClientOriginalName();
                $is_success = $inputFile->move($path,$filename);
                if ($is_success) {
                    //echo "Luu thanh cong </br>";
                    $response = URL::to(Auth::user()->username.'/'.$filename);
                    // echo $filepath;
                } else {
                    //echo "Lưu không thành công";
                    $response="Lưu không thành công";
                    die;
                }
            } else {
                //echo "Không hỗ trợ định dạng " . $filetype . "Chỉ nhận những định dạng sau: " . implode(", ", $type_invalid);
                $response="Không hỗ trợ định dạng " . $filetype . "Chỉ nhận những định dạng sau: " . implode(", ", $type_invalid);
                die;
            }
        }
        return $response;
    }
    public function show($username, $name)
    {
        $path = public_path().'/assets/' .$username . '/image/'.$name;
        $file = File::get($path);
        return Response::make($file,200)->header('content-type',File::type($path));
    }
}