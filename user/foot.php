
<script src="/assets/js/pjax.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/bower_components/jquery/dist/jquery.min.js"></script>
<!--script src="https://template.down.swap.wang/ui/angulr_2.0.1/bower_components/bootstrap/dist/js/bootstrap.js"></script!-->
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-load.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-jp.config.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-jp.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-nav.js"></script>
<script src="https://template.down.swap.wang/ui/angulr_2.0.1/html/js/ui-toggle.js"></script>
<script src="http://ie.swapteam.cn/ie.js"></script>
  <!-- / content -->
  <script>
		$(document).pjax('a[target!=_blank][pjax!=no][href!=#]', '#container', {fragment:'#container', timeout:5000});
		$(document).on('pjax:send', function() { //pjax链接点击后显示加载动画；
			$("#Loading").css("display", "block");
		});
		$(document).on('pjax:complete', function() { //pjax链接加载完成后隐藏加载动画；
			$("#Loading").css("display", "none");
window.prettyPrint && window.prettyPrint();
		});
	</script>

  <!-- footer -->
  <footer id="footer" class="app-footer" role="footer">
        <div class="wrapper b-t bg-light">
      <span class="pull-right">页面加载耗时：<?php $a = 0; for($i=0; $i<1000000; $i++){$a+=$i;} $runtime->stop(); echo $runtime->spent();?>毫秒</span>
    	Powered by <?php echo $conf['name']?> © 2017-2018 Copyright.
    </div>
  </footer>
  <!-- / footer -->
</div>
</div>
</body>
</html>