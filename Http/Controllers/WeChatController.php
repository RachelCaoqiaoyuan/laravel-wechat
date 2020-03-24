<?php

namespace Rachelcaoqiaoyuan\Wechat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WeChatController extends Controller
{
    public function index(Request $request)
    {
                //接收
                $postObj = file_get_contents('php://input');
                $postArr = simplexml_load_string($postObj, "SimpleXMLElement", LIBXML_NOCDATA);
                //回复
                $content = $postArr->Content;
                $toUserName = $postArr->ToUserName;
                $fromUserName = $postArr->FromUserName;
                $time = time();
                $content = "你好，你的消息是： $content";
                $info = sprintf('<xml>
 <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
   <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[text]]></MsgType>
     <Content><![CDATA[%s]]></Content>
      </xml>', $fromUserName, $toUserName, $time, $content);
                return $info;

//secret:435fdcc8543e280d3aec5ac284996010
//微信公众号绑定

    }
}
