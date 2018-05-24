<?php  defined('BASEPATH') OR exit('No direct script access allowed');

    class User extends CI_Controller{
        public function __construct()
        {
            parent::__construct();

            $this->load->model('user_model');
        }
    
        public function show_unindex(){             //首页
            $cata=$this->user_model->home_cata();
            $catalog=$this->user_model->home_catalog();
            $rss = $this->user_model->showIndexGoods();
            foreach ($cata as $keyq) {
                $keyq->aaa=$this->user_model->home_catas($keyq->ccid);
            }
            $rs['goodss']=$cata;
            $rs['shows']=$rss;
            echo json_encode($rs);  

        }
        public function showIndexGoods(){   //首页商品展示
            $rs = $this->user_model->showIndexGoods();
            if($rs){
                 echo json_encode($rs);  
            }
        }

        public function show_personal(){           //个人信息
            $uid = $this->input->post('id');
            $rows=$this->user_model->get_all($uid);
            $arr['user']=$rows;
            echo json_encode($arr);
        }
        public function changePersonal(){             //更改个人信息
            $uid = $this->input->post('uid');
            $uname = $this->input->post('uname');
            $usex = $this->input->post('usex');
            $ubirth = $this->input->post('ubirth');
            $utel = $this->input->post('utel');
            $rs = $this->user_model->changePersonal($uid,$uname,$usex,$ubirth,$utel);
            echo json_encode($rs);
        }

        public function do_search(){
            $id = $this->input->get('id');
            $sid = $this->input->get('sid');
            $ssid = $this->input->get('ssid');
            $showsid = $this->input->get('showsid');
            $timeid = $this->input->get('timeid');
            if ($id) {
                $as = $this->user_model->get_search_id($id);
                $rows = $this->user_model->get_allrows($id);
                if ($rows) {
                    $arr['id'] = $as;
                    $arr['goods'] = $rows;
                    echo json_encode($arr);  
                } else {
                    redirect('user/show_search_none');
                }
            }
            if ($sid) {
                $as = $this->user_model->get_search_id($sid);
                $rows = $this->user_model->get_data2($sid);
                if ($rows) {
                    $arr['id'] = $as;
                    $arr['goods'] = $rows;
                    echo json_encode($arr);  
                }
            }
            if ($ssid) {
                $as = $this->user_model->get_search_id($ssid);
                $rows = $this->user_model->get_data1($ssid);
                if ($rows) {
                    $arr['id'] = $as;
                    $arr['goods'] = $rows;
                    echo json_encode($arr); 
                }
            }
            if ($showsid) {
                $as = $this->user_model->get_search_id($showsid);
                $rows = $this->user_model->getGoodsByShows($showsid);
                if ($rows) {
                    $arr['id'] = $as;
                    $arr['goods'] = $rows;
                    echo json_encode($arr); 
                }
            }
            if ($timeid) {
                $as = $this->user_model->get_search_id($timeid);
                $rows = $this->user_model->getGoodsByTime($timeid);
                if ($rows) {
                    $arr['id'] = $as;
                    $arr['goods'] = $rows;
                    echo json_encode($arr); 
                }
            }


        }
        public function do_sear(){
            $search = $this->input->post('search');
            if($search){
                $arr=array(
                    'search'=>$search
                );
                $this->session->set_userdata($arr);
                $rs1=$this->user_model->get_title($search);
                if($rs1){
                    $arr['goods']=$rs1;
                    echo  json_encode($arr);  
                }else{
                    echo  json_encode('ss');  
                }
            }else{
                echo  json_encode('ss');  
            }
        }
        public function show_single(){
            $id=$this->input->get('id');
            $rs=$this->user_model->get_id($id);
			$rs1=$this->user_model->get_pl($id);
			foreach ($rs1 as $key1) {
				$key1->aaa=$this->user_model->get_pl_user($key1->uid);	
			}
            $arr['id']=$rs;
			$arr['pl']=$rs1;
            echo json_encode($arr);  
        }
        public function do_login(){                             //用户登录
            $email=$this->input->post('email');
            $pwd=$this->input->post('pwd');
            $rs=$this->user_model->do_login($email,$pwd);
            if($rs){
                $arr=array(
                    'id'=>$rs->uid,
                    'name'=>$rs->uname,
                    'logged_in' => TRUE,
                );
                $this->session->set_userdata($arr);
                $rs=json_encode($rs);
                echo $rs;
            }else{
                echo 2;
            } 
        }
        public function businessLogin(){     //商家登录
            header('Access-Control-Allow-Origin:*');  
            $email=$this->input->post('uemail');
            $pwd=$this->input->post('upass');
            $rs=$this->user_model->businessLogin($email,$pwd);
            if($rs){
                $rs=json_encode($rs);
                echo $rs;
            }else{
                echo 2;
            } 
        }
        public function adminLogin(){     //管理员登录
            header('Access-Control-Allow-Origin:*');  
            $email=$this->input->post('uemail');
            $pwd=$this->input->post('upass');
            $rs=$this->user_model->adminLogin($email,$pwd);
            if($rs){
                $rs=json_encode($rs);
                echo $rs;
            }else{
                echo 2;
            } 
        }

        public function check(){                  //注册查重
            $name=$this->input->post('email');
            $rs=$this->user_model->get_check($name);
            if($rs){
                echo 1; 
            }else{
                echo 11;  
            }    
        }
         public function check1(){                  //商家注册查重
           header('Access-Control-Allow-Origin:*'); 
            $name=$this->input->post('bemail');
            $rs=$this->user_model->get_check1($name);
            if($rs){
                echo 1; 
            }else{
                echo 11;  
            }    
        }

        public function doReg(){             //注册
            $name=$this->input->post('email');
            $pass=$this->input->post('pwd');
            $rs=$this->user_model->set_insert($name,$pass);
            echo json_encode($rs);  
        }
        public function doReg1(){             //商家注册
            header('Access-Control-Allow-Origin:*'); 
            $name=$this->input->post('uemail');
            $pass=$this->input->post('upass');
            $rs=$this->user_model->set_insert1($name,$pass);
            echo json_encode($rs);  
        }
	
        public function doBuy(){              //购买
            $uid = $this->input->post('uid');
            $wid = $this->input->post('wid');
            $nums = $this->input->post('nums');
            $rs=$this->user_model->doBuyUpdateGoods($wid,$nums);
            $btime= date("Y-m-d");
            $row=$this->user_model->doBuy($wid,$uid,$nums,$btime);
            if($row){
                echo 1;
            }else{
                echo 2;
            }
        }
        public function getCollection(){              //个人信息中购物车
            $uid = $this->input->post('id');
            $rs=$this->user_model->getCollection($uid);
            foreach ($rs as $key1) {
                $key1->aaa=$this->user_model->getCollectionGoods($key1->wid); 
            }
            $arr['goods']=$rs;
            echo json_encode($arr);
        }

        public function deleteCollection(){              //个人信息中删除购物车
            $id = $this->input->post('id');
            $rs=$this->user_model->deleteCollection($id);
            echo json_encode($rs);
        }

        public function getBuyinfo(){              //个人信息中购买记录
            $uid = $this->input->post('id');
            $rs=$this->user_model->getBuyinfo($uid);
            foreach ($rs as $key1) {
                $key1->aaa=$this->user_model->getBuyinfoGoods($key1->wid); 
            }
            $arr['goods']=$rs;
            echo json_encode($arr);
        }

        public function deleteBuyInfo(){              //个人信息中删除购买记录
            $id = $this->input->post('id');
            $rs=$this->user_model->deleteBuyInfo($id);
            echo json_encode($rs);
        }

         public function doAdd(){              //添加购物车
            $uid = $this->input->post('uid');
            $wid = $this->input->post('wid');
            $cnums = $this->input->post('cnums');
            $ctime= date("Y-m-d");
            $res=$this->user_model->check_collect($wid,$uid);
            if($res){
                $row=$this->user_model->updateCollect($wid,$uid,$cnums,$ctime);
            }else{
                $row=$this->user_model->doAdd($wid,$uid,$cnums,$ctime);
            }
            if($row){
                echo 1;
            }else{
                echo 2;
            }
        }
		public function userPl(){               //评论
           header('Access-Control-Allow-Origin:*');
            $wid=$this->input->post('wid');
            $uid=$this->input->post('uid');
            $plcont =$this->input->post('plcont');
            $pltime= date("Y-m-d");
            $rs=$this->user_model->userPl($wid,$uid,$plcont,$pltime);
            echo json_encode($rs);
        }
		
//系统管理
        public function getShops(){                   //商品管理
            $rs=$this->user_model->getShops();
            echo json_encode($rs);  
        }

        public function getUsers(){                   //用户管理
            $rs=$this->user_model->getUsers();
            echo json_encode($rs);  
        }

        public function getOrders(){                   //订单管理
            $rs=$this->user_model->getOrders();
            foreach ($rs as $key) {
                $key->aaa=$this->user_model->getOrdersUser($key->uid); 
                $key->bbb=$this->user_model->getOrdersGoods($key->wid);
            }
            $arr['userAgoods']=$rs;
            echo json_encode($arr);  
        }
		
        public function deleteUsers(){              //删除用户
            $id = $this->input->post('id');
            $rs=$this->user_model->deleteUsers($id);
            echo json_encode($rs);
        }
        public function deleteOrders(){              //删除订单
            $id = $this->input->post('id');
            $rs=$this->user_model->deleteOrders($id);
            echo json_encode($rs);
        }
        public function deleteShops(){              //删除商品
            $id = $this->input->post('id');
            $rs=$this->user_model->deleteShops($id);
            echo json_encode($rs);
        }
        //商家模块
        public function show_per(){           //个人信息
            $bid = $this->input->post('id');
            $rows=$this->user_model->get_per($bid);
            $arr['per']=$rows;
            echo json_encode($arr);
        }
        public function changePer(){             //更改个人信息
            $bid = $this->input->post('bid');
            $bname = $this->input->post('bname');
            $bcity = $this->input->post('bcity');
            $btel = $this->input->post('btel');
            $rs = $this->user_model->changePer($bid,$bname,$bcity,$btel);
            echo json_encode($rs);
        }
        public function buys(){             //我的商品信息
            $bid = $this->input->post('id');
            $rs = $this->user_model->buys($bid);
            $arr['buys']=$rs;
            echo json_encode($arr);
        }
        public function upsGetGoods(){             //获取商品列表
            header('Access-Control-Allow-Origin:*');
            $rs=$this->user_model->upsGetGoods();
            $arr['goods']=$rs;
            echo json_encode($arr);  
        }
        public function upsGoods(){                          //上传商品
            header('Access-Control-Allow-Origin:*');   
            $bid = $this->input->post('bid');
             $cid = $this->input->post('cid');
            $wtitle = $this->input->post('wtitle');
            $wprice = $this->input->post('wprice');
            $wcon = $this->input->post('wcon');
            $kucun = $this->input->post('kucun');
            $wtime= date("Y-m-d");
            $file = $_FILES['file'];//得到传输的数据
            $name = $file['name'];//得到文件名称
            $type = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
            $allow_type = array('jpg','jpeg','gif','png'); //判断文件类型是否被允许上传
            if(!in_array($type, $allow_type)){//如果不被允许，则直接停止程序运行
                echo 'error1';
            }
            $upload_path = 'C:/xampp/htdocs/new/assets/uploads/'; //上传文件的存放路径//开始移动文件到相应的文件夹
            if(move_uploaded_file($file['tmp_name'],$upload_path.$file['name'])){
                $rs = $this->user_model->upsGoods($bid,$cid,$wtitle,$wprice,$wcon,$kucun,$name, $wtime);
                echo json_encode($rs);
            }else{
                echo 'error2';
            }
        }


    }
?>