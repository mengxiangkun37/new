<?php  defined('BASEPATH') OR exit('No direct script access allowed');
    class User_model extends CI_Model{
        public function do_login($a,$b){                    //用户登录
            $arr=array(
                'uemail'=>$a,
                'upass'=>$b,
            );
            $query=$this->db->get_where('user',$arr);
            return $query->row();
        }
        public function businessLogin($a,$b){                    //商家登录
            $arr=array(
                'bemail'=>$a,
                'bpass'=>$b,
            );
            $query=$this->db->get_where('business',$arr);
            return $query->row();
        }
        public function adminLogin($a,$b){                    //管理员登录
            $arr=array(
                'gname'=>$a,
                'gpass'=>$b,
            );
            $query=$this->db->get_where('admin',$arr);
            return $query->row();
        }
        public function get_check($name){                    //注册查重
            $query=$this->db->get_where('user',array('uemail'=>$name));
            return $query->row();
        }
        public function get_check1($name){                    //商家注册查重
            $query=$this->db->get_where('business',array('bemail'=>$name));
            return $query->row();
        }
        public function home_catalog(){
            $query=$this->db->get('catalog');
            return $query->result();
        }
        public function home_cata(){
            $query=$this->db->get('cata');
            return $query->result();
        }
        public function home_catas($id){
            $query=$this->db->get_where('catalog',array("ccid"=>$id));
            return $query->result();
        }
        public function set_insert($name,$pass){        //注册
            $arr=array(
                'uemail'=>$name,
                'upass'=>$pass,
            );
            $query=$this->db->insert('user',$arr);
            return $query;
        }
        public function set_insert1($name,$pass){        //商家注册
            $arr=array(
                'bemail'=>$name,
                'bpass'=>$pass,
            );
            $query=$this->db->insert('business',$arr);
            return $query;
        }
        public  function  get_search_id($id){
            $query=$this->db->get_where('catalog',array('cid'=>$id));
            return $query->row();
        }
        public function get_all($uid){
            $query=$this->db->get_where('user',array('uid'=>$uid));
            return $query->row();
        }
        public function delete($wid){
            $this->db->where('wid',$wid);
            $query=$this->db->delete('goods');
            return $query;
        }
        public function update($wid){
            $query = $this->db->get_where("goods",array('wid'=>$wid));
            return $query->result();
        }
        public function get_id($id){
            $query = $this->db->get_where("goods",array('wid'=>$id));
            return $query->row();
        }
        public function get_title($search){
            $this->db->like('wtitle',$search);
            $query=$this->db->get('goods');
            return $query->result();
        }
        public function get_data1($id){        // 价格排序
            $this->db->order_by('wprice','DESC');
            $query=$this->db->get_where('goods',array('cid'=>$id));
            return $query->result();
        }
        public function get_data2($id){        //价格排序
            $this->db->order_by('wprice','ASC');
            $query=$this->db->get_where('goods',array('cid'=>$id));
            return $query->result();
        }
        public function getGoodsByShows($id){  //销量排序
            $this->db->order_by('shows','DESC');
            $query=$this->db->get_where('goods',array('cid'=>$id));
            return $query->result();
        }
        public function getGoodsByTime($id){  //时间排序
            $this->db->order_by('wtime','DESC');
            $query=$this->db->get_where('goods',array('cid'=>$id));
            return $query->result();
        }
        public function get_allrows($id){
            $query=$this->db->get_where('goods',array('cid'=>$id));
            return $query->result();
        }
        public function doBuyUpdateGoods($wid,$nums){          //购买时更新库存和销量
            $this->db->set('shows', "shows+'$nums'",FALSE);
            $this->db->set('kucun', "kucun-'$nums'",FALSE);
            $this->db->where('wid',$wid);
            $query=$this->db->update('goods');
            return $query;
        }
        public function doBuy($wid,$uid,$nums,$btime){          //购买
            $arr=array(
                'wid'=>$wid,
                'uid'=>$uid,
                'nums'=>$nums,
                'buytime'=>$btime
            );
            $result = $this->db->insert('buy',$arr);
            return $result;
        }

        public function check_collect($wid,$uid){             //查询购物车表
            $arr=array( 
                'wid'=>$wid,
                'uid'=>$uid
            );
            $query = $this->db->get_where('collect',$arr);
            return $query->row();
        }
        public function updateCollect($wid,$uid,$cnums,$ctime){   
             $arr2=array(
                'wid'=>$wid,
                'uid'=>$uid
             );
             $arr3=array(
                'cnums'=>$cnums,
                'ctime'=>$ctime
             );
            $this->db->where($arr2);
            $result=$this->db->update('collect',$arr3);
            return $result;
        }     

        public function doAdd($wid,$uid,$cnums,$ctime){          //添加购物车
            $arr=array(
                'wid'=>$wid,
                'uid'=>$uid,
                'cnums'=>$cnums,
                'ctime'=>$ctime
            );
            $result = $this->db->insert('collect',$arr); 
            return $result;
        }
        public function userPl($wid,$uid,$plcont,$pltime){       //评论
            $arr=array(
                'wid'=>$wid,
                'uid'=>$uid,
                'plcont'=>$plcont,
                'pltime'=>$pltime,
            );
            $query = $this->db->insert('pl',$arr);
            return $query;
         }
         public function changePersonal($uid,$uname,$usex,$ubirth,$utel){   //个人信息更改个人信息
            $arr=array(
                'uname'=>$uname,
                'usex'=>$usex,
                'ubirth'=>$ubirth,
                'utel'=>$utel
            );
            $this->db->where('uid',$uid);
            $query=$this->db->update('user',$arr);
            return $query;
        }
		  
        public function getCollection($uid){                //个人信息中购物车
            $query = $this->db->get_where('collect',array('uid'=>$uid));
            return $query->result();
        }

        public function getCollectionGoods($wid){         //个人信息中购物车链表物品
            $query = $this->db->get_where('goods',array('wid'=>$wid));
            return $query->result();
        }

        public function deleteCollection($id){                //个人信息删除购物车
            $this->db->where('collect_id',$id);
            $query=$this->db->delete('collect');
            return $query;
        }

        public function getBuyinfo($uid){                //个人信息中购买记录
            $query = $this->db->get_where('buy',array('uid'=>$uid));
            return $query->result();
        }

        public function getBuyinfoGoods($wid){         //个人信息中购买记录链表物品
            $query = $this->db->get_where('goods',array('wid'=>$wid));
            return $query->result();
        }

        public function deleteBuyInfo($id){                //个人信息删除购买记录
            $this->db->where('buyid',$id);
            $query=$this->db->delete('buy');
            return $query;
        }

		public function get_pl($id){
			$query = $this->db->get_where('pl',array('wid'=>$id));
			return $query->result();
		}
		public function get_pl_user($uid){
			$query=$this->db->get_where('user',array("uid"=>$uid));
			return $query->result();
		}

        public function showIndexGoods(){ //首页商品展示
           	$this->db->limit(8);
			$this->db->order_by('shows','DESC');
			$query=$this->db->get('goods');
			return $query->result();
        }


//系统管理
        
        public function getShops(){                     //商品管理
            $query=$this->db->get('goods');
            return $query->result();
        }      

        public function getUsers(){                     //用户管理
            $query=$this->db->get('user');
            return $query->result();
        }    

        public function getOrders(){                     //订单管理
            $query=$this->db->get('buy');
            return $query->result();
        }  
        public function getOrdersUser($uid){                     //订单管理
            $query=$this->db->get_where('user',array("uid"=>$uid));
            return $query->row();
        }  
        public function getOrdersGoods($wid){                     //订单管理
            $query=$this->db->get_where('goods',array("wid"=>$wid));
            return $query->row();
        }  

        public function deleteUsers($id){                //删除用户
            $this->db->where('uid',$id);
            $query=$this->db->delete('user');
            return $query;
        }

        public function deleteOrders($id){                //删除订单
            $this->db->where('buyid',$id);
            $query=$this->db->delete('buy');
            return $query;
        }

        public function deleteShops($id){                //删除商品
            $this->db->where('wid',$id);
            $query=$this->db->delete('goods');
            return $query;
        }
//商家模块
        public function get_per($bid){
            $query=$this->db->get_where('business',array('bid'=>$bid));
            return $query->row();
        }
        public function changePer($bid,$bname,$bcity,$btel){   //个人信息更改个人信息
            $arr=array(
                'bname'=>$bname,
                'bcity'=>$bcity,
                'btel'=>$btel
            );
            $this->db->where('bid',$bid);
            $query=$this->db->update('business',$arr);
            return $query;
        }
        public function buys($bid){             //我的商品信息
            $query=$this->db->get_where('goods',array('bid'=>$bid));
            return $query->result();
        }
        public function upsGetGoods(){             //获取商品列表
            $query=$this->db->get('catalog');
            return $query->result();
        }

        public function upsGoods($bid,$cid,$wtitle,$wprice,$wcon,$kucun,$name,$wtime){ //上传商品
            $arr=array(
                'wtitle'=>$wtitle,
                'wcon'=>$wcon,
                'kucun'=>$kucun,
                'wprice'=>$wprice,
                'wcon'=>$wcon,
                'wpic'=>$name,
                'bid'=>$bid,
                'cid'=>$cid,
                'wtime'=> $wtime
            );
            $query = $this->db->insert('goods',$arr);
            return $query;
        }


    }
?>