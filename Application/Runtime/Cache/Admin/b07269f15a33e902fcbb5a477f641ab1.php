<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加、编辑视频-后台管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
    <?php $addCss=""; $addJs=""; $currentNav ='视频管理 > 视频管理'; ?>
    <link rel="stylesheet" type="text/css" href="/9kd/Public/Min/?f=/9kd/Public/Admin/Css/base.css|/9kd/Public/Admin/Css/layout.css|/9kd/Public/Js/asyncbox/skins/default.css<?php echo ($addCss); ?>" />
<script type="text/javascript" src="/9kd/Public/Min/?f=/9kd/Public/Js/jquery-1.9.0.min.js|/9kd/Public/Js/jquery.lazyload.js|/9kd/Public/Js/functions.js|/9kd/Public/Admin/Js/base.js|/9kd/Public/Js/jquery.form.js|/9kd/Public/Js/asyncbox/asyncbox.js<?php echo ($addJs); ?>"></script>
    <style>
        div.spot {
            float: left;
            margin: 0 20px 0 0;
            width: 220px;
            min-height: 160px;
            border: 2px dashed #ddd;
        }
        .droparea {
            position: relative;
            text-align: center;
        }
        .droparea .instructions {
            opacity: 0.8;
            background-color: #cccccc;
            height: 25px;
            z-index: 10;
            zoom: 1;
            background-position: initial initial;
            background-repeat: initial initial;
            cursor: pointer;
        }
        .droparea div, .droparea input {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
        }
        .droparea input {
            cursor: pointer;
            opacity: 0;
        }
        .droparea div, .droparea input {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
        }
        #uparea1,#uparea2,#uparea3{
            height: 170px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="wrap">
    <div id="Top">
    <div class="logo"><a target="_blank" href="<?php echo ($site["WEB_ROOT"]); ?>"><img src="/9kd/Public/Admin/Img/logo.png" /></a></div>
    <div class="help"><a href="http://www.conist.com/bbs" target="_blank">使用帮助</a><span><a href="http://www.conist.com" target="_blank">关于</a></span></div>
    <div class="menu">
        <ul> <?php echo ($menu); ?> </ul>
    </div>
</div>
<div id="Tags">
    <div class="userPhoto"><img src="/9kd/Public/Admin/Img/userPhoto.jpg" /> </div>
    <div class="navArea">
        <div class="userInfo"><div><a href="<?php echo U('Webinfo/index');?>" class="sysSet"><span>&nbsp;</span>系统设置</a> <a href="<?php echo U("Public/loginOut");?>" class="loginOut"><span>&nbsp;</span>退出系统</a></div>欢迎您，<?php echo ($my_info["email"]); ?></div>
        <div class="nav"><font id="today"><?php echo date("Y-m-d H:i:s"); ?></font>您的位置：<?php echo ($currentNav); ?></div>
    </div>
</div>
<div class="clear"></div>
    <div class="mainBody">
        <div id="Left">
    <div id="control" class=""></div>
    <div class="subMenuList">
        <div class="itemTitle"><?php if(CONTROLLER_NAME == 'Index'): ?>常用操作<?php else: ?>子菜单<?php endif; ?> </div>
        <ul>
            <?php if(is_array($sub_menu)): foreach($sub_menu as $key=>$sv): ?><li><a href="<?php echo ($sv["url"]); ?>"><?php echo ($sv["title"]); ?></a></li><?php endforeach; endif; ?>
        </ul>
    </div>

</div>
        <div id="Right">
            <div class="Item hr">
                <div class="current">视频管理</div>
            </div>
            <form>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">

                    <?php if($site['SITE_INFO']['LANG_SWITCH_ON']=='1'){ ?>
                    <tr>
                        <th>语言选择：</th>
                        <td>
                            <select name="info[lang]">
                                <option value="zh-cn" <?php if($info['lang'] == 'zh-cn'): ?>selected<?php endif; ?> >简体中文</option>
                                <option value="en-us" <?php if($info['lang'] == 'en-us'): ?>selected<?php endif; ?> >English</option>
                                </volist>
                            </select></td>
                    </tr>
                    <?php } ?>

                    <tr>
                        <th width="100">文章标题：</th>
                        <td><input id="title" type="text" class="input" size="60" name="info[title]" value="<?php echo ($info["title"]); ?>"/> <a href="javascript:void(0)" id="checkPageTitle">检测是否重复</a></td>
                    </tr>
                    <tr>
                        <th width="100">文章发布状态：</th>
                        <td><label><input type="radio" name="info[status]" value="0" <?php if($info["status"] == 0): ?>checked="checked"<?php endif; ?> /> 文章审核状态</label> &nbsp; <label><input type="radio" name="info[status]" value="1" <?php if($info["status"] == 1): ?>checked="checked"<?php endif; ?> /> 文章已发布状态</label> </td>
                    </tr>
                    <tr>
                        <th>视频地址：</th>
                        <td><input type="text" class="input" size="40" name="info[url]" value="<?php echo ($info["url"]); ?>"/></td>
                    </tr>
                    <tr>
                        <th>文章图片：</th>
                        <td>
                            <?php if($img_info == null): ?><div kid="1" class="droparea spot" id="image1" style="background-image: url(<?php echo ($vo['savepath']); ?>);background-size: 220px 160px;" >
                                    <div class="instructions" onclick="del_image(1)">删除</div>
                                    <div id="uparea1" class="images_add"></div>
                                    <input type="hidden" name="image_1[]" id="image_1" value="<?php echo ($vo['savepath']); ?>" />
                                </div>
                                <?php else: endif; ?>
                            <?php if(is_array($img_info)): $i = 0; $__LIST__ = $img_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div kid="<?php echo ($i); ?>" class="droparea spot" id="image<?php echo ($i); ?>" style="background-image: url(<?php echo ($vo['savepath']); ?>);background-size: 220px 160px;" >
                                    <div class="instructions" onclick="del_image(<?php echo ($i); ?>)">删除</div>
                                    <div id="uparea<?php echo ($i); ?>" class="images_add"></div>
                                    <input type="hidden" name="image_1[]" id="image_<?php echo ($i); ?>" value="<?php echo ($vo['savepath']); ?>" />
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>

                            <div class="droparea spot" id="addimg" style="background-size: 220px 160px;">
                                <div class="instructions">添加新的图片栏</div>
                                <div style="font:180px/190px Arial;color: #999;cursor:pointer;">+</div>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <th>内容：</th>
                        <td><textarea id="content" class="" style="height: 300px; width: 80%;" name="info[content]"><?php echo ($info['content']); ?></textarea></td>
                    </tr>
                </table>
                <input type="hidden" name="info[id]" value="<?php echo ($info["id"]); ?>" />
            </form>
            <div class="commonBtnArea" >
                <button class="btn submit">提交</button>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<script type="text/javascript">
    $(window).resize(autoSize);
    $(function(){
        autoSize();
        $(".loginOut").click(function(){
            var url=$(this).attr("href");
            popup.confirm('你确定要退出吗？','你确定要退出吗',function(action){
                if(action == 'ok'){ window.location=url; }
            });
            return false;
        });

        var time=self.setInterval(function(){$("#today").html(date("Y-m-d H:i:s"));},1000);


    });

</script>
<script type="text/javascript" src="/9kd/Public/kindeditor/kindeditor.js"></script><script type="text/javascript" src="/9kd/Public/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
    $(function(){

        var  content ;
        KindEditor.ready(function(K) {
            content = K.create('#content',{
                allowFileManager : true,
                uploadJson:'/9kd/Public/kindeditor/php/upload_json.php?dirname=page'
            });
        });

        $("#checkPageTitle").click(function(){
            if($('#title').val()==''){
                popup.error('标题不能为空！');
                return false;
            }
            $.getJSON("/9kd/jkd/Video/checkPageTitle", { title:$("#title").val(),id:"<?php echo ($info["id"]); ?>"}, function(json){
                $("#checkPageTitle").css("color",json.status==1?"#0f0":"#f00").html(json.info);
            });
        });
        $("#checkPageUnique").click(function(){
            if($('#unique_id').val()==''){
                popup.error('不能为空！');
                return false;
            }
            $.getJSON("/9kd/jkd/Video/checkPageUnique", { title:$("#unique_id").val(),id:"<?php echo ($info["id"]); ?>"}, function(json){
                $("#checkPageUnique").css("color",json.status==1?"#0f0":"#f00").html(json.info);
            });
        });
        $(".submit").click(function(){
            content.sync();
            commonAjaxSubmit();
            return false;
        });
    });
</script>
<script>
    //添加新栏位
    $('#addimg').bind('click',function(){
        var kid = parseInt($(this).prev().attr('kid')) + parseInt(1);
        if(parseInt(($('.spot').length)) == 7){
            $(this).children().html('禁止添加新的图片栏').next().css({'color':'#f00','font-size':'150px'}).html('X');
        }
        if(parseInt(($('.spot').length)) > 7){

            popup.error('您不能再添加图片栏位,已超出上限！');
        }else{
            $(this).before($(this).prev().clone(true));
            $(this).prev().attr({'kid':kid,'id':'image'+kid,'style':"background-size: 220px 160px"}).children('.instructions').attr('onclick',"del_image('"+kid+"')").next().attr('id','uparea'+kid).next().attr({'name':'image_1[]','id':'image_'+kid,'value':""}).next().attr('value',kid);
        }
    });

    //删除图片
    function del_image(num){
        if(num == 1 || num == '1'){
            $('#image'+num).css('background-image','');
            $('#image_'+num).val('');
        }else{
            $('#image'+num).remove();
            if(parseInt(($('.spot').length)) == 7){
                $('#addimg').children().html('添加新的图片栏').next().css('color','#999').html('+');
            }
        }

    }
    KindEditor.ready(function(K) {
        var editor = K.editor({
            allowFileManager : true,
            uploadJson:'/9kd/Public/kindeditor/php/upload_json.php?dirname=page'
        });
        //触发添加图片
        $('.images_add').bind('click',function() {
            var imgs_id = $(this).parent().attr('kid');
            editor.loadPlugin('image', function() {
                editor.plugin.imageDialog({
                    imageUrl: K('#image_'+imgs_id).val(),
                    clickFn: function(url, title, width, height, border, align) {
                        $('#image'+imgs_id).css('background-image', 'url(' + url + ')').css('background-size', '220px 160px');
                        K('#image_'+imgs_id).val(url);
                        // K('#getImgUrl').val(url);
                        editor.hideDialog();
                    }
                });
            });
        });
    });
</script>
</script>
</script>
</body>
</html>