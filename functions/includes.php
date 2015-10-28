<?php

include_once 'rcl_activate.php';

function rcl_buttons(){
    global $user_LK; $content = '';
    echo apply_filters( 'the_button_wprecall', $content, $user_LK );
}

function rcl_tabs(){
    global $user_LK; $content = '';
    echo apply_filters( 'the_block_wprecall', $content, $user_LK);
}

function rcl_before(){
    global $user_LK; $content = '';
    echo apply_filters( 'rcl_before_lk', $content, $user_LK );
}

function rcl_after(){
    global $user_LK; $content = '';
    echo apply_filters( 'rcl_after_lk', $content, $user_LK );
}

function rcl_header(){
    global $user_LK; $content = '';
    echo apply_filters('rcl_header_lk',$content,$user_LK);
}

function rcl_sidebar(){
    global $user_LK; $content = '';
    echo apply_filters('rcl_sidebar_lk',$content,$user_LK);
}

function rcl_content(){
    global $user_LK; $content = '';
    $content = apply_filters('rcl_content_lk',$content,$user_LK);
    echo $content;
}

function rcl_footer(){
    global $user_LK; $content = '';
    echo apply_filters('rcl_footer_lk',$content,$user_LK);
}

function rcl_action(){
    global $rcl_userlk_action;
    $last_action = rcl_get_useraction($rcl_userlk_action);
    $class = (!$last_action)? 'online': 'offline';
    $status = '<div class="status_user '.$class.'"><i class="fa fa-circle"></i></div>';
    if($last_action) $status .= __('not online','rcl').' '.$last_action;
    echo $status;
}

function rcl_avatar($size=120){
    global $user_LK; $after='';
    echo '<div id="rcl-contayner-avatar">';
	echo '<span class="rcl-user-avatar">'.get_avatar($user_LK,$size).'</span>';
	echo apply_filters('after-avatar-rcl',$after,$user_LK);
	echo '</div>';

}

function rcl_status_desc(){
    global $user_LK;
    $desc = get_the_author_meta('description',$user_LK);
    if($desc) echo '<div class="ballun-status">'
        //. '<span class="ballun"></span>'
        . '<p class="status-user-rcl">'.nl2br(esc_textarea($desc)).'</p>'
        . '</div>';
}

function rcl_username(){
    global $user_LK;
    echo get_the_author_meta('display_name',$user_LK);
}

function rcl_notice(){
    $notify = '';
    $notify = apply_filters('notify_lk',$notify);
    if($notify) echo '<div class="notify-lk">'.$notify.'</div>';
}

function rcl_addon_url($file,$path){
    if(function_exists('wp_normalize_path')) $path = wp_normalize_path($path);
    $array = explode('/',$path);
    $url = '';
	$content_dir = basename(content_url());
    foreach($array as $key=>$ar){
        if($array[$key]==$content_dir){
            $url = get_bloginfo('wpurl').'/'.$array[$key].'/';
            continue;
        }
        if($url){
            $url .= $ar.'/';
            if($array[$key-1]=='add-on') break;
        }
    }
    $url .= $file;
    return $url;
}

function rcl_addon_path($path){
    if(function_exists('wp_normalize_path')) $path = wp_normalize_path($path);
    $array = explode('/',$path);
    $addon_path = '';
    foreach($array as $key=>$ar){
        $addon_path .= $ar.'/';
        if(!$key) continue;
        if($array[$key-1]=='add-on')
           return $addon_path;
    }
    return false;
}

function rcl_path_to_url($path,$dir=false){
    if(!$dir) $dir = basename(content_url());
    if(function_exists('wp_normalize_path')) $path = wp_normalize_path($path);
    $array = explode('/',$path);
    $cnt = count($array);
    $url = '';
	$content_dir = $dir;
    foreach($array as $key=>$ar){
        if($array[$key]==$content_dir){
            $url = get_bloginfo('wpurl').'/'.$array[$key].'/';
            continue;
        }
        if($url){
            $url .= $ar;
            if($cnt>$key+1) $url .= '/';
        }
    }
    return $url;
}

function rcl_path_by_url($url,$dir=false){
    if(!$dir) $dir = basename(content_url());
    if(function_exists('wp_normalize_path')) $path = wp_normalize_path($path);
    $array = explode('/',$url);
    $cnt = count($array);
    $path = '';
	$content_dir = $dir;
    foreach($array as $key=>$ar){
        if($array[$key]==$content_dir){
            $path = $_SERVER['DOCUMENT_ROOT'].'/'.$array[$key].'/';
            continue;
        }
        if($path){
            $path .= $ar;
            if($cnt>$key+1) $path .= '/';
        }
    }
    return $path;
}

function rcl_mail($email, $title, $text){
    add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
    $headers = 'From: '.get_bloginfo('name').' <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";

    $text .= '<p><small>-----------------------------------------------------<br/>
    '.__('This letter was created automatically, no need to answer it.','rcl').'<br/>
    "'.get_bloginfo('name').'"</small></p>';
    wp_mail($email, $title, $text, $headers);
}

function rcl_multisort_array($array, $key, $type = SORT_ASC, $cmp_func = 'strcmp'){
    $GLOBALS['ARRAY_MULTISORT_KEY_SORT_KEY']  = $key;
    usort($array, create_function('$a, $b', '$k = &$GLOBALS["ARRAY_MULTISORT_KEY_SORT_KEY"];
        return ' . $cmp_func . '($a[$k], $b[$k]) * ' . ($type == SORT_ASC ? 1 : -1) . ';'));
    return $array;
}

function rcl_a_active($param1,$param2){
	if($param1==$param2) return 'filter-active';
}

function rcl_get_usernames($objects,$name_data){
	global $wpdb;

	if(!$objects||!$name_data) return false;

	foreach((array)$objects as $object){ $userslst[] = $object->$name_data; }

	$display_names = $wpdb->get_results($wpdb->prepare("SELECT ID,display_name FROM ".$wpdb->prefix."users WHERE ID IN (".rcl_format_in($userslst).")",$userslst));

	foreach((array)$display_names as $name){
		$names[$name->ID] = $name->display_name;
	}
	return $names;
}

function rcl_format_url($url,$id_tab=null){
	$ar_perm = explode('?',$url);
	$cnt = count($ar_perm);
	if($cnt>1) $a = '&';
	else $a = '?';
	$url = $url.$a;
	if($id_tab) $url = $url.'tab='.$id_tab;
	return $url;
}

function rcl_get_useraction($user_action=false){
	global $rcl_options,$rcl_userlk_action;

        if(!$user_action) $user_action = $rcl_userlk_action;

	$timeout = (isset($rcl_options['timeout'])&&$rcl_options['timeout'])? $rcl_options['timeout']*60: 600;

	$unix_time_action = strtotime(current_time('mysql'));
	$unix_time_user = strtotime($user_action);

	if(!$user_action)
		return $last_go = __('long ago','rcl');

	if($unix_time_action > $unix_time_user+$timeout){
                return human_time_diff($unix_time_user,$unix_time_action );
	} else {
		return false;
	}
}

function rcl_update_timeaction_user(){
	global $user_ID,$wpdb;

        if(!$user_ID) return false;

	$rcl_current_action = $wpdb->get_var($wpdb->prepare("SELECT time_action FROM ".RCL_PREF."user_action WHERE user='%d'",$user_ID));

	$last_action = rcl_get_useraction($rcl_current_action);

	if($last_action){

            $time = current_time('mysql');

            $res = $wpdb->update(
                                    RCL_PREF.'user_action',
                                    array( 'time_action' => $time ),
                                    array( 'user' => $user_ID )
                            );

            if(!isset($res)||$res==0){
                    $act_user = $wpdb->get_var($wpdb->prepare("SELECT COUNT(time_action) FROM ".RCL_PREF."user_action WHERE user ='%d'",$user_ID));
                    if($act_user==0){
                            $wpdb->insert(
                                    RCL_PREF.'user_action',
                                    array( 'user' => $user_ID,
                                    'time_action'=> $time )
                            );
                    }
                    if($act_user>1){
                            $wpdb->query($wpdb->prepare("DELETE FROM ".RCL_PREF."user_action WHERE user ='%d'",$user_ID));
                    }
            }
	}

	do_action('rcl_update_timeaction_user');

}

function rcl_sort_gallery($attaches,$key,$user_id=false){
	global $user_ID;

	if(!$attaches) return false;
	if(!$user_id) $user_id = $user_ID;
	$cnt = count($attaches);
	$v=$cnt+10;
	foreach($attaches as $attach){
		$id = str_replace($key.'-'.$user_id.'-','',$attach->post_name);
		if(!is_numeric($id)||$id>100) $id = $v++;
		if(!$id) $id = 0;
		foreach($attach as $k=>$att){
			$gallerylist[(int)$id][$k]=$attach->$k;
		}
	}

	$b=0;
	$cnt = count($gallerylist);
	for($a=0;$b<$cnt;$a++){
		if(!isset($gallerylist[$a])) continue;
		$new[$b] = $gallerylist[$a];
		$b++;
	}
	for($a=$cnt-1;$a>=0;$a--){$news[]=(object)$new[$a];}

	return $news;
}

function rcl_get_insert_image($image_id,$mime='image'){
	global $rcl_options;
	if($mime=='image'){
		$small_url = wp_get_attachment_image_src( $image_id, 'thumbnail' );
		$full_url = wp_get_attachment_image_src( $image_id, 'full' );
		if($rcl_options['default_size_thumb']) $sizes = wp_get_attachment_image_src( $image_id, $rcl_options['default_size_thumb'] );
		else $sizes = $small_url;
		$act_sizes = wp_constrain_dimensions($full_url[1],$full_url[2],$sizes[1],$sizes[2]);
		return '<a onclick="addfile_content(\'<a href='.$full_url[0].'><img height='.$act_sizes[1].' width='.$act_sizes[0].' class=aligncenter  src='.$full_url[0].'></a>\');return false;" href="#"><img src="'.$small_url[0].'"></a>';
	}else{
		return wp_get_attachment_link( $image_id, array(100,100),false,true );
	}
}

function rcl_get_button($ancor,$url,$args=false){
	$button = '<a href="'.$url.'" ';
	if(isset($args['attr'])) $button .= $args['attr'].' ';
	if(isset($args['id'])) $button .= 'id="'.$args['id'].'" ';
	$button .= 'class="recall-button ';
	if(isset($args['class'])) $button .= $args['class'];
	$button .= '">';
	if(isset($args['icon'])) $button .= '<i class="fa '.$args['icon'].'"></i>';
	$button .= '<span>'.$ancor.'</span>';
	$button .= '</a>';
	return $button;
}
