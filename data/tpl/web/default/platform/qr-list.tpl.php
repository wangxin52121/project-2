<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
	<ul class="nav nav-tabs">
		<li class="active"><a href="<?php  echo url('platform/qr/list');?>">管理二维码</a></li>
		<li><a href="<?php  echo url('platform/qr/post');?>">生成二维码</a></li>
		<li><a href="<?php  echo url('platform/qr/display');?>">扫描统计</a></li>
	</ul>
	<div class="panel panel-info">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<form action="./index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="platform">
			<input type="hidden" name="a" value="qr">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">公众号</label>
					<div class="col-sm-6 col-lg-8 col-xs-12">
						<select name="acid" class="form-control">
							<option value="" selected="selected">不限</option>
							<?php  if(is_array($acidarr)) { foreach($acidarr as $ac) { ?>
							<option value="<?php  echo $ac['acid'];?>"<?php  if($ac['acid'] == $_GPC['acid']) { ?> selected="selected"<?php  } ?> <?php  if($ac['level'] != 4) { ?>disabled<?php  } ?>><?php  echo $ac['name'];?> <?php  if($ac['level'] != 4) { ?>[权限不足]<?php  } ?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">场景名称</label>
					<div class="col-sm-6 col-lg-8 col-xs-12">
						<input type="text" name="keyword" class="form-control" placeholder="请输入场景名称">
					</div>
					<div class="pull-right col-xs-12 col-sm-3 col-lg-2">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="table-responsive panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:100px;">场景名称</th>
					<th style="width:100px;">关联关键字</th>
					<th style="width:100px;">所属公众号</th>
					<th style="width:100px;">二维码类型</th>
					<th style="width:100px;">过期时间</th>
					<th style="width:100px;">场景ID<i></i></th>
					<th style="width:80px;">二维码</th>
					<th style="width:100px;">生成时间</th>
					<th style="width:100px">到期时间</th>
					<th style="width:110px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $row) { ?>
				<tr>
					<td><a href="javascript:void(0);" title="<?php  echo $row['name'];?>"><?php  echo cutstr($row['name'], 8)?></a></td>
					<td><a href="javascript:void(0);" title="<?php  echo $row['keyword'];?>"><?php  echo cutstr($row['keyword'], 8)?></a></td>
					<td><?php  echo $row['uniname'];?></td>
					<td><?php  echo $row['modellabel'];?></td>
					<td><?php  echo $row['expire'];?></td>
					<td><?php  echo $row['qrcid'];?></td>
					<td><a href="<?php  echo $row['showurl'];?>" target="_blank">查看</a></td>
					<td style="font-size:12px; color:#666;">
					<?php  echo date('Y-m-d <br /> h:i:s', $row['createtime']);?>
					</td>
					<td style="font-size:12px; color:#666;">
					<?php  echo $row['endtime'];?>
					</td>
					<td>
					<?php  if($row['model'] == 2) { ?>
						<a href="<?php  echo url('platform/qr/del', array('id'=> $row['id']))?>" class="btn btn-default"
							data-toggle="tooltip" title="强制删除" onclick="return confirm('您确定要删除该二维码以及其统计数据吗？')"><i class="fa fa-times"></i>
						</a>
					<?php  } ?>
					<?php  if($row['model'] == 1) { ?><a href="<?php  echo url('platform/qr/extend', array('id'=> $row['id']))?>" class="btn btn-default" data-toggle="tooltip" title="延时"><i class="fa fa-clock-o"></i></a><?php  } ?>
					<a href="<?php  echo url('platform/qr/post', array('id'=> $row['id']))?>"class="btn btn-default" data-toggle="tooltip" data-placement="top" title="编辑"><i class="fa fa-pencil"></i></a>
					</td>
				</tr>
				<?php  } } ?>
				<tr class="search-submit">
					<td colspan="10">
						<a href="<?php  echo url('platform/qr/del', array('scgq'=> '1'))?>" onclick="javascript:return confirm('您确定要删除吗？\n将删除所有过期二维码以及其统计数据！！！')" class="btn btn-primary">删除全部已过期二维码</a>
						注意：永久二维码无法在微信平台删除，但是您可以点击<a href="javascript:;">【强制删除】</a>来删除本地数据。
					</td>
				</tr>
			</tbody>
		</table>
		<?php  echo $pager;?>
		</div>
	</div>
<script type="text/javascript">
	require(['bootstrap'],function($){
		$('.btn').hover(function(){
			$(this).tooltip('show');
		},function(){
			$(this).tooltip('hide');
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>