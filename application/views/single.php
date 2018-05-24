<!DOCTYPE html>
<html>
<head>
	<title>商品详情</title>
	<base href="<?php echo site_url(); ?>">
	<link rel="stylesheet" type="text/css" href="assets/css/index.css">
	<link rel="stylesheet" type="text/css" href="assets/css/common.css">
	<link rel="stylesheet" type="text/css" href="assets/css/single.css">
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
		<form class="search" action="user/do_search" method="post">
			<input type="text" name="" id="input-search" placeholder="搜索">
			<input type="submit" name="" id="input-sub" value="搜  索">
		</form>
	</div>
<div class="nav-table">
	<div class="nav-cont">
		<div class="nav-title">
			全部分类
		</div>
		<a href="user/show_index">商城首页</a>
	</div>
</div>
<div class="small">
	<a href="user/do_search" style="font-size: 16px;">搜索</a>
	<span style="color:#999;">/物品详情页</span>
</div>
<div class="single-content">
	<?php
		foreach($id as $i) {
			?>
			<img src="assets/uploads/<?php echo $i->wpic;?>">
			<div class="single-info">
				<div class="single-title">
					<?php echo $i->wtitle;?>
				</div>
				<div class="single-con">
					<span>卖家昵称：<?php echo $i->uname;?></span><br/>
					<span>卖家电话：<?php echo $i->utel;?></span><br/>
					<span>所在城市：<?php echo $i->name;?></span><br/>
					<span>价格：<span class="spc">￥<?php echo $i->wprice;?></span></span><br/>
					<span>商品描述：<?php echo $i->wcon;?></span>
				</div>
				<a href="user/do_collect?id=<?php echo $i->wid?>"  class="col">立即收藏</a>
			</div>
	
</div>
		<hr>
			<div class="user_pl">
			<h3 align="center">评论区</h3>
			<?php
				foreach ($pl as $pl) {
			?>
			<?php
				foreach ($pl->aaa as $pl1) {
			?>
			<span>评论人：</span>
			<span><?php echo $pl1->uname?></span><br>
			<?php
				}
			?>
			<span>评论时间：</span>
			<span><?php echo $pl->pltime?></span><br>
			<span>评论内容：</span>
			<span><?php echo $pl->plcont?></span><br>
			<br><br>
			<?php
				}
			?>
		</div>
		<hr>

		<div class="pl">
			<form action="<?php echo site_url("user/do_pl")?>" method='post'>
				<h3>点评：</h3>
				<input type="hidden" name="wid" value="<?php echo $i->wid?>" id="wid"/>
				<textarea name="pcont" id="pcont" cols="40" rows="8"></textarea>
				<input type="submit" id='p_btn' value="提交评论">
			</form>
		</div>
</div>
		<?php
		}
	?>
</body>
</html>