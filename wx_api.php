<?php
include('system/inc.php');
include('system/simple_html_dom.php');
error_reporting(0); 
define('TOKEN', $mkcms_token);
define('DOMAIN', $mkcms_domain);
define('GUANZHU', $mkcms_guanzhu);
define('CXURL', $mkcms_cxzy);
$wechatObj = new wechatCallbackapiTest();
if (isset($_GET['echostr'])) {
	$wechatObj->valid();
	}else{
	$wechatObj->responseMsg();
}
class wechatCallbackapiTest
{
//验证签名
public function valid()
{
header('content-type:text');   
ob_clean(); 
$echoStr = $_GET["echostr"];
$signature = $_GET["signature"];
$timestamp = $_GET["timestamp"];
$nonce = $_GET["nonce"];
$token = TOKEN;
$tmpArr = array($token, $timestamp, $nonce);
sort($tmpArr, SORT_STRING);
$tmpStr = implode($tmpArr);
$tmpStr = sha1($tmpStr);
if($tmpStr == $signature){
	echo $echoStr;
	exit;
	}
	}
//响应消息
public function responseMsg()
{
	$postStr = file_get_contents('php://input');
	if (!empty($postStr)){
		$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		$RX_TYPE = trim($postObj->MsgType);
			switch ($RX_TYPE)
			{
				case "event":
				$result = $this->receiveEvent($postObj);
				break;
				case "text":
				$result = $this->receiveText($postObj);
				break;
				case "image":
				$result = $this->receiveImage($postObj);
				break;
				case "voice":
				$result = $this->receiveVoice($postObj);
				break;
				default:
				$result = "unknown msg type: ".$RX_TYPE;
				break;
				}
				echo $result;
				}else {
					echo "";
					exit;
					}
					}
//接收事件消息
private function receiveEvent($object)
{
	$content = "";
	global $webname;
	switch ($object->Event)
	{
		case "subscribe":
		$content = GUANZHU;
		break;
		case "unsubscribe":
		$content = "取消关注";
		break;
		}
		if(is_array($content)){
			$result = $this->transmitNews($object, $content);
			}else{
				$result = $this->transmitText($object, $content);
				}
				return $result;
}
//接收文本消息
private function receiveText($object){
	$a = ($object->Content);
	$keyword = trim($a);
	$soword=urldecode($keyword);
	$surl='https://so.360kan.com/index.php?kw='.$keyword;
	$seach=fileget($surl,5); 
	$mxss='#<li data-logger=(.*?) class=\'w-mfigure\'><a class=\'w-mfigure-imglink g-playicon js-playicon\' href=\'(.*?)\'> <img src=\'(.*?)\' data-src=\'(.*?)\' alt=\'(.*?)\'  /><span class=\'w-mfigure-hintbg\'>(.*?)</span><span class=\'w-mfigure-hint\'>(.*?)</span></a><h4><a class=\'w-mfigure-title\' href=\'(.*?)\'>(.*?)</a>#';
	$data = json_decode(fileget(CXURL.'?wd='.$keyword,5), true);
	$ccb1 = DOMAIN."cxplay/".$data['data'][0]['vod_id'].".html";
	$ccb2 = DOMAIN."cxplay/".$data['data'][1]['vod_id'].".html";
	$ccb3 = DOMAIN."cxplay/".$data['data'][2]['vod_id'].".html";
	$ctitle=$data['data'][0]['vod_name'];
	$dtitle=$data['data'][1]['vod_name'];
	$etitle=$data['data'][2]['vod_name'];
	$szz1='#class="g-playicon js-playicon" title="(.*?)"#';//标题
	$szz6='#a href="(.*?)" class="g-playicon js-playicon"#';//链接
	$mxzl="#<dl class='w-star-intro'><dt>介绍：</dt><dd>(.*?)</dd></dl>#";//简介
	preg_match_all($szz1,$seach,$sarr1);
	preg_match_all($szz6,$seach,$sarr6);
	preg_match_all($mxss,$seach,$sarr4);
	preg_match_all($mxzl,$seach,$sarr5);
	$one=$sarr1[1];//标题
	$six=$sarr6[1];//链接
	$mingxing =$sarr4[2];
	$mingxing1 =$sarr4[4];
	$mingxing2 =$sarr5[1];
	$mxpic=$mingxing1[0];
	$mxinfo=$mingxing2[0];
	$title1=$one[0];
	$title2=$one[1];
	$mvsrc1 = str_replace("http://www.360kan.com", "", "$six[0]");
	$mvsrc2 = str_replace("http://www.360kan.com", "", "$six[1]");
	$mvsrc3 = str_replace("http://www.360kan.com", "", "$mingxing[0]");
	$chuandi=DOMAIN.'vod'.$mvsrc3;
	$href1 = DOMAIN.'vod'.$mvsrc1;
	$href2 = DOMAIN.'vod'.$mvsrc2;
	if (!empty($mxpic)){
	$txt1="".$keyword."简介：".$mxinfo."\r\n\n<a href='".$chuandi."'>点击播放<".$keyword.">的最新电影</a>\r\n\n";}
	if (!empty($title1)){
	$txt2="恭喜,成功找到视频,请点击播放：\r\n\n<a href='".$href1."'>《".$title1."》</a>\r\n\n";}
	if (!empty($title2)){
		if ($title1=""){
	$txt="恭喜,成功找到视频,请点击播放：\r\n\n";}
	$txt3="<a href='".$href2."'>《".$title2."》</a>\r\n\n";}
	if (!empty($ctitle)){
	$txt4="<a href='".$ccb1."'>《".$ctitle."》</a>\r\n\n";}
	if (!empty($dtitle)){
	$txt5="<a href='".$ccb2."'>《".$dtitle."》</a>\r\n\n";}
	if (!empty($etitle)){
	$txt6="<a href='".$ccb3."'>《".$etitle."》</a>\r\n\n";}
	if ((!empty($title1))||(!empty($title2))||(!empty($mxpic))){
	$arr = "".$txt1.$txt2.$txt.$txt3.$txt4.$txt5.$txt6."<a href='".DOMAIN."seacher-".$soword.".html'>点击查看<".$keyword.">的更多搜索结果</a>";
	}else{
	$arr = "您搜索的影片<".$keyword.">未找到！！<a href='".DOMAIN."'>点击进入官网</a>";}
		if (is_array($arr)) {
			if (isset($arr[0])) {
				$result = $this->transmitNews($object, $arr);
				}
				} else {
					$result = $this->transmitText($object, $arr);
					}
					return $result;
					}
//接收图片消息
private function receiveImage($object)
{
	$content = array("MediaId"=>$object->MediaId);
	$result = $this->transmitImage($object, $content);
	return $result;
	}
//回复文本消息
private function transmitText($object, $content)
{
	if (!isset($content) || empty($content)){
		return "";
		}
		$xmlTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[text]]></MsgType>
		<Content><![CDATA[%s]]></Content>
		</xml>";
		$result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);
		return $result;
}
//回复图文消息
private function transmitNews($object, $newsArray)
{
	if(!is_array($newsArray)){
		return "";
		}
		$itemTpl = "<item>
		<Title><![CDATA[%s]]></Title>
		<Description><![CDATA[%s]]></Description>
		<PicUrl><![CDATA[%s]]></PicUrl>
		<Url><![CDATA[%s]]></Url>
		</item>";
		$item_str = "";
		foreach ($newsArray as $item){
		$item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
		}
		$xmlTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[news]]></MsgType>
		<ArticleCount>%s</ArticleCount>
		<Articles>
		$item_str</Articles>
		</xml>";
		$result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
		return $result;
		}
//回复图片消息
private function transmitImage($object, $imageArray){
	$itemTpl = "<Image>
	<MediaId><![CDATA[%s]]></MediaId>
	</Image>";
	$item_str = sprintf($itemTpl, $imageArray['MediaId']);
	$xmlTpl = "<xml>
	<ToUserName><![CDATA[%s]]></ToUserName>
	<FromUserName><![CDATA[%s]]></FromUserName>
	<CreateTime>%s</CreateTime>
	<MsgType><![CDATA[image]]></MsgType>
	$item_str
	</xml>";$result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
	return $result;
	}
}
?>