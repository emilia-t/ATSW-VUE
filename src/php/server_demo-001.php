<?php
/**接收及发送数据**/
use Workerman\Worker;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'Workerman/Autoloader.php';
require_once('100054.php');
require_once 'SMTPconfig.php';
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
$global_uid=0;
$user_token_data=[];//主要包含登录用户的认证信息[{'connection_uid'=>1,'user_id'=>1,'user_token'=>'12345678','user_belong_room'=>[1,2]},{}]
$room_data=[];//主要用于存放房间信息(当前在线的)[[0]=>['room_id'=>1,'belong_user'=>[1,2]]]
$qqAndVerificationCode=[];//注册请求，qq和验证码{qq:'',code:''}
$time=date('m-j');//用于创建日志文件名
$log_file=fopen($time.'.txt','a+');
// 当客户端连上来时分配uid，并保存连接，并通知所有客户端
function handle_connection($connection){
    global $socket_worker, $global_uid,$log_file,$basicData;
    // 为这个连接分配一个uid
    $connection->uid = ++$global_uid;
    foreach($socket_worker->connections as $conn) {
        $setDate=creatDate();
        $sendData=['mestime'=>$setDate,'mestype'=>'connect','mes'=>"add",'connectnum'=>count($socket_worker->connections)];
        $conn->send(json_encode($sendData));
    }
    //发放基础数据给该用户
    $basicMessageData=getOldMesData(1);
    $sendData2=['mestime'=>$setDate,'mestype'=>'basicData','room_data'=>getRoomDataBase('1,4'),'mes_data'=>[['room_id'=>'1','mes_data'=>getOldMesData(1)],['room_id'=>'4','mes_data'=>getOldMesData(4)]]];
    //print_r($basicMessageData);
    $connection->send(json_encode($sendData2));
    echo "new user connected[{$connection->uid}]\n";
    //fwrite($log_file,"new user connected[{$connection->uid}] 进入房间\n");
}
// 当客户端发送消息过来时，转发给所有人，参数：客户端与服务器成功连接的socket实例对象；该客户发送的数据(格式为str)
function handle_message($connection, $data){
    global $socket_worker,$log_file,$user_token_data;
    global $mysql_server_name,$mysql_user,$mysql_password,$db_name,$qqAndVerificationCode;
    //禁止发送超长数据,最大800个汉字,一个汉字6个字节
    if(gettype($data)!=='string'){return false;}
    if(strlen($data)==0 or strlen($data)>=4896){return false;}
    if($arrayData=json_decode($data,true)){
        if(isset($arrayData['mestype'])){
            $messageType=$arrayData['mestype'];
            switch ($messageType){
                //登录数据
                //{"mestype":"link","username":"临冉","password":"123456789"}
                case 'link':{
                    if(isset($arrayData['username']) and isset($arrayData['password'])){
                        //print_r($arrayData['username']);
                        $user=$arrayData['username'];
                        $password=$arrayData['password'];
                        @$link=mysqli_connect($mysql_server_name,$mysql_user,$mysql_password,$db_name);
                        if(!$link){return false;}
                        @$sql_c_1="SELECT * FROM user_account_data WHERE atsw_user_name='{$user}' AND atsw_user_pass='{$password}'";
                        @$sql_c=mysqli_query($link,$sql_c_1);
                        if(mysqli_affected_rows($link)<=0){
                            mysqli_close($link);
                            $setDate=creatDate();
                            $sendData=['mestime'=>$setDate,'mestype'=>'linkfail','mes'=>'wrong account or password'];
                            $connection->send(json_encode($sendData));
                            return false;
                        }else{
                            $mysqlData=mysqli_fetch_all($sql_c,MYSQLI_ASSOC);
                            mysqli_close($link);
                            //{"mestime":"2021-05-23 20:29:18","mestype":"welcome","token":"1fzB21","user_id":1,"user_qq":"1658548955","user_name":"临冉","user_nick":"临冉哦","registration_time":"2021-05-14 20:30:52"}
                            //[['connection_uid'=>1,'user_id'=>1,'user_token'=>'12345678','user_name'=>'临冉'],[]]
                            $setDate=creatDate();
                            $token=creatToken();
                            $userid=$mysqlData[0]['atsw_user_id'];
                            $userqq=$mysqlData[0]['atsw_user_qq'];
                            $username=$mysqlData[0]['atsw_user_name'];
                            $usernick=$mysqlData[0]['atsw_user_nick'];
                            $registration=$mysqlData[0]['registration_time'];
                            $belongroom=$mysqlData[0]['atsw_belong_room'];
                            $experience=$mysqlData[0]['experience'];
                            $chessPower=$mysqlData[0]['chess_power'];
                            //判段重复登录，多窗口登录
                            for($ia=0;$ia<count($user_token_data);$ia++){
                                if($userid==$user_token_data[$ia]['user_id']){
                                    $setDate=creatDate();
                                    $sendData=['mestime'=>$setDate,'mestype'=>'linkfail','mes'=>'do not log in again'];
                                    $connection->send(json_encode($sendData));
                                    return false;
                                }
                            }
                            //同一connection uid登录其他账号，自动删除前一账号
                            for($ic=0;$ic<count($user_token_data);$ic++){
                                if($connection->uid==$user_token_data[$ic]['connection_uid']){
                                    if($userid!=$user_token_data[$ic]['user_id']){
                                        //1删除该user_token
                                        unset($user_token_data[$ic]);
                                        //2重新建立索引
                                        $user_token_data=array_values($user_token_data);
                                        //3添加新的token
                                        $user_t_d=['connect'=>$connection,'connection_uid'=>$connection->uid,'user_id'=>$userid,'user_token'=>$token,'user_name'=>$username,'user_qq'=>$userqq,'belong_room'=>$belongroom,'experience'=>$experience,'chess_power'=>$chessPower];
                                        $user_token_data[]=$user_t_d;
                                        $user_room_data=getRoomDataBase($belongroom);
                                        $userBelong=explode(',',$belongroom);
                                        $roomMesData=[];
                                        for($iy=0;$iy<count($userBelong);$iy++){
                                            $theObj=['room_id'=>$userBelong[$iy],'mes_data'=>getOldMesData($userBelong[$iy])];
                                            array_push($roomMesData,$theObj);
                                        }
                                        $sendData=['mestime'=>$setDate,'mestype'=>'welcome','token'=>$token,'user_id'=>$userid,'user_qq'=>$userqq,'user_name'=>$username,'user_nick'=>$usernick,'registration_time'=>$registration,'belong_room'=>$belongroom,'my_belong_room_data'=>$user_room_data,'room_mes_data'=>$roomMesData,'experience'=>$experience,'chess_power'=>$chessPower];
                                        $connection->send(json_encode($sendData));
                                        echo "\n有用户切换账号，当前所有用户数据：\n";
                                        printUserTokenData();
                                        return true;
                                    }
                                }
                            }
                            //当前用户有房间(除1号房间以外，才会入座操作，以及向同房朋友发送roomUpdate的操作)
                            if($belongroom!='1'){
                                $userBR=explode(',',$belongroom);
                                //删除掉1号房
                                for ($it=0;$it<count($userBR);$it++){
                                    if($userBR[$it]=='1'){
                                        unset($userBR[$it]);
                                        $userBR=array_values($userBR);
                                    }
                                }
                                //为每个所属房间入座
                                for ($iq=0;$iq<count($userBR);$iq++){
                                    takeOrSitSeat('in',$userid,$userBR[$iq]);
                                }
                                //为每个房间的在线用户发送房间变动数据
                                $str=implode(',',$userBR);
                                $roomDataAll=getRoomDataBase($str);
                                //$roomDataAll['online_number']++;
                                for ($ix=0;$ix<count($roomDataAll);$ix++){
                                    $theRoomBelongArr=explode(',',$roomDataAll[$ix]['belong_user_id']);
                                    for($ig=0;$ig<count($theRoomBelongArr);$ig++){
                                        for($is=0;$is<count($user_token_data);$is++){
                                            if($theRoomBelongArr[$ig]==$user_token_data[$is]['user_id']){
                                                $sendData=['mestime'=>$setDate,'mestype'=>'roomUpdate','room_id'=>$roomDataAll[$ix]['room_id'],'room_data'=>$roomDataAll[$ix]];
                                                $user_token_data[$is]['connect']->send(json_encode($sendData));
                                            }
                                        }
                                    }
                                }
                            }
                            //获取该用户每个所属房间的前20条消息
                            $userBelong=explode(',',$belongroom);
                            $roomMesData=[];
                            for($iy=0;$iy<count($userBelong);$iy++){
                                $theObj=['room_id'=>$userBelong[$iy],'mes_data'=>getOldMesData($userBelong[$iy])];
                                array_push($roomMesData,$theObj);
                            }
                            $user_t_d=['connect'=>$connection,'connection_uid'=>$connection->uid,'user_id'=>$userid,'user_token'=>$token,'user_name'=>$username,'user_qq'=>$userqq,'belong_room'=>$belongroom,'experience'=>$experience,'chess_power'=>$chessPower];
                            $user_token_data[]=$user_t_d;
                            $user_room_data=getRoomDataBase($belongroom);
                            $sendData=['mestime'=>$setDate,'mestype'=>'welcome','token'=>$token,'user_id'=>$userid,'user_qq'=>$userqq,'user_name'=>$username,'user_nick'=>$usernick,'registration_time'=>$registration,'belong_room'=>$belongroom,'my_belong_room_data'=>$user_room_data,'room_mes_data'=>$roomMesData,'experience'=>$experience,'chess_power'=>$chessPower];
                            $connection->send(json_encode($sendData));//向登录者发送欢迎包
                            //向所属房间的登录用户发送房间信息
                            echo "\n有用户登录到服务器，当前所有用户数据：\n";
                            printUserTokenData();
                        }
                    }else{
                        $date=getdate();
                        $setDate="{$date['year']}-{$date['mon']}-{$date['mday']} {$date['hours']}:{$date['minutes']}:{$date['seconds']}";
                        $sendData=['mestime'=>$setDate,'mestype'=>'error','mes'=>$data];
                        $connection->send(json_encode($sendData));
                        echo "\n无法找到账号或密码数据，用户发来的数据如下：";
                        print_r($data);
                        return false;
                    }
                    break;
                }
                //普通文本数据
                //用户面数据['connection_uid'=>$connection->uid,'user_id'=>$userid,'user_token'=>$token,'user_name'=>$username,'user_qq'=>$userqq]
                //用户发出{"mestype":"common","send_token":"1f8B58dd","send_room":1,"mes":"\u6d4b\u8bd5\u4fe1\u606f"}
                //用户接收{"mestime":"2021-05-31 12:15:45","mestype":"common","send_room_id":1,"send_user_id":1,"send_user_nick":"临冉哦","send_user_name":"临冉","mes":"\u6d4b\u8bd5\u4fe1\u606f"}
                case 'common':{
                    if(isset($arrayData['send_token'])){
                        if(strlen($arrayData['send_token'])==10 and isset($arrayData['send_room']) and isset($arrayData['mes'])){
                            //查询该数据是否合法
                            $token=$arrayData['send_token'];
                            $sendLock=false;//若用户的token不正确，不会发送数据出去
                            $this_user_face=null;
                            $this_mes_data=null;
                            //根据token获取该用户的面信息
                            for($ib=0;$ib<count($user_token_data);$ib++){
                                if($token==$user_token_data[$ib]['user_token']){
                                    $sendLock=true;
                                    $this_user_face=$user_token_data[$ib];
                                }
                            }
                            //广播数据
                            if($sendLock){
                                //查询该user_id的nick
                                @$link=mysqli_connect($mysql_server_name,$mysql_user,$mysql_password,$db_name);
                                @$sql_c_2="SELECT atsw_user_nick FROM user_account_data WHERE atsw_user_id={$this_user_face['user_id']}";
                                @$sql_t_2=mysqli_query($link,$sql_c_2);
                                mysqli_close($link);
                                if(mysqli_num_rows($sql_t_2)<=0){return false;}//无果退出
                                $userNick=mysqli_fetch_array($sql_t_2,MYSQLI_ASSOC)['atsw_user_nick'];//关联数组
                                //更具roomId发送该条数据，若roomid=1，则全部广播，这是公共房间
                                //广播给其他用户
                                if($arrayData['send_room']==1){
                                    foreach($socket_worker->connections as $conn) {
                                        $setDate=creatDate();
                                        $sendData=['mestime'=>$setDate,'mestype'=>'common','send_room_id'=>$arrayData['send_room'],'send_user_id'=>$this_user_face['user_id'],'send_user_nick'=>$userNick,'send_user_name'=>$this_user_face['user_name'],'send_user_qq'=>$this_user_face['user_qq'],'mes'=>$arrayData['mes']];
                                        $conn->send(json_encode($sendData));
                                    }
                                    //写入日志文件
                                    //fwrite($log_file,"user[{$connection->uid}] said: $data\n");
                                }
                                else{
                                    //1判断用户要发送的房间是否存在
                                    //sql查询
                                    @$link=mysqli_connect($mysql_server_name,$mysql_user,$mysql_password,$db_name);
                                    @$sql_c_1="SELECT * FROM room_data a WHERE room_id='{$arrayData['send_room']}' AND belong_user_id LIKE '%{$this_user_face['user_id']}%'";
                                    @$sql_c=mysqli_query($link,$sql_c_1);
                                    if(mysqli_num_rows($sql_c)<=0){
                                        $setDate=creatDate();
                                        $sendData=['mestime'=>$setDate,'mestype'=>'error','mes'=>'undefined room id'];
                                        $connection->send(json_encode($sendData));
                                        return false;
                                    }//无果退出
                                    $data=mysqli_fetch_array($sql_c,MYSQLI_ASSOC);//关联数组
                                    //Array ( [room_id] => 1 [belong_user_id] => 1,2 [room_head_img] => http [room_name] => ATSW-外棋 [room_master] => 1 [remarks] => 公共的房间 [describe] => )
                                    $thisRoomBelong=explode(',',$data['belong_user_id']);
                                    for($ig=0;$ig<count($thisRoomBelong);$ig++){
                                        for($ih=0;$ih<count($user_token_data);$ih++){
                                            if($user_token_data[$ih]['user_id']==$thisRoomBelong[$ig]){
                                                $setDate=creatDate();
                                                $sendData=['mestime'=>$setDate,'mestype'=>'common','send_room_id'=>$arrayData['send_room'],'send_user_id'=>$this_user_face['user_id'],'send_user_nick'=>$userNick,'send_user_name'=>$this_user_face['user_name'],'send_user_qq'=>$this_user_face['user_qq'],'mes'=>$arrayData['mes']];
                                                $user_token_data[$ih]['connect']->send(json_encode($sendData));
                                            }
                                        }
                                    }
                                }
                                $giveDataBase=['mestime'=>$setDate,'mestype'=>'common','send_room_id'=>$arrayData['send_room'],'send_user_id'=>$this_user_face['user_id'],'send_user_nick'=>$userNick,'send_user_name'=>$this_user_face['user_name'],'send_user_qq'=>$this_user_face['user_qq'],'mes'=>$arrayData['mes']];
                                saveToDatabase($giveDataBase);
                            }else{
                                $setDate=creatDate();
                                $sendData=['mestime'=>$setDate,'mestype'=>'error','mes'=>'undefined token'];
                                $connection->send(json_encode($sendData));
                                return false;
                            }
                        }else{
                            $setDate=creatDate();
                            $sendData=['mestime'=>$setDate,'mestype'=>'error','mes'=>'unset token or room or mes'];
                            $connection->send(json_encode($sendData));
                            return false;
                        }
                    }
                    break;
                }
                //注册请求数据
                //注册所需要参数：1，账号名；2，密码；3，QQ号；4，验证码，当验证码正确则注册成功
                //请求格式：{"mestype":"register","username":"username","password":"password","qq":'12121',"code":""}
                case 'register':{
                  if(!isset($arrayData['username'])) return false;
                  if(!isset($arrayData['password'])) return false;
                  if(!isset($arrayData['qq'])) return false;
                  if(!isset($arrayData['code'])) return false;
                  if(count($qqAndVerificationCode)==0) return false;
                  //检查验证码是否正确
                  $registerClock=false;
                  $finditr=0;
                  for($itr=0;$itr<count($qqAndVerificationCode);$itr++){
                    if($qqAndVerificationCode[$itr]['qq']==$arrayData['qq'] && $qqAndVerificationCode[$itr]['code']==$arrayData['code']){
                      $registerClock=true;
                      $finditr=$itr;
                    }
                  }
                  if($registerClock=false) {//验证码错误
                    $setDate=creatDate();
                    $sendData=['mestime'=>$setDate,'mestype'=>'registerfail','mes'=>'register fail'];
                    $connection->send(json_encode($sendData));
                    return false;
                  }
                  //验证码正确  添加默认所属房间号
                  @$link=mysqli_connect($mysql_server_name,$mysql_user,$mysql_password,$db_name);
                  @$sql_c_1="INSERT INTO user_account_data (atsw_user_name,atsw_user_pass,atsw_user_qq,atsw_user_nick,atsw_belong_room,atsw_friends,experience,chess_power) VALUES ('{$arrayData['username']}','{$arrayData['password']}','{$arrayData['qq']}','{$arrayData['username']}','1,4','1','50','100')";
                  @$sql_c=mysqli_query($link,$sql_c_1);
                  if(mysqli_affected_rows($link)<=0){return false;}
                  //$data=mysqli_fetch_all($sql_c,MYSQLI_ASSOC);//关联数组
                  $setDate=creatDate();
                  $sendData=['mestime'=>$setDate,'mestype'=>'registersuccess','mes'=>'register success'];
                  array_splice($qqAndVerificationCode,$finditr);//删除验证码
                  mysqli_close($link);
                  $connection->send(json_encode($sendData));
                  break;
                }
                //注册验证码请求数据
                //所需参数：1，QQ
                //请求格式：{"mestype":'registerCode','qq':'23232'}
                case 'registerCode':{
                  if(!isset($arrayData['qq'])) return false;
                  $nowGetVerificationCode=sendVerificationCode($arrayData['qq']);//发送邮件
                  if(count($qqAndVerificationCode)==0){
                    $VerCodeObj=['qq'=>$arrayData['qq'],'code'=>creatVerificationCode()];
                    array_push($qqAndVerificationCode,$VerCodeObj);
                  }
                  if($nowGetVerificationCode!==false){
                    $nowGetVerificationCodeClock=false;
                    $findIyt=0;
                    for($iyt=0;$iyt<count($qqAndVerificationCode);$iyt++){
                      if($qqAndVerificationCode[$iyt]['qq']==$arrayData['qq']){
                        $nowGetVerificationCodeClock=true;
                        $findIyt=$iyt;
                        break;
                      }
                    }
                    if($nowGetVerificationCodeClock){//修改原数据
                      $qqAndVerificationCode[$findIyt]['code']=$nowGetVerificationCode;
                    }else{
                      $VerCodeObj=['qq'=>$arrayData['qq'],'code'=>creatVerificationCode()];
                      array_push($qqAndVerificationCode,$VerCodeObj);
                    }
                    print_r('收到一条注册验证码请求，注册QQ：'.$arrayData['qq'].'验证码：'.$nowGetVerificationCode);
                  }
                  break;
                }
                default:{
                    $setDate=creatDate();
                    $sendData=['mestime'=>$setDate,'mestype'=>'error','mes'=>'unknown mestype'];
                    $connection->send(json_encode($sendData));
                    return false;
                }
            }
        }else{
            $date=getdate();
            $setDate="{$date['year']}-{$date['mon']}-{$date['mday']} {$date['hours']}:{$date['minutes']}:{$date['seconds']}";
            $sendData=['mestime'=>$setDate,'mestype'=>'error','mes'=>$data];
            $connection->send(json_encode($sendData));
            echo "\n无法找到mestype，用户发来的数据如下：";
            print_r($data);
        }
    }else{
        $date=getdate();
        $setDate="{$date['year']}-{$date['mon']}-{$date['mday']} {$date['hours']}:{$date['minutes']}:{$date['seconds']}";
        $sendData=['mestime'=>$setDate,'mestype'=>'error','mes'=>$data];
        $connection->send(json_encode($sendData));
        echo "\n解析json失败，用户发来的数据如下：";
        print_r($data);
    }
}
// 当客户端断开时，广播给所有匿名客户端一个用户下线，广播给房间好友朋友下线，下线者离座操作
function handle_close($connection){
    global $socket_worker,$log_file,$user_token_data;
    for($ie=0;$ie<count($user_token_data);$ie++){
        if($connection->uid==$user_token_data[$ie]['connection_uid']){
            $theUserData=getUserAccountData($user_token_data[$ie]['user_id']);
            $theUserBelong=explode(',',$theUserData[0]['atsw_belong_room']);
            //删除掉1号房
            for ($it=0;$it<count($theUserBelong);$it++){
                if($theUserBelong[$it]=='1'){
                    unset($theUserBelong[$it]);
                    $theUserBelong=array_values($theUserBelong);
                }
            }
            for ($iw=0;$iw<count($theUserBelong);$iw++){
                takeOrSitSeat('break',$user_token_data[$ie]['user_id'],$theUserBelong[$iw]);
            }
            unset($user_token_data[$ie]);//清除登录面部缓存
            $user_token_data=array_values($user_token_data);//重整数组
        }
    }
    foreach($socket_worker->connections as $conn) {
        $setDate=creatDate();
        $sendData=['mestime'=>$setDate,'mestype'=>'connect','mes'=>"subtract",'connectnum'=>count($socket_worker->connections )-1];
        $conn->send(json_encode($sendData));
    }
    echo "a user leave[{$connection->uid}]\n";
    fwrite($log_file,"a user leave[{$connection->uid}] 断开连接\n");
}
// 创建一个文本协议的Worker监听2347接口


// 证书最好是申请的证书
$context = array(
'ssl' => array(
// 使用绝对路径
'local_cert' => 'C://SSL/1_atsw.top_bundle.crt', // 也可以是crt文件
'local_pk' => 'C://SSL/2_atsw.top.key',
'verify_peer' => false,
)
);
// 这里设置的是websocket协议
$socket_worker = new Worker('websocket://0.0.0.0:9998', $context);
// 设置transport开启ssl，websocket+ssl即wss
$socket_worker->transport = 'ssl';


$socket_worker->onMessage = function($con, $msg) {
$con->send('ok');
};
// 启动100个进程
$socket_worker->count = 100;
$socket_worker->onConnect = 'handle_connection';
$socket_worker->onMessage = 'handle_message';
$socket_worker->onClose = 'handle_close';
Worker::runAll();
/**接收及发送数据尾**/
/**具有特殊功能的函数**/
//账号注册，参数：用户名，密码，QQ
function accountRegistration(){

}
//向用户发送注册用验证码，参数：用户qq；成功返回值:验证码；失败返回值:false
function sendVerificationCode($qqNumber){
    try {
        global $licenseCodeIMAP;
        $code=creatVerificationCode();
        $PHPMailerObj = new PHPMailer(true);
        $PHPMailerObj->CharSet='UTF-8';
        $PHPMailerObj->SMTPDebug=0;
        $PHPMailerObj->isSMTP();
        $PHPMailerObj->Host='smtp.qq.com';
        $PHPMailerObj->SMTPAuth=true;
        $PHPMailerObj->Username='emilia-t@qq.com';
        $PHPMailerObj->Password=$licenseCodeIMAP;
        $PHPMailerObj->SMTPSecure='ssl';
        $PHPMailerObj->Port=465;
        $PHPMailerObj->setFrom('emilia-t@qq.com', 'emilia-t');
        $PHPMailerObj->addAddress("$qqNumber@qq.com", "$qqNumber@qq.com");//收件人
        $PHPMailerObj->addReplyTo('emilia-t@qq.com','emilia-t');
        $PHPMailerObj->isHTML(true);
        $PHPMailerObj->Subject='欢迎您注册ATSW外棋账号！';
        $PHPMailerObj->Body='<h1>【ATSW】您正在注册ATSW外棋账号，验证码：<span style="color: #323232;font-weight: 800">'.$code.'</span>，请勿向任何人泄露，若非本人操作，请忽略此邮件。</h1>'.date('Y-m-d H:i:s');
        $PHPMailerObj->AltBody='【ATSW】您正在注册ATSW外棋账号，验证码：'.$code.'，请勿向任何人泄露，若非本人操作，请忽略此邮件。'.date('Y-m-d H:i:s');
        $PHPMailerObj->send();
        echo '验证码邮件发送成功，注册者QQ：'.$qqNumber;
        return $code;
    } catch (Exception $e) {
        echo '验证码邮件发送失败，注册者QQ: '.$qqNumber, $PHPMailerObj->ErrorInfo;
        return false;
    }
}
//服务端界面打印用户面数据
function printUserTokenData(){
    global $user_token_data;
    for($iq=0;$iq<count($user_token_data);$iq++){
        echo "\n----------\n";
        echo('connection_uid:'.$user_token_data[$iq]['connection_uid']);
        echo "\n";
        echo('user_id:'.$user_token_data[$iq]['user_id']);
        echo "\n";
        echo('user_token:'.$user_token_data[$iq]['user_token']);
        echo "\n";
        echo('user_name:'.$user_token_data[$iq]['user_name']);
        echo "\n";
        echo('user_qq:'.$user_token_data[$iq]['user_qq']);
        echo "\n";
        echo('belong_room:'.$user_token_data[$iq]['belong_room']);
        echo "\n----------\n";
    }
}
//获取某房间的旧聊天数据，每20条为一组,参数：roomId(房间号 int 或数字的str),page(页码，默认为1,即第一页)
function getOldMesData($roomId,$page=1){
    global $mysql_server_name,$mysql_user,$mysql_password,$db_name;
    $page=$page*20-20;
    @$link=mysqli_connect($mysql_server_name,$mysql_user,$mysql_password,$db_name);
    @$sql_c_1="SELECT * FROM room_mes_data_{$roomId} ORDER BY mes_id DESC LIMIT {$page},20";
    @$sql_c=mysqli_query($link,$sql_c_1);
    if(mysqli_affected_rows($link)<=0){return false;}
    $data=mysqli_fetch_all($sql_c,MYSQLI_ASSOC);//关联数组
    return $data;
}
//入座或离座函数
function takeOrSitSeat($type,$uid,$roomid){
    global $mysql_server_name,$mysql_user,$mysql_password,$db_name;
    @$link=mysqli_connect($mysql_server_name,$mysql_user,$mysql_password,$db_name);
    switch ($type){
        case 'in':{
            //获取该房间的座位数据，首先判断数据是否为空，若为空则不用在uid前添加","，否则开始->并判断是否重复出现入座，没有发现重复则在末尾添加该用户(更新数据库)
            //1获取该房间的座位数据
            $data=getRoomDataBase($roomid)[0]['online_user'];
            if($data==''){
                @$sql_c_2="UPDATE room_data SET online_user='{$uid}' WHERE room_id='{$roomid}'";
                @$sql_c_2.="update room_data set online_number=online_number+1 where room_id = '{$roomid}'";
                @$sql_c=mysqli_multi_query($link,$sql_c_2);
                mysqli_close($link);
            }else{
                $userArr=explode(',',$data);
                for ($ir=0;$ir<count($userArr);$ir++){
                    if ($userArr[$ir]==$uid){
                        return false;
                    }
                }
                $newData=$data.=','.$uid;
                @$sql_c_2="UPDATE room_data SET online_user='{$newData}' WHERE room_id='{$roomid}'";
                @$sql_c_2.="update room_data set online_number=online_number+1 where room_id = '{$roomid}'";
                @$sql_c=mysqli_multi_query($link,$sql_c_2);
                mysqli_close($link);
            }
            break;
        }
        case 'break':{
            $data=getRoomDataBase($roomid)[0]['online_user'];
            if($data==''){
                return false;
            }else{
                $userArr=explode(',',$data);
                for ($ir=0;$ir<count($userArr);$ir++){
                    if ($userArr[$ir]==$uid){
                        unset($userArr[$ir]);
                        $newData=implode(',',$userArr);
                        @$sql_c_2="UPDATE room_data SET online_user='{$newData}' WHERE room_id='{$roomid}'";
                        @$sql_c_2.="update room_data set online_number=online_number-1 where room_id = '{$roomid}'";
                        @$sql_c=mysqli_multi_query($link,$sql_c_2);
                        mysqli_close($link);
                        return false;
                    }
                }
            }
            break;
        }
        default:{return false;}
    }
}
//获取用户账户数据
function getUserAccountData($str){
    global $mysql_server_name,$mysql_user,$mysql_password,$db_name;
    @$link=mysqli_connect($mysql_server_name,$mysql_user,$mysql_password,$db_name);
    @$sql_c_1="SELECT * FROM user_account_data WHERE atsw_user_id IN ({$str})";
    @$sql_c=mysqli_query($link,$sql_c_1);
    if(mysqli_affected_rows($link)<=0){return false;}
    $data=mysqli_fetch_all($sql_c,MYSQLI_ASSOC);//关联数组
    return $data;
}
//将用户发送的消息上传到数据库，必要参数：ARRAY
//格式实例：
//$giveToDataBase=$sendData=['mestime'=>$setDate,'mestype'=>'common','send_room_id'=>$arrayData['send_room'],'send_user_id'=>$this_user_face['user_id'],'send_user_nick'=>$userNick,'send_user_name'=>$this_user_face['user_name'],'send_user_qq'=>$this_user_face['user_qq'],'mes'=>$arrayData['mes']];
function saveToDatabase($data){
    global $mysql_server_name,$mysql_user,$mysql_password,$db_name;
    $mesTime=$data['mestime'];
    $mesType=$data['mestype'];
    $sendRoomId=$data['send_room_id'];
    $sendUserId=$data['send_user_id'];
    $sendUsername=$data['send_user_name'];
    $sendUserNick=$data['send_user_nick'];
    $sendUserQq=$data['send_user_qq'];
    $mes=$data['mes'];
    @$link=mysqli_connect($mysql_server_name,$mysql_user,$mysql_password,$db_name);
    //上传用户发送的数据
    @$sql_c_1="INSERT INTO room_mes_data_{$sendRoomId} (mes_time,mes_type,send_room_id,send_user_id,send_user_name,send_user_nick,send_user_qq,mes) VALUES ('{$mesTime}','{$mesType}',{$sendRoomId},{$sendUserId},'{$sendUsername}','{$sendUserNick}','{$sendUserQq}','{$mes}')";
    if(mysqli_query($link,$sql_c_1)){
        mysqli_close($link);
        return true;
    }else{
        mysqli_close($link);
        return false;
    }
}
//生成token，返回值10位token，总计两百多万亿种组合，字符串
function creatToken(){
    $str=['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','@','%','~','^','_','`',',','*'];
    $token='';
    for($i=0;$i<10;$i++){
        $ran=rand(0,69);
        $token.=$str[$ran];
    }
    return $token;
}
//注册验证码
function creatVerificationCode(){
    $str=['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    $token='';
    for($i=0;$i<6;$i++){
        $ran=rand(0,61);
        $token.=$str[$ran];
    }
    return $token;
}
//生成当前时间
function creatDate(){
    $date=getdate();
    $mon=sprintf('%02d',$date['mon']);
    $day=sprintf('%02d',$date['mday']);
    $hours=sprintf('%02d',$date['hours']);
    $minutes=sprintf('%02d',$date['minutes']);
    $seconds=sprintf('%02d',$date['seconds']);
    return "{$date['year']}-{$mon}-{$day} {$hours}:{$minutes}:{$seconds}";
}
//刷新某一用户的面部数据,参数：user_id，成功返回true,并更新user_token_data
function refreshUserFace($user_id){

}
//单独为一个房间创建数据表,参数：room_id
function creatRoomDataBase($room_id){
    global $mysql_server_name,$mysql_user,$mysql_password,$db_name;
    @$link=mysqli_connect($mysql_server_name,$mysql_user,$mysql_password,$db_name);
    @$sql_c_1="SET NAMES utf8mb4; SET FOREIGN_KEY_CHECKS = 0;  DROP TABLE IF EXISTS `room_mes_data_{$room_id}`;  CREATE TABLE `room_mes_data_{$room_id}` ( `mes_id` INT(11) NOT NULL AUTO_INCREMENT, `mes_time` TIMESTAMP(0) NOT NULL, `mes_type` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `send_room_id` INT(12) NOT NULL, `send_user_id` INT(12) NOT NULL, `send_user_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `send_user_nick` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `send_user_qq` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `mes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `remarks` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL, PRIMARY KEY USING BTREE (`mes_id`) ) ENGINE = INNODB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic; SET FOREIGN_KEY_CHECKS = 1;";
    @$sql_c=mysqli_query($link,$sql_c_1);
}
//获取一个或多个房间的数据,参数1,2
//Array ( [0] => Array ( [room_id] => 2 [belong_user_id] => 1,2 [room_head_img] => http:// [room_name] => Lin&Emilia [room_master] => 1 [remarks] => 私聊房间 [describe] => ) )
function getRoomDataBase($str){
    global $mysql_server_name,$mysql_user,$mysql_password,$db_name;
    @$link=mysqli_connect($mysql_server_name,$mysql_user,$mysql_password,$db_name);
    //$roomId=implode(',',$arr);
    @$sql_c_1="SELECT * FROM room_data a WHERE room_id IN ({$str})";
    @$sql_c=mysqli_query($link,$sql_c_1);
    if(mysqli_affected_rows($link)<=0){return false;}
    $data=mysqli_fetch_all($sql_c,MYSQLI_ASSOC);//关联数组
    return $data;
}
/**具有特殊功能的函数尾**/