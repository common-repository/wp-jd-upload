<?php
/*
Plugin Name: WP-JD_upload
Plugin URI: http://www.waisir.com
Description: 此插件用于WordPress后台发布文章页面，可直接上传文件到"即得网盘http://good.gd/"并返回外链地址.
Version: 1.1
Author: 歪SIR
Author URI: http://www.waisir.com
*/

function wp_jdupload_init(){
	$jd_userid = get_option("wp_jd_userid");
    if($jd_userid == ""){
		update_option("wp_jd_userid","78009");
	}
	
	echo '<br/><div id="jd_upload_div" class="meta-box-sortables ui-sortable" style="position: relative;"><br/><div class="postbox">';
	echo '<div class="handlediv" title="Click to toggle"><br />';
	echo '</div>';
	echo '<h3 class="hndle"><span>即得网盘插件</span></h3>';
	echo '<div class="inside">
	<style type="text/css">
#GoodInterface{}
</style>

<div id="GoodInterface">
<div id="GoodInitDiv">
<a href="javascript:ShowGoodInterface();">点这里上传文件</a>
</div>
</div>

<script type="text/javascript">
var GoodInputName = "'. get_option("wp_jd_userid") .'";
var GoodDataTemplate= "\r文件名：#name\r文件大小：#size\r下载地址：#url";
</script>

<script type="text/JavaScript" src="http://api.good.gd/js/uploadInterface-multi.js"></script>

	';
	
	echo '</div></div></div>';
	echo '<script>document.getElementById("postdivrich").appendChild(document.getElementById("jd_upload_div"));</script>';
        }
		
		

		
function wp_jdupload_options(){
	$message='即得用户上传ID更新成功';
	if($_POST['update_jd_option']){
		$wp_jd_user_saved = get_option("wp_jd_userid");
		$wp_jd_user = $_POST['wp_jd_user_option'];
		if ($wp_jd_user_saved != $wp_jd_user)
			if(!update_option("wp_jd_userid",$wp_jd_user)){
				$message='即得用户上传ID更新失败';
			}else{
				$message='即得用户上传ID更新成功';
			}
		echo '<div class="updated"><strong><p>'. $message . '</p></strong></div>';
	}

?>



<div class=wrap>
	<form method="post" action="">
		<h2>即得分享网盘上传插件For WordPress </h2>
		<br>
		<fieldset name="wp_basic_options"  class="options">
		<table>
			<tr>
                <td valign="top" width ="270" align="left">输入网页中用于发表内容的文本框ID:</td>
				<td><input type="text" width ="150px" name="wp_jd_user_option" value="<?php echo get_option("wp_jd_userid");  ?>" /></td>
                <td width ="250px" ><a style ="text-decoration: none;margin-left:15px" href ="http://api.good.gd/CreateCode_MultiFile.aspx" target ="_blank">即得API生成页面</a></td>
			</tr>
           <tr>
                <td  colspan="3" valign="top"  align="center">&nbsp;</td>
		  </tr>
		</table>			
	  </fieldset>
		<p class="submit"><input type="submit" name="update_jd_option" value="更新设置 &raquo;" /></p>
  </form>
</div>



<?php
}


function wp_jd_upload_options_admin(){
	if (function_exists('add_options_page')) { 
		add_options_page('JD_upload', '即得网盘插件', 3,  basename(__FILE__), 'wp_jdupload_options');
	}
}

add_action('admin_menu', 'wp_jd_upload_options_admin');		
add_action('dbx_post_sidebar','wp_jdupload_init');
?>
