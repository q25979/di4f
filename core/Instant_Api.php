<?php 
// +----------------------------------------------------------------------
// | Quotes [ 只为给用户更好的体验]***[即时到账云端连接函数Api]
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 零度  
// +----------------------------------------------------------------------
// | Date: 2018年01月24日
// +----------------------------------------------------------------------

class Instant_Api {
    protected $Api_url 	= null;
    protected $Api_pid = null;
    protected $Api_key = null;
    function __construct($Api_url = 'http://www.qqmzz.cn/',$Api_pid = null,$Api_key = null)
    {
        $this->Apikey	= 1234567890;//接口对接密钥
        $this->Api_url 	= $Api_url;
        $this->Api_pid  = $Api_pid;
        $this->Api_key  = $Api_key;
    }
    
    
    /**
     * 获取即时到帐云端资料
	 * 提交参数:pid,key,是否记录pid key缓存 1则记录0则不记录,软件登录状态识标
     */
    function Query($pid,$key,$is_login,$login)
    {
		if($login){
		$Arrs = array("act" =>'query',"apikey" =>$this->Apikey,"pid" =>$this->Api_pid,"key" =>$this->Api_key,"login" =>$login);
		}elseif($pid && $key){
        $Arrs = array("act" =>'query',"apikey" =>$this->Apikey,"pid" =>$pid,"key" =>$key);
		}else{
		$Arrs = array("act" =>'query',"apikey" =>$this->Apikey,"pid" =>$this->Api_pid,"key" =>$this->Api_key);
		}
		if($_SESSION['Query_X']){
			$json = $_SESSION['Query'];
		}else{
			$data = $this->get_curl($this->Api_url.'api/instant_api.php?',http_build_query($Arrs));
			$json = json_decode($data,true);
			$_SESSION['Query'] = $json;
		}
			if($pid&&$key&&$is_login&&$json['code']==1){
				setcookie("user_token", md5($pid.$key), time() + 10800, '/');
				$_SESSION['Query_pid'] = $pid;
				$_SESSION['Query_key'] = $key;
			}
		return $json;
    }  
    
    
    /**
     * 修改资料
	 * 提交参数:新的key,新绑定QQ
     */
    function Change($newkey,$qq,$outtime,$repeat)
    {
		$Arrs = array("act" =>'change',"apikey" =>$this->Apikey,"pid" =>$this->Api_pid,"key" =>$this->Api_key,"newkey" =>$newkey,"qq" =>$qq,"outtime" =>$outtime,"repeat" =>$repeat);
        $data = $this->get_curl($this->Api_url.'api/instant_api.php?',http_build_query($Arrs));
        $json = json_decode($data,true);
		return $json;
    }    
    
    /**
     * 注册商户
	 * 提交参数:pid,key,绑定QQ
     */
    function Reg($pid,$key,$qq)
    {
        $Arrs = array("act" =>'reg',"apikey" =>$this->Apikey,"pid" =>$pid,"key" =>$key,"qq" =>$qq);
        $data = $this->get_curl($this->Api_url.'api/instant_api.php?',http_build_query($Arrs));
        $json = json_decode($data,true);
		return $json;
    }   
    
    /**
     * 绑定QQ找回商户pid,key
	 * 提交参数:qq
     */
    function FindPidKey($qq)
    {
        $Arrs = array("act" =>'findpidkey',"apikey" =>$this->Apikey,"qq" =>$qq);
        $data = $this->get_curl($this->Api_url.'api/instant_api.php?',http_build_query($Arrs));
        $json = json_decode($data,true);
		return $json;			
    }   
    
    /**
     * 找回商户key
	 * 提交参数:pid
     */
    function Find($pid)
    {
        $Arrs = array("act" =>'find',"apikey" =>$this->Apikey,"pid" =>$pid);
        $data = $this->get_curl($this->Api_url.'api/instant_api.php?',http_build_query($Arrs));
        $json = json_decode($data,true);
		return $json;			
    }   
    
    /**
     * 充值额度
	 * 提交参数:paymb 要充值多少 默认1000
     */
    function Paymb($paymb = 1000,$pid=NULl,$key=NULL)
    {
		if($pid && $key){
        $Arrs = array("act" =>'paymb',"apikey" =>$this->Apikey,"pid" =>$pid,"key" =>$key,"paymb" =>$paymb);
		}else{
        $Arrs = array("act" =>'paymb',"apikey" =>$this->Apikey,"pid" =>$this->Api_pid,"key" =>$this->Api_key,"paymb" =>$paymb);
		}
        $data = $this->get_curl($this->Api_url.'api/instant_api.php?',http_build_query($Arrs));
        $json = json_decode($data,true);
		return $json;			
    }       
    
    /**
     * 查询订单
	 * 提交参数:订单号
     */
    function Order($out_trade_no)
    {
        $Arrs = array("act" =>'order',"apikey" =>$this->Apikey,"out_trade_no" =>$out_trade_no);
        $data = $this->get_curl($this->Api_url.'api/instant_api.php?',http_build_query($Arrs));
        $json = json_decode($data,true);
		return $json;			
    } 
    
    /**
     * 获取订单列表
	 * 提交参数:输入条数,默认最新30条
     */
    function Orders($limit = 30)
    {
		
		$Arrs = array("act" =>'orders',"apikey" =>$this->Apikey,"pid" =>$this->Api_pid,"key" =>$this->Api_key,"limit" =>$limit);
		$get = 'api/instant_api.php?'.http_build_query($Arrs);
		$data = $this->get_curl($this->Api_url.$get);
		$json = json_decode($data,true);
		return $json;		
    }   
    
    /**
     * 获取订单
	 * 提交参数:商户订单,用户ID
     */
    function Submit_order($pid,$out_trade_no,$trade_no)
    {
        $Arrs = array("act" =>'submit_order',"apikey" =>$this->Apikey,"pid" =>$pid,"out_trade_no" =>$out_trade_no,"trade_no" =>$trade_no);
        $data = $this->get_curl($this->Api_url.'api/instant_api.php?',http_build_query($Arrs));
        $json = json_decode($data,true);
		return $json;			
    }    
    
    /**
     * 记录订单
	 * 提交参数:PID,用户ID,付款超时 单位：秒,云支付订单号,商户订单号,异步通知地址,支付方式,名称,金额
     */
    function Submit($pid,$key,$pay_id,$outtime,$trade_no,$out_trade_no,$notify_url,$type,$name,$money,$sign)
    {
        $Arrs = array("act" =>'submit',"apikey" =>$this->Apikey,"pid" =>$pid,"key" =>$key,"pay_id" =>$pay_id,"outtime" =>$outtime,"trade_no" =>$trade_no,"out_trade_no" =>$out_trade_no,"notify_url" =>$notify_url,"type" =>$type,"name" =>$name,"money" =>$money,"sign" =>$sign);
        $data = $this->get_curl($this->Api_url.'api/instant_api.php?',http_build_query($Arrs));
        $json = json_decode($data,true);
		return $json;			
    }    
    
    /**
     * 发起通知
	 * 提交参数:支付方式,金额,PID,KEY
     */
    function Submit_submit($type,$money,$pid=NULl,$key=NULL)
    {
		if($pid && $key){
        $Arrs = array("act" =>'submit_submit',"apikey" =>$this->Apikey,"pid" =>$pid,"key" =>$key,"type" =>$type,"money" =>$money);
		}else{
        $Arrs = array("act" =>'submit_submit',"apikey" =>$this->Apikey,"pid" =>$this->Api_pid,"key" =>$this->Api_key,"type" =>$type,"money" =>$money);
		}
        $data = $this->get_curl($this->Api_url.'api/instant_api.php?',http_build_query($Arrs));
		return $data;			
    }     
    
    /**
     * 补单
	 * 提交参数:商户订单号,云支付订单,PID,KEY
     */
    function Submit_status($out_trade_no,$trade_no,$pid=NULl,$key=NULL)
    {
		if($pid && $key){
        $Arrs = array("act" =>'submit_status',"apikey" =>$this->Apikey,"pid" =>$pid,"key" =>$key,"out_trade_no" =>$out_trade_no,"trade_no" =>$trade_no);
		}else{
        $Arrs = array("act" =>'submit_status',"apikey" =>$this->Apikey,"pid" =>$this->Api_pid,"key" =>$this->Api_key,"out_trade_no" =>$out_trade_no,"trade_no" =>$trade_no);
		}
        $data = $this->get_curl($this->Api_url.'api/instant_api.php?',http_build_query($Arrs));
        $json = json_decode($data,true);
		if($json['code']!=-1)
			$arraydata['code']=1;
		else
			$arraydata['code']=-1;
		
		return $arraydata;
		
    }    

    protected  function get_curl($url, $post = 0, $referer = 0, $cookie = 0, $header = 0, $ua = 0, $nobaody = 0)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $klsf[] = "Accept:*";
        $klsf[] = "Accept-Encoding:gzip,deflate,sdch";
        $klsf[] = "Accept-Language:zh-CN,zh;q=0.8";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $klsf);
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        if ($header) {
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
        }
        if ($cookie) {
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        }
        if ($referer) {
            if ($referer == 1) {
                curl_setopt($ch, CURLOPT_REFERER, "http://m.qzone.com/infocenter?g_f=");
            } else {
                curl_setopt($ch, CURLOPT_REFERER, $referer);
            }
        }
        if ($ua) {
            curl_setopt($ch, CURLOPT_pidAGENT, $ua);
        } else {
            curl_setopt($ch, CURLOPT_pidAGENT, ' Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36');
        }
        if ($nobaody) {
            curl_setopt($ch, CURLOPT_NOBODY, 1);//主要头部
            //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);//跟随重定向
        }
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $ret = curl_exec($ch);
        curl_close($ch);
        return $ret;
    
    }
}
?>