<!DOCTYPE html>
<html>
<head>
	<title>个人信息</title>
	<base href="<?php echo site_url(); ?>">
	<link rel="stylesheet" type="text/css" href="assets/css/common.css">
	<link rel="stylesheet" type="text/css" href="assets/css/index.css">
	<link rel="stylesheet" type="text/css" href="assets/css/personal.css">
	<link rel="stylesheet" type="text/css" href="assets/css/collect.css">
</head>
<body>
<div class="hmtop">
	<div class="hmtop-top">
		<div class="hmtop-left">
			<a href="user/show_personal"><?php echo $this->session->userdata('name')?></a>
			<a href="user/show_unindex">[注销]</a>
		</div>
		<div class="hmtop-right">
			<a href="user/show_index">商城首页</a>
			<a href="user/show_personal" class="person">个人中心</a>
			<a href="user/show_collect" class="person">收藏夹</a>
		</div>
	</div>
	<div class="wrap">
		<div class="logo">
			
		</div>
		<!-- 搜索框 -->
		<form  action="user/do_search" method="post" class="search">
			<input type="text" name="" id="input-search" placeholder="搜索">
			<input type="submit" name="" id="input-sub" value="搜  索" >
		</form>
	</div>
</div>
<div class="nav-table">
	<div class="nav-cont">
		<div class="nav-title">
			全部分类
		</div>
		<a href="user/show_index">商城首页</a>
	</div>
</div>
<div class="content">
	<ul class="content-nav">
		<li><a href="javascript:;" class="sheet sheet-title unline">个人中心</a></li>
		<li><a href="user/show_personal" class="sheet sheet-con ">个人信息</a></li>
		<li><a href="user/show_upload" class="sheet sheet-con">上传物品</a></li>
		<li><a href="user/show_mine" class="sheet sheet-con">个人物品</a></li>
		<li><a href="user/show_collect" class="sheet sheet-con">收藏夹</a></li>
		<li><a href="user/shopuser_personal" class="sheet sheet-con active">购买记录</a></li>	
	</ul>
	<div class="user-info1">
		<div class="user-title unline">
			<strong>购买记录</strong>
			<small>/ Purchase record</small>
		</div>
		<div class="goods">
			<?php
				foreach($goods as $a){
				?>
				<?php
					foreach($a->aaa as $aaa){
				?>
						<div class="goods-info">

							<div class="goods-pic">
								<a href="user/show_single?id=<?php echo $aaa->wid;?>"><img src="assets/uploads/<?php echo $aaa->wpic?>"></a>
							</div>
							<div class="goods-con">
								<p>标题：<?php echo $aaa->wtitle?></p>
								<p>价格：￥<?php echo $aaa->wprice?></p>
								<p>描述：<?php echo $aaa->wcon?></p>
								
							</div>
							<div class="goods-btn">
								<a href="user/do_delete_collect1?id=<?php echo $a->wid;?>">删除记录</a>
							</div>

						</div>
					<?php
				}
			?>
					<?php
				}
			?>
		</div>
	</div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/same.js"></script>

</body>
</html>