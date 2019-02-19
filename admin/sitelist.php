<?php
include('../core/common.php');
$title = '影子管理';
if($conf['zid']!=1)sysmsg("<h4>你一个分站还想上天?想获取更高的权限，请联系主站管理员开启...</h4>",true);
include('./head.php');
if ($islogin!=1) {
    exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
echo '  <div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">搜索分站</h4>
      </div>
      <div class="modal-body">
      <form action="sitelist.php" method="GET">
<input type="text" class="form-control" name="kw" placeholder="请输入分站用户名或域名"><br/>
<input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
';
$my = (isset($_GET['my']) ? $_GET['my'] : NULL);
if ($my=='add') {
    echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">添加一个分站</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./sitelist.php?my=add_submit" method="POST">
<div class="form-group">
<label>管理员用户名:</label><br>
<input type="text" class="form-control" name="admin_user" value="admin" required>
</div>
<div class="form-group">
<label>管理员密码:</label><br>
<input type="text" class="form-control" name="admin_pwd" value="123456" required>
</div>
<div class="form-group">
<label>绑定域名:</label><br>
<input type="text" class="form-control" name="domain" value="" placeholder="分站要用的域名" required>
</div>
<div class="form-group">
<label>站点名称:</label><br>
<input type="text" class="form-control" name="sitename" value="" placeholder="站点的名称" required>
</div>
<div class="form-group">
<label>站点SEO1:</label><br>
<input type="text" class="form-control" name="keywords" value="" placeholder="站点的名称" required>
</div>
<div class="form-group">
<label>站点SEO2:</label><br>
<input type="text" class="form-control" name="description" value="" placeholder="站点的名称" required>
</div>
<div class="form-group">
<label>站长名称:</label><br>
<input type="text" class="form-control" name="name" value="">
</div>
<div class="form-group">
<label>站长QQ:</label><br>
<input type="text" class="form-control" name="qq" value="">
</div>
<div class="form-group">
<label>微信号:</label><br>
<input type="text" class="form-control" name="wx" value="">
</div>
<div class="form-group">
<label>交流QQ群:</label><br>
<input type="text" class="form-control" name="qqun" value="">
</div>
<div class="form-group">
<label>弹窗公告:</label><br>
<input type="text" class="form-control" name="modal" value="">
</div>
<div class="form-group">
<label>在线开通代收款/额度收款pid(只限本站):</label><br>
<input type="text" class="form-control" name="pid_pid" value="0" required>
</div>
<div class="form-group">
<label>在线开通代收款/额度收款key(只限本站):</label><br>
<input type="text" class="form-control" name="key_key" value="0" required>
</div>
<div class="form-group">
<label>到期时间:</label><br>
<input type="date" class="form-control" name="endtime" value="' . date('Y-m-d', strtotime('+1 years')) . '" required>
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定添加"></form>';
    echo '<br/><a href="./sitelist.php">>>返回分站列表</a>';
    echo '</div></div>';
} elseif ($my=='edit') {
    $zid = $_GET['zid'];
	$row =$DB->query("select * from pay_site where zid='{$zid}' limit 1")->fetch();
    echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改分站信息</h3></div>';
    echo '<div class="panel-body">';
    echo '<form action="./sitelist.php?my=edit_submit&zid=' . $zid . '" method="POST">
<div class="form-group">
<label>管理员用户名:</label><br>
<input type="text" class="form-control" name="admin_user" value="' . $row['admin_user'] . '" required>
</div>
<div class="form-group">
<label>管理员密码:</label><br>
<input type="text" class="form-control" name="admin_pwd" value="' . $row['admin_pwd'] . '" required>
</div>
<div class="form-group">
<label>绑定域名:</label><br>
<input type="text" class="form-control" name="domain" value="' . $row['domain'] . '" required>
</div>
<div class="form-group">
<label>站点名称:</label><br>
<input type="text" class="form-control" name="sitename" value="' . $row['sitename'] . '" required>
</div>
<div class="form-group">
<label>站点SEO1:</label><br>
<input type="text" class="form-control" name="keywords" value="' . $row['keywords'] . '">
</div>
<div class="form-group">
<label>站点SEO2:</label><br>
<input type="text" class="form-control" name="description" value="' . $row['description'] . '" placeholder="站点的名称" required>
</div>
<div class="form-group">
<label>站长名称:</label><br>
<input type="text" class="form-control" name="name" value="' . $row['name'] . '">
</div>
<div class="form-group">
<label>站长QQ:</label><br>
<input type="text" class="form-control" name="qq" value="' . $row['qq'] . '">
</div>
<div class="form-group">
<label>微信号:</label><br>
<input type="text" class="form-control" name="wx" value="' . $row['wx'] . '">
</div>
<div class="form-group">
<label>交流QQ群:</label><br>
<input type="text" class="form-control" name="qqun" value="' . $row['qqun'] . '">
</div>
<div class="form-group">
<label>弹窗公告:</label><br>
<input type="text" class="form-control" name="modal" value="' . $row['modal'] . '">
</div>
<div class="form-group">
<label>在线开通代收款/额度收款pid(只限本站):</label><br>
<input type="text" class="form-control" name="pid_pid" value="' . $row['pid_pid'] . '" required>
</div>
<div class="form-group">
<label>在线开通代收款/额度收款key(只限本站):</label><br>
<input type="text" class="form-control" name="key_key" value="' . $row['key_key'] . '" required>
</div>
<div class="form-group">
<label>到期时间:</label><br>
<input type="date" class="form-control" name="endtime" value="' . date('Y-m-d', strtotime($row['endtime'])) . '" required>
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定修改"></form>';
    echo '<br/><a href="./sitelist.php">>>返回分站列表</a>';
    echo '<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default")||0);
}
</script></div></div>';
} elseif ($my=='add_submit') {
    $admin_user = $_POST['admin_user'];
    $admin_pwd = $_POST['admin_pwd'];
    $domain = $_POST['domain'];
    $sitename = $_POST['sitename'];
    $keywords = $_POST['keywords'];
    $description = $_POST['description'];
    $name = $_POST['name'];
    $qq = $_POST['qq'];
    $qqun = $_POST['qqun'];
    $wx = $_POST['wx'];
    $modal = $_POST['modal'];
    $pid_pid = $_POST['pid_pid'];
    $key_key = $_POST['key_key'];
    $endtime = $_POST['endtime'];
    if ($admin_user==NULL || $admin_pwd==NULL || $domain==NULL || $endtime==NULL) {
        showmsg('保存错误,请确保每项都不为空!', 3);
    } else {
		$rows=$DB->query("select * from pay_site where admin_user='{$admin_user}' limit 1")->fetch();
        if($rows)showmsg('用户名已存在！', 3);
		$rows=$DB->query("select * from pay_site where domain='{$domain}' limit 1")->fetch();
        if ($rows) showmsg('域名已存在！', 3);
        $sql = "insert into `pay_site` (`admin_user`,`admin_pwd`,`domain`,`sitename`,`keywords`,`description`,`name`,`qq`,`qqun`,`wx`,`modal`,`pid_pid`,`key_key`,`endtime`,`addtime`) values ('".$admin_user."','".$admin_pwd."','".$domain."','".$sitename."','".$keywords."','".$description."','".$name."','".$qq."','".$qqun."','".$wx."','".$modal."','".$pid_pid."','".$key_key."','".$endtime."','".$date."')";
        if ($DB->exec($sql)) {
            showmsg('添加分站成功！<br/><br/><a href="./sitelist.php">>>返回分站列表</a>', 1);
        } else {
            showmsg('添加分站失败！' . $DB->error(), 4);
        }
    }
} elseif ($my=='edit_submit') {
    $zid = $_GET['zid'];
	$rows=$DB->query("select * from pay_site where zid='$zid' limit 1")->fetch();
    if (!$rows) {
        showmsg('当前记录不存在！', 3);
    }
    $admin_user = $_POST['admin_user'];
    $admin_pwd = $_POST['admin_pwd'];
    $domain = $_POST['domain'];
    $sitename = $_POST['sitename'];
    $keywords = $_POST['keywords'];
    $description = $_POST['description'];
    $name = $_POST['name'];
    $qq = $_POST['qq'];
    $qqun = $_POST['qqun'];
    $wx = $_POST['wx'];
    $modal = $_POST['modal'];
    $pid_pid = $_POST['pid_pid'];
    $key_key = $_POST['key_key'];
    $endtime = $_POST['endtime'];
	
		$rows=$DB->query("select * from pay_site where admin_user='{$admin_user}' limit 1")->fetch();
        if($rows&&$admin_user!=$rows['admin_user'])showmsg('用户名已存在！', 3);
		$rows=$DB->query("select * from pay_site where domain='{$domain}' limit 1")->fetch();
        if ($rows&&$domain!=$rows['domain']) showmsg('域名已存在！', 3);
		
    if ($admin_user==NULL || $admin_pwd==NULL || $domain==NULL || $endtime==NULL) {
        showmsg('保存错误,请确保每项都不为空!', 3);
    } elseif ($DB->query("update `pay_site` set `admin_user` ='{$admin_user}',`admin_pwd` ='{$admin_pwd}',`domain` ='{$domain}',`sitename` ='{$sitename}',`keywords` ='{$keywords}',`description` ='{$description}',`name` ='{$name}',`qq` ='{$qq}',`wx` ='{$wx}',`qqun` ='{$qqun}',`modal` ='{$modal}',`pid_pid` ='{$pid_pid}',`key_key` ='{$key_key}',`endtime` ='{$endtime}' where `zid`='{$zid}'")) {
        showmsg('修改分站成功！<br/><br/><a href="./sitelist.php">>>返回分站列表</a>', 1);
    } else {
        showmsg('修改分站失败！' . $DB->error(), 4);
    }
} elseif ($my=='delete') {
    $zid = $_GET['zid'];
    $sql = 'DELETE FROM pay_site WHERE zid=\'' . $zid . '\'';
	  if ($zid==1) showmsg('要是连主平台都可以删除，那还玩你妈的啊?', 3);
    if ($DB->query($sql)) {
        showmsg('删除成功！<br/><br/><a href="./sitelist.php">>>返回分站列表</a>', 1);
    } else {
        showmsg('删除失败！' . $DB->error(), 4);
    }
} else {
    $numrows = $DB->query('SELECT count(*) from pay_site')->rowCount();
    if (isset($_GET['zid'])) {
        $sql = ' zid=' . $_GET['zid'];
    } elseif (isset($_GET['power'])) {
        $sql = ' power=' . $_GET['power'];
    } elseif (isset($_GET['kw'])) {
        $sql = ' user=\'' . $_GET['kw'] . '\' or domain=\'' . $_GET['kw'] . '\' or domain2=\'' . $_GET['kw'] . '\' or qq=\'' . $_GET['kw'] . '\'';
    } else {
        $sql = ' 1';
    }
    $con = '系统共有 <b>' . $numrows . '</b> 个分站<br/><a href="./sitelist.php?my=add" class="btn btn-primary">添加分站</a>&nbsp;<a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>';
    echo '<div class="alert alert-info">';
    echo $con;
    echo '</div>';
    echo '      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ZID</th><th>站点名称/绑定域名</th><th>用户名</th><th>站长QQ号</th><th>开通/到期时间</th><th>操作</th></tr></thead>
          <tbody>
';
    $pagesize = 30;
    $pages = intval($numrows / $pagesize);
    if ($numrows % $pagesize) {
    }
    if (isset($_GET['page'])) {
        $page = intval($_GET['page']);
    } else {
        $page = 1;
    }
    $offset = $pagesize * ($page - 1);
    //$rs = $DB->query('SELECT * FROM pay_site WHERE' . $sql . ' order by zid desc limit ' . $offset . ',' . $pagesize);;
	$rs=$DB->query("SELECT * FROM pay_site WHERE{$sql} order by zid desc limit $offset,$pagesize");
    while($res = $rs->fetch()) {
        echo '<tr>
		<td><b>' . $res['zid'] . '</b></td>
		<td>' . $res['sitename'] . '<br/>' . $res['domain'] . '</td>
		<td>' . $res['admin_user'] . '</td>
		<td>' . $res['qq'] . '</td>
		<td>' . $res['addtime'] . '<br/>' . $res['endtime'] . '</td>
		<td><a href="./sitelist.php?my=edit&zid=' . $res['zid'] . '" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./sitelist.php?my=delete&zid=' . $res['zid'] . '" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此站点吗？\');">删除</a></td>
		</tr>';
    }
}
echo '          </tbody>
        </table>
      </div>
';
echo '<ul class="pagination">';
$first = 1;
$prev = $page - 1;
$next = $page + 1;
$last = $pages;
if ($page > 1) {
    echo '<li><a href="sitelist.php?page=' . $first . $link . '">首页</a></li>';
    echo '<li><a href="sitelist.php?page=' . $prev . $link . '">&laquo;</a></li>';
} else {
    echo '<li class="disabled"><a>首页</a></li>';
    echo '<li class="disabled"><a>&laquo;</a></li>';
}
$i = 1;
while ($i < $page) {
    echo '<li><a href="sitelist.php?page=' . $i . $link . '">' . $i . '</a></li>';
}
echo '<li class="disabled"><a>' . $page . '</a></li>';
if ($pages >= 10) {
    $s = 10;
} else {
    $s = $pages;
}
$i = $page + 1;
while ($i <= $s) {
    echo '<li><a href="sitelist.php?page=' . $i . $link . '">' . $i . '</a></li>';
}
echo '';
if ($page < $pages) {
    echo '<li><a href="sitelist.php?page=' . $next . $link . '">&raquo;</a></li>';
    echo '<li><a href="sitelist.php?page=' . $last . $link . '">尾页</a></li>';
} else {
    echo '<li class="disabled"><a>&raquo;</a></li>';
    echo '<li class="disabled"><a>尾页</a></li>';
}
echo '</ul>';
echo ' </div>';
?>