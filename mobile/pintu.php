<?php
    define('IN_ECTOUCH', true);

    require(dirname(__FILE__) . '/include/init.php');
    require(ROOT_PATH . 'include/lib_weixintong.php');
    if ((DEBUG_MODE & 2) != 2)
    {
        $smarty->caching = true;
    }
    require_once(ROOT_PATH . 'lang/' .$_CFG['lang']. '/user.php');
    $user_id = $_SESSION['user_id'];

    $img_id=$_GET['id'];
    $act=$_GET['act'];

    if(!$img_id){
      $img_id=1;
    }



    $img_path="images/pintu/01.jpg";
    $url="http://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];
    if($img_id){
      $sql="SELECT img_path from". $ecs->table("pintu") ." WHERE ID=".$img_id;
      $result=$db->getrow($sql);
      $img_path_1=$result['img_path'];
      if($img_path_1 !=""){
        $img_path="images/pintu/".$img_path_1;
      }
    }

    if($act == "upfile"){
       $uploaddir = "./images/pintu/";//设置文件保存目录 注意包含/  
       $type=array("jpg","bmp","jpeg","png");//设置允许上传文件的类型
       $patch="http://www.jialun168.net/mobile/";//程序所在路径
        //$patch="http://127.0.0.1/cr_downloadphp/upload/files/";//程序所在路径

       $a=strtolower(fileext($_FILES['file']['name']));
       //判断文件类型
       if(!in_array(strtolower(fileext($_FILES['file']['name'])),$type))
         {
            $text=implode(",",$type);
            echo "您只能上传以下类型文件: ",$text,"<br>";
         }
       //生成目标文件的文件名  
       else{
            $filename=explode(".",$_FILES['file']['name']);
            do
            {
                $filename[0]=random(10); //设置随机数长度
                $name=implode(".",$filename);
                //$name1=$name.".Mcncc";
                $uploadfile=$uploaddir.$name;
            }
            while(file_exists($uploadfile));
            if (move_uploaded_file($_FILES['file']['tmp_name'],$uploadfile)){
               
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    //输出图片预览
                    //echo "<center>您的文件已经上传完毕 上传图片预览: </center><br><center><img src='$uploadfile'></center>";
                   // echo"<br><center><a href='javascrīpt:history.go(-1)'>继续上传</a></center>";
                  }
                  else{
                   // echo "上传失败！";
                  }
            }


           
       }

         if($name !=""){
        $sql="INSERT INTO ".$ecs->table("pintu")." (`user_id`,`img_path`) VALUES(".$user_id.",'".$name."')";
        $db->query($sql);
        $sql="SELECT * FROM ".$ecs->table("pintu")." WHERE img_path='".$name."'";
        $file_id=$db->getrow($sql);
        $id=$file_id['ID'];
        $url =$url."?id=".$id;
        $img_path="images/pintu/".$name;
       }
    }

    $appId = "wx34c3bde7297cf24a";
    $appsecret = "5278afaa5548e05d130986d98ef508d9";
    $timestamp = time();
    $jsapi_ticket = make_ticket($appId,$appsecret);
    $nonceStr = make_nonceStr();
    $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
    $signature = make_signature($nonceStr,$timestamp,$jsapi_ticket,$url);
    $smarty->assign("timestamp",$timestamp);
    $smarty->assign("nonceStr",$nonceStr);
    $smarty->assign("signature",$signature);
    // $t=time();
    // $smarty->assign("time",$t);
    $smarty->assign("img_path",$img_path);
    $smarty->assign("url",$url);
    $smarty->display("pintu.dwt");



       //获取文件后缀名函数
      function fileext($filename)
    {
        return substr(strrchr($filename, '.'), 1);
    }
   //生成随机文件名函数  
    function random($length)
    {
        // $hash = 'CR-';
        // $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        // $max = strlen($chars) - 1;
        // mt_srand((double)microtime() * 1000000);
        //     for($i = 0; $i < $length; $i++)
        //     {
        //         $hash .= $chars[mt_rand(0, $max)];
        //     }
        $hash=time();
        return $hash;
    }

function make_nonceStr()
{
  $codeSet = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  for ($i = 0; $i<16; $i++) {
    $codes[$i] = $codeSet[mt_rand(0, strlen($codeSet)-1)];
  }
  $nonceStr = implode($codes);
  return $nonceStr;
}
function make_signature($nonceStr,$timestamp,$jsapi_ticket,$url)
{
  $tmpArr = array(
  'noncestr' => $nonceStr,
  'timestamp' => $timestamp,
  'jsapi_ticket' => $jsapi_ticket,
  'url' => $url
  );
  ksort($tmpArr, SORT_STRING);
  $string1 = http_build_query( $tmpArr );
  $string1 = urldecode( $string1 );
  $signature = sha1( $string1 );
  return $signature;
}
function make_ticket($appId,$appsecret)
{
  // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
  $data = json_decode(file_get_contents("access_token.json"));
  if ($data->expire_time < time()) {
    $TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appId."&secret=".$appsecret;
    $json = file_get_contents($TOKEN_URL);
    $result = json_decode($json,true);
    $access_token = $result['access_token'];
    if ($access_token) {
      $data->expire_time = time() + 7000;
      $data->access_token = $access_token;
      $fp = fopen("access_token.json", "w");
      fwrite($fp, json_encode($data));
      fclose($fp);
    }
  }else{
    $access_token = $data->access_token;
  }
  // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
  $data = json_decode(file_get_contents("jsapi_ticket.json"));
  if ($data->expire_time < time()) {
    $ticket_URL="https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi";
    $json = file_get_contents($ticket_URL);
    $result = json_decode($json,true);
    $ticket = $result['ticket'];
    if ($ticket) {
      $data->expire_time = time() + 7000;
      $data->jsapi_ticket = $ticket;
      $fp = fopen("jsapi_ticket.json", "w");
      fwrite($fp, json_encode($data));
      fclose($fp);
    }
  }else{
    $ticket = $data->jsapi_ticket;
  }
  return $ticket;
}
?>