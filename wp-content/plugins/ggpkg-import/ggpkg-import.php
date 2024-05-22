<?php
/*  Copyright 2013-17  Plugin Gnome  (email : support@ggnome.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/***********************************************************************
Plugin Name: GGPKG Import
Plugin URI:  http://ggnome.com/ggpkg
Description: Import Pano2VR & Object2VR Content into Wordpress.
Version:     1.4.4
Author:      <a href="http://ggnome.com">Plugin Gnome</a>
************************************************************************/

ob_start();
require_once (dirname( __FILE__ ) . '/include/ggsw-include.php');

/***********************************************************************
	Internationalization
***********************************************************************/

function ggsw__($text)
{
	return __($text, 'ggpkg-import');
}

function ggsw_e($text)
{
	return _e($text, 'ggpkg-import');
}

function ggsw_init()
{
	$plugin_dir = basename(dirname(__FILE__));
	load_plugin_textdomain('ggpkg-import', false, $plugin_dir . '/languages');
	wp_enqueue_style('ggskin-style', plugin_dir_url(__FILE__) . 'include/ggskin.css');
	wp_enqueue_script('swfobject', $plugin_dir . '/include/swfobject.js');
}

add_action('init', 'ggsw_init');

/***********************************************************************
	Activation / Deactivation
***********************************************************************/

function ggsw_error_log($message)
{
	$timestamp = date('d/m/Y H:i:s');
	$ggsw_plugin_path = plugin_dir_path(__FILE__);
	$ggsw_log_file = $ggsw_plugin_path . 'error.log';
	
	if (!file_exists($ggsw_log_file))
	{
		$file_handle = fopen($ggsw_log_file, 'w');
		fwrite($file_handle, "[".$timestamp."] : Logfile created.\r\n");
		fclose($file_handle);
	}
	
	error_log( "[".$timestamp."] : ".$message."\r\n", 3, $ggsw_log_file);
}

function ggsw_trigger_error($message, $errno)
{
	if(isset($_GET['action']) && $_GET['action'] == 'error_scrape')
	{
		echo '<strong>' . $message . '</strong>';
		exit;
	}
	else
	{
		trigger_error($message, $errno);
	}
}

function ggsw_check_requirements()
{
	if (!class_exists('ZipArchive'))
		ggsw_trigger_error(ggsw__('The PHP Zip extension is not installed on your server. Without it GGPKG-Import will not work. Please contact your server administrator.'),E_USER_ERROR);
	if (!function_exists('simplexml_load_file'))
		ggsw_trigger_error(ggsw__('The libxml extension is not installed on your server. Without it GGPKG-Import will not work. Please contact your server administrator.'),E_USER_ERROR);
}

register_activation_hook(__FILE__, 'ggsw_check_requirements');

/***********************************************************************
	Uninstall
***********************************************************************/

function ggsw_uninstall()
{
	delete_option(ggsw_import_settings);	
}

register_uninstall_hook(__FILE__, 'ggsw_uninstall');

/**********************************************************************
 	Admin / Settings
 *********************************************************************/

$ggsw_options_page = null;
$ggsw_import_settings = get_option('ggsw_import_settings');

function ggsw_import_settings_default() 
{
	global $ggsw_import_settings;
	$ggsw_import_settings['width'] = 640;
	$ggsw_import_settings['height'] = 480;
	$ggsw_import_settings['start_preview'] = false;
	$ggsw_import_settings['display_map'] = false;
	$ggsw_import_settings['display_userdata'] = true;
	$ggsw_import_settings['expand_userdata'] = false;
	$ggsw_import_settings['gyro'] = false;
	$ggsw_import_settings['gyro_north'] = false;
	$userdata_default = "<ul>\n";
	$userdata_default .= "<li><b>Title:</b> \$ut</li>\n";
	$userdata_default .= "<li><b>Description:</b> \$ud</li>\n";
	$userdata_default .= "<li><b>Author:</b> \$ua</li>\n";
	$userdata_default .= "<li><b>Date/Time:</b> \$ue</li>\n";
	$userdata_default .= "</ul>";
	$ggsw_import_settings['userdata'] = $userdata_default;
	$ggsw_import_settings['master_panorama'] = "";
	$ggsw_import_settings['master_panoplayer'] = false;
	$ggsw_import_settings['master_panoskin'] = false;
	$ggsw_import_settings['master_object'] = "";
	$ggsw_import_settings['master_objectplayer'] = false;
	$ggsw_import_settings['master_objectskin'] = false;
}

if (!$ggsw_import_settings) 
{
	$ggsw_import_settings = array();
	ggsw_import_settings_default();
}

function ggsw_add_admin_page()
{
	global $ggsw_options_page;
	$ggsw_options_page = add_options_page(ggsw__('GGPKG Import'), ggsw__('GGPKG Import'), 'manage_options', 'ggsw_import', 'ggsw_import_options_page');
}

function ggsw_import_options_page()
{
	global $ggsw_import_settings;

	if (!class_exists('ZipArchive'))
		add_settings_error('ggsw_import_general', 'ziparchive_check', ggsw__('The PHP Zip extension is not installed on your server. Without it GGPKG-Import will not work. Please contact your server administrator.'), 'error');
	if (!function_exists('simplexml_load_file'))
		add_settings_error('ggsw_import_general', 'simplexml_check', ggsw__('The libxml extension is not installed on your server. Without it GGPKG-Import will not work. Please contact your server administrator.'), 'error');
		
	if (!empty($_POST) && is_admin()) 
	{
		$ggsw_import_settings = array('width' => $_POST['ggsw_player_size_w'],
									  'height' => $_POST['ggsw_player_size_h'],
									  'start_preview' => $_POST['ggsw_player_start_preview'],
									  'display_map' => $_POST['ggsw_player_map'],
									  'display_userdata' => $_POST['ggsw_player_display_userdata'],
									  'expand_userdata' => $_POST['ggsw_player_expand_userdata'],
									  'gyro' => $_POST['ggsw_player_gyro'],
									  'gyro_north' => $_POST['ggsw_player_gyro_north'],
									  'userdata' => $_POST['ggsw_player_userdata'],
									  'master_panorama' => $_POST['ggsw_player_master_pano'],
									  'master_panoplayer' => $_POST['ggsw_player_use_master_panoplayer'],
									  'master_panoskin' => $_POST['ggsw_player_use_master_panoskin'],
									  'master_object' => $_POST['ggsw_player_master_object'],
									  'master_objectplayer' => $_POST['ggsw_player_use_master_objectplayer'],
									  'master_objectskin' => $_POST['ggsw_player_use_master_objectskin']);
				
		$success = $ggsw_import_settings == get_option('ggsw_import_settings');
		$success |= update_option('ggsw_import_settings', $ggsw_import_settings);
		if ($success)
			add_settings_error('ggsw_import_general', 'settings_updated', ggsw__('Settings saved.'), 'updated');
		else
			add_settings_error('ggsw_import_general', 'settings_updated', ggsw__('Settings could not be saved.'), 'error');
	}		
	
	?>
	<div class="wrap">
	<?php settings_errors('ggsw_import_general'); ?>
	<?php screen_icon(); ?>
	<h2><?php ggsw_e('GGPKG Import'); ?></h2>
	<form action="" method="post">
	<table class="form-table">
	<tr valign="top">
	<th scope="row"><?php ggsw_e('Player size') ?></th>
	<td>
	<label for="ggsw_player_size_w"><?php ggsw_e('Width'); ?></label>
	<input name="ggsw_player_size_w" type="text" id="ggsw_player_size_w" value="<?php echo $ggsw_import_settings['width']; ?>" class="small-text" />
	<label for="ggsw_player_size_h"><?php ggsw_e('Height'); ?></label>
	<input name="ggsw_player_size_h" type="text" id="ggsw_player_size_h" value="<?php echo $ggsw_import_settings['height']; ?>" class="small-text" /><br />
	</td>
	</tr>
	<tr>
	<td>
	<label for="ggsw_player_start_preview"><?php ggsw_e('Start player as preview image'); ?></label>
	</td>
	<td>
	<input name="ggsw_player_start_preview" type="checkbox" <?php if ( $ggsw_import_settings['start_preview'] ) : ?>checked<?php endif; ?> />
	</td>
	</tr>
	<tr>
	<td>
	<label for="ggsw_player_display_userdata"><?php ggsw_e('Display User Data'); ?></label>
	</td>
	<td>
	<input name="ggsw_player_display_userdata" type="checkbox" <?php if ( $ggsw_import_settings['display_userdata'] ) : ?>checked<?php endif; ?> />
	</td>
	</tr>
	<tr>
	<td>
	<label for="ggsw_player_expand_userdata"><?php ggsw_e('Expand User Data on Import'); ?></label>
	</td>
	<td>
	<input name="ggsw_player_expand_userdata" type="checkbox" <?php if ( $ggsw_import_settings['expand_userdata'] ) : ?>checked<?php endif; ?> />
	</td>
	</tr>
	<tr>
	<td>
	<label for="ggsw_player_userdata"><?php ggsw_e('User Data'); ?></label>	
	</td>
	<td>
	<i><?php ggsw_e("Enter HTML-Code for User Data containing <a href='http://gardengnomesoftware.com/wiki/Skin_-_Placeholder'>User Data Placeholders</a>."); ?></i>
	</td>
	</tr>
	<tr>
	<td></td><td>
	<textarea name="ggsw_player_userdata" rows="10" cols="80"><?php echo $ggsw_import_settings['userdata']; ?></textarea>
	</td>
	</tr>
	<tr>
	<td><h3>Pano2VR</h3></td>
	</tr>
	<tr>
	<td>
	<label for="ggsw_player_map"><?php ggsw_e('Display Map'); ?></label>
	</td>
	<td>
	<input name="ggsw_player_map" type="checkbox" <?php if ( $ggsw_import_settings['display_map'] ) : ?>checked<?php endif; ?> />
	</td>
	</tr>
	<tr>
	<td>
	<label for="ggsw_player_master_pano"><?php ggsw_e('Master Panorama'); ?></label>
	</td>
	<td>
	<input id="ggsw_player_master_pano" name="ggsw_player_master_pano" type="text" size="36" value="<?php echo $ggsw_import_settings['master_panorama']; ?>" />
	<input id="ggsw_player_master_pano_button" type="button" value="<?php ggsw_e('Upload/Select Master Panorama'); ?>" />
	</td>
	</tr>
	<tr>
	<td>
	<label for="ggsw_player_use_master_panoplayer"><?php ggsw_e('Use Panorama Player from Master Panorama'); ?></label>
	</td>
	<td>
	<input id="ggsw_player_use_master_panoplayer" type="checkbox" name="ggsw_player_use_master_panoplayer" <?php if ( $ggsw_import_settings['master_panoplayer'] ) : ?>checked<?php endif; ?> />
	</td>
	</tr>
	<tr>
	<td>
	<label for="ggsw_player_use_master_panoskin"><?php ggsw_e('Use Skin from Master Panorama'); ?></label>
	</td>
	<td>
	<input id="ggsw_player_use_master_panoskin" type="checkbox" name="ggsw_player_use_master_panoskin" <?php if ( $ggsw_import_settings['master_panoskin'] ) : ?>checked<?php endif; ?> />
	</td>
	</tr>
	<tr>
	<td>
	<label for="ggsw_player_gyro"><?php ggsw_e('Use Gyro on Handheld Devices'); ?></label>
	</td>
	<td>
	<input id="ggsw_player_gyro" type="checkbox" name="ggsw_player_gyro" <?php if ( $ggsw_import_settings['gyro'] ) : ?>checked<?php endif; ?> />
	</td>
	</tr>
		<tr>
	<td>
	<label for="ggsw_player_gyro_north"><?php ggsw_e('Use True North for Gyro'); ?></label>
	</td>
	<td>
	<input id="ggsw_player_gyro_north" type="checkbox" name="ggsw_player_gyro_north" <?php if ( $ggsw_import_settings['gyro_north'] ) : ?>checked<?php endif; ?> />
	</td>
	</tr>
		<tr>
	<td><h3>Object2VR</h3></td>
	</tr>
	<tr>
	<td>
	<label for="ggsw_player_master_object"><?php ggsw_e('Master Objectmovie'); ?></label>
	</td>
	<td>
	<input id="ggsw_player_master_object" name="ggsw_player_master_object" type="text" size="36" value="<?php echo $ggsw_import_settings['master_object']; ?>" />
	<input id="ggsw_player_master_object_button" type="button" value="<?php ggsw_e('Upload/Select Master Objectmovie'); ?>" />
	</td>
	</tr>
	<tr>
	<td>
	<label for="ggsw_player_use_master_objectplayer"><?php ggsw_e('Use Object Player from Master Objectmovie'); ?></label>
	</td>
	<td>
	<input id="ggsw_player_use_master_objectplayer" type="checkbox" name="ggsw_player_use_master_objectplayer" <?php if ( $ggsw_import_settings['master_objectplayer'] ) : ?>checked<?php endif; ?> />
	</td>
	</tr>
	<tr>
	<td>
	<label for="ggsw_player_use_master_objectskin"><?php ggsw_e('Use Skin from Master Objectmovie'); ?></label>
	</td>
	<td>
	<input id="ggsw_player_use_master_objectskin" type="checkbox" name="ggsw_player_use_master_objectskin" <?php if ( $ggsw_import_settings['master_objectskin'] ) : ?>checked<?php endif; ?> />
	</td>
	</tr>
	
	<?php 
	do_settings_sections('ggsw_import');
	?>
	</table>

	<?php submit_button(); ?>
	</form>
	</div>
	<?php
}

function ggsw_settings_scripts() 
{
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('ggsw-settings-upload', plugin_dir_url(__FILE__).'/include/ggsw-scripts.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('ggsw-settings-upload');
}

function ggsw_settings_styles() 
{
	wp_enqueue_style('thickbox');
}

if (isset($_GET['page']) && $_GET['page'] == 'ggsw_import') 
{
	add_action('admin_print_scripts', 'ggsw_settings_scripts');
	add_action('admin_print_styles', 'ggsw_settings_styles');
}

function ggsw_import_admin_init()
{
	register_setting('ggsw_import_settings', 'ggsw_import_settings', 'ggsw_import_validate_options');
	add_settings_section('ggsw_import_settings_main', ggsw__('GGPKG Import Settings'), 'ggsw_import_section_text', 'ggsw_import');
}

function ggsw_import_section_text()
{
}

function ggsw_import_validate_options($input)
{
	$valid = array();
	$valid['width'] = $input['width'];
	$valid['height'] = $input['height'];
	$valid['start_preview'] = $input['start_preview'];
	$valid['display_map'] = $input['display_map'];
	$valid['display_userdata'] = $input['display_userdata'];
	$valid['expand_userdata'] = $input['expand_userdata'];
	$valid['gyro'] = $input['gyro'];
	$valid['gyro_north'] = $input['gyro_north'];
	$valid['userdata'] = $input['userdata'];
	$valid['master_panorama'] = $input['master_panorama'];
	$valid['master_panoplayer'] = $input['master_panoplayer'];
	$valid['master_panoskin'] = $input['master_panoskin'];
	$valid['master_object'] = $input['master_object'];
	$valid['master_objectplayer'] = $input['master_objectplayer'];
	$valid['master_objectskin'] = $input['master_objectskin'];
	return $valid;
}

function ggsw_contextual_help($help, $screenID, $screen) 
{
	global $ggsw_options_page;
	if ($screenID == $ggsw_options_page)
		$help = '<br/><a href="http://ggnome.com/ggpkg" target="_blank">' . ggsw__("GGPKG Import Documentation") . '</a>';
	return $help;
}

if (is_admin())
{
	add_action('admin_menu', 'ggsw_add_admin_page');
	add_action('admin_init', 'ggsw_import_admin_init');
	add_filter('contextual_help', 'ggsw_contextual_help', 10, 3);
}

function ggsw_settings_link($links) 
{
	array_unshift($links, '<a href="options-general.php?page=ggsw_import">' . ggsw__('Settings') . '</a>' );
	return $links;
}

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'ggsw_settings_link');

/**********************************************************************
 	Upload / Display / Delete GGPKG-Files
*********************************************************************/

function ggsw_add_filetypes($existing_mimes=array()) 
{
	// add ggpkg extension to the array
	$existing_mimes['ggpkg'] = 'image/ggsw-package';
// old type, does not all preview images everywhere 	
//	$existing_mimes['ggpkg'] = 'application/ggsw-package'; 
	return $existing_mimes;
}

add_filter('upload_mimes', 'ggsw_add_filetypes');

// Exception for WordPress 4.7.1 file contents check system using finfo_file (wp-include/functions.php)

function ggsw_add_allow_upload_extension_exception($data, $file, $filename ) {

	if (substr($filename, -6)==".ggpkg") {
		$proper_filename = false;
		$ext = 'ggpkg';
		$type = 'image/ggsw-package';
	    return compact( 'ext', 'type', 'proper_filename' );
	}
	return $data;
}

add_filter( 'wp_check_filetype_and_ext', 'ggsw_add_allow_upload_extension_exception',10,3);

function ggsw_unzip_package($attachmentID = "")
{
	if (ggsw_attachment_is_package($attachmentID))
	{
		$attachment = get_attached_file($attachmentID);
		if ($attachment)
		{
			$path_parts = pathinfo($attachment);
			$filename = str_replace('-', '_', $path_parts['filename']);
			$extract_path = $path_parts['dirname'] . "/" . $filename;
			if (is_numeric(substr($filename, 0, 1)))
				$filename = '_' . $filename;
			if (!mkdir($extract_path, 0777))
				ggsw_error_log("mkdir failed!");
			$zip_file = new ZipArchive();
			if ($zip_file->open($attachment) == true)
			{
				if ($zip_file->extractTo($extract_path) == false)
					ggsw_error_log("Error extracting ".$zip_file);
				else 
				{
					ggsw_chmod($extract_path, 0777);
					if (ggsw_file_in_package($attachmentID, "pano2vr_player.js"))
					{
						$uniquePlayerVar = "var " . $filename . "_pano2vrPlayer = pano2vrPlayer;";
						$playerFile = $extract_path . "/pano2vr_player.js";
						file_put_contents($playerFile, $uniquePlayerVar, FILE_APPEND);
						if (ggsw_file_in_package($attachmentID, "skin.js"))
						{
							$uniqueSkinVar = "var " . $filename . "_pano2vrSkin = pano2vrSkin;";
							$skinFile = $extract_path . "/skin.js";
							file_put_contents($skinFile, $uniqueSkinVar, FILE_APPEND);
						}
					}
					if (ggsw_file_in_package($attachmentID, "object2vr_player.js"))
					{
						$uniquePlayerVar = "var " . $filename . "_object2vrPlayer = object2vrPlayer;";
						$playerFile = $extract_path . "/object2vr_player.js";
						file_put_contents($playerFile, $uniquePlayerVar, FILE_APPEND);
						if (ggsw_file_in_package($attachmentID, "skin.js"))
						{
							$uniqueSkinVar = "var " . $filename . "_object2vrSkin = object2vrSkin;";
							$skinFile = $extract_path . "/skin.js";
							file_put_contents($skinFile, $uniqueSkinVar, FILE_APPEND);
						}
					}
				}
			}
		}
	}
}

add_action('add_attachment', 'ggsw_unzip_package');

function ggsw_delTree($dir) 
{
	$files = array_diff(scandir($dir), array('.','..'));
	foreach ($files as $file) 
		(is_dir("$dir/$file")) ? ggsw_delTree("$dir/$file") : unlink("$dir/$file");

	return rmdir($dir);
}

function ggsw_delete_package($attachmentID = "")
{
	if (ggsw_attachment_is_package($attachmentID))
	{
		$attachment = get_attached_file($attachmentID);
		if ($attachment)
		{
			$path_parts = pathinfo($attachment);
			$filename = str_replace('-', '_', $path_parts['filename']);
			$extract_path = $path_parts['dirname'] . "/" . $filename;
			if (!ggsw_delTree($extract_path))
				ggsw_error_log("Could not delete directory " . $extract_path);
		}
	}
}

add_action('delete_attachment', 'ggsw_delete_package');

function ggsw_get_attachment_image_attributes($data,$attachment) // Change icon in the library view
{
	$attachmentID=$attachment->ID;
	if (ggsw_attachment_is_package($attachmentID))
	{
		if (ggsw_file_in_package($attachmentID,"preview.jpg")) {
			$data["src"]=ggsw_file_url($attachmentID,"preview.jpg");
		} else {
			$data["src"]=plugin_dir_url(__FILE__) . "ggpkg.png";
		}
	}
	return $data;
}

add_filter('wp_get_attachment_image_attributes', 'ggsw_get_attachment_image_attributes',1,2);

function ggsw_get_preview_image_size($attachmentID) 
{
	$w=get_post_meta($attachmentID,"ggsw_width",true);
	$h=get_post_meta($attachmentID,"ggsw_height",true);
	if (!(($w) && ($h))) {
		$previewFile=ggsw_file_path($attachmentID)."preview.jpg";
		if (file_exists($previewFile)) {
			$previewSize=getimagesize($previewFile);
			$w=$previewSize[0];
			$h=$previewSize[1];
			update_post_meta($attachmentID,"ggsw_width",$w);
			update_post_meta($attachmentID,"ggsw_height",$h);
		}
	}
	return Array($w,$h);
}

function ggsw_prepare_attachment_for_js($data, $attachment)
{
	$attachmentID=$attachment->ID;
	if (ggsw_attachment_is_package($attachmentID)) {
		if (ggsw_file_in_package($attachmentID,"preview.jpg")) {
			$data['url']=ggsw_file_url($attachmentID,"preview.jpg");
			$s=ggsw_get_preview_image_size($attachmentID);
			if (($s[0]>0) && ($s[1]>0)) {
				$data["width"]=$s[0];
				$data["height"]=$s[1];
			}
			$data['mime']='image/jpeg';
			$data['type']='image';
			$data['subtype']='jpeg';
			if (($data['sizes']) && ($data['sizes']['full'])) {
				$data['sizes']['full']['url']=ggsw_file_url($attachmentID,"preview.jpg");
			}
		} else {
			// show the default file name, only works for non "image" types
			$data['mime']='application/ggsw-package';
			$data['type']='application';
			$data['subtype']='ggsw-package'; 
		}
	}
	return $data;
}

add_filter('wp_prepare_attachment_for_js', 'ggsw_prepare_attachment_for_js',1,2);

function ggsw_get_attachment_metadata($data,$attachmentID) // used in library view
{
	if (ggsw_attachment_is_package($attachmentID)) {
		if (ggsw_file_in_package($attachmentID,"preview.jpg")) {
			$attachment = get_attached_file($attachmentID);
			$path_parts = pathinfo($attachment);
			$filename = str_replace('-', '_', $path_parts['filename']);

			$data['file']=$filename."/preview.jpg";
			$data['thumb']=$filename."/preview.jpg";
			$data['mime-type']='image/jpeg';
			$s=ggsw_get_preview_image_size($attachmentID);
			if (($s[0]>0) && ($s[1]>0)) {
				$data["width"]=intval($s[0]);
				$data["height"]=intval($s[1]);
			}
			$sizes=Array();
			$thumb=Array();
			if (($s[0]>0) && ($s[1]>0)) {
				$thumb["width"]=intval($s[0]);
				$thumb["height"]=intval($s[1]);
				$thumb['file']=$filename."/preview.jpg";
			}			
			$sizes['thumbnail']=$thumb;
			$data['sizes']=$sizes;
		} else {
			$data['mime-type']='application/ggsw-package';
			$data["width"]=100;
			$data["height"]=128;
		}
	}	
	return $data;
}

add_filter('wp_get_attachment_metadata', 'ggsw_get_attachment_metadata',1,2);

function ggsw_mime_type_icon($data, $mime_type,$attachmentID)
{
	if (($mime_type == "application/ggsw-package") ||
		($mime_type == "image/ggsw-package"))
	{
		$data=plugin_dir_url(__FILE__) . "ggpkg_file.png";
	}
	return $data;
}

add_filter('wp_mime_type_icon', 'ggsw_mime_type_icon',1,3);

function ggsw_media_send_to_editor($html, $attachmentID, $attachment) 
{
	global $ggsw_import_settings;
	$options = $ggsw_import_settings;
	
	if (ggsw_attachment_is_package($attachmentID) && isset($_POST['post_id']) && $_POST['post_id'] != 0)
	{
		$html = "[ggpkg id=" . $attachmentID;
		if ($options['expand_userdata'] == 'on')
		{
			$html .= " display_userdata='false']\n";
			$userdata = $options['userdata'];
			if (ggsw_file_in_package($attachmentID, "pano.xml"))
				$XMLFile = ggsw_file_path($attachmentID) . "pano.xml";
			else 
				$XMLFile = ggsw_file_path($attachmentID) . "object.xml";
			$userdata = ggsw_convert_placeholders($userdata, $XMLFile);
			$html .= $userdata;
		}
		else
			$html .= "]\n";
		
		return $html;
	}
	else
		return $html;
}

add_filter('media_send_to_editor', 'ggsw_media_send_to_editor', 10, 3);

function ggsw_file_path($attachmentID)
{
	$attachment = get_attached_file($attachmentID);
	$path_parts = pathinfo($attachment);
	$filename = str_replace('-', '_', $path_parts['filename']);
	return $path_parts['dirname'] . "/" . $filename . '/';
}

function ggsw_file_in_package($attachmentID, $file)
{
	$extract_path_local = ggsw_file_path($attachmentID);
	if (file_exists($extract_path_local.$file))
		return true;
	else 
		return false;
}

function ggsw_attachment_is_package($attachmentID) 
{
	$mime_type = get_post_mime_type($attachmentID);
	
	if (($mime_type == "application/ggsw-package") ||
		($mime_type == "image/ggsw-package"))
	{
		return true;
	}
	return false;
}

function ggsw_file_url($attachmentID, $file)
{
	$attachmentURL = wp_get_attachment_url($attachmentID);
	$filename  = strrchr($attachmentURL, '/');
	$filename = str_replace('-', '_', $filename);
	$attachmentURL = substr($attachmentURL, 0, strrpos($attachmentURL, '/')) . $filename;
	$extract_path = substr($attachmentURL, 0, strrpos($attachmentURL, '.'));
	return $extract_path . "/" . $file;
}

function ggsw_url_from_local($url)
{
	$url_from_local = $url;
	$url_parts = parse_url($url);
// 	if ($url_parts['host'] == $_SERVER['SERVER_NAME'])
// 	{
		$url_from_local = $url_parts['path'];	
// 	}
	return $url_from_local;
}

function ggsw_add_googlemaps_script()
{
	ggsw_error_log("in add_googlemaps_script!");
	wp_enqueue_script('googlemaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp');
}

function ggsw_get_http_response_code($url)
{
	$headers = get_headers($url);
	return substr($headers[0], 9, 3);
}

function ggsw_remote_file_available($url)
{
	if(intval(ggsw_get_http_response_code($url)) < 400)
		return true;
	else
		return false;
}

function ggsw_parse_gginfo_json($json_content)
{
	$json = json_decode($json_content);
	$json_externals = $json->{'external'};
	if (isset($json_externals))
	{
		$js_files = $json_externals->{'js'};
		if (isset($js_files))
		{
			$index = 0;
			foreach ($js_files as $js_file)
			{
				wp_enqueue_script('js_' . $index, $js_file);
				$index++;
			}
		}
		$css_files = $json_externals->{'css'};
		if (isset($css_files))
		{
			$index = 0;
			foreach ($css_files as $css_file)
			{
				wp_enqueue_style('css_' . $index, $css_file);
				$index++;
			}
		}
	}
}

function ggsw_parse_gginfo_file($config_file)
{
	if (($json_content = file_get_contents($config_file)) != false)
	{
		$json_content = utf8_encode($json_content);
		ggsw_parse_gginfo_json($json_content);
	}
}

function ggsw_shortcode($attributes)
{
	global $post;
	global $ggsw_import_settings;
	$options = $ggsw_import_settings;
	$attachmentID = $attributes['id'];
	$attributes['id'] = $attachmentID . "_" . $post->ID;
	
	if (intval($attachmentID) != 0)
		$attachment = get_attached_file($attachmentID);
	
	if (isset($attributes['folder']))
	{
		$upload_dir = wp_upload_dir();
		$dir = $upload_dir['baseurl'] . "/" . $attributes['folder'] . "/";
		$localdir = $upload_dir['basedir'] . "/" . $attributes['folder'] . "/";
	}
	else 
		$dir = "";
	
	if (isset($attributes['url']))
	{
		$url = $attributes['url'];
		if (substr($url, -1) != '/')
			$url = $url . '/';
	}
	else 
		$url = "";
	
	if ($attachment || strcmp($dir, "")!=0 || strcmp($url, "")!=0)
	{
		$width = $options['width'];
		$height = $options['height'];
		if (!isset($attributes['width']))
			$attributes['width'] = trim($width);
		if (!isset($attributes['height']))
			$attributes['height'] = trim($height);
				
		if (isset($options['start_preview']) && $options['start_preview']=='on')
			$start_preview = 'true';
		else 
			$start_preview = 'false';
		if (!isset($attributes['start_preview']))
			$attributes['start_preview'] = $start_preview;
		
		if (strcmp($dir, "") == 0 && strcmp($url, "") == 0) // ----- param 'id'
		{
			// read config file
			if (ggsw_file_in_package($attachmentID, "gginfo.json"))
			{
				$config_file = ggsw_file_path($attachmentID) . "gginfo.json";
				ggsw_parse_gginfo_file($config_file);
				$attributes['async_loading'] = 'true';
			}
				
			$attributes['package_url'] = ggsw_url_from_local(ggsw_file_url($attachmentID, ""));
			$attachment = get_attached_file($attachmentID);
			$path_parts = pathinfo($attachment);
			$filename = str_replace('-', '_', $path_parts['filename']);
			if (is_numeric(substr($filename, 0, 1)))
				$filename = '_' . $filename;
			$attributes['package_title'] = $filename;
				
			if (ggsw_file_in_package($attachmentID, "skin.js"))
			{
				$attributes['has_skin'] = 'true';
				$attributes['skin_file'] = ggsw_url_from_local(ggsw_file_url($attachmentID, "skin.js"));
			}
			else
				$attributes['has_skin'] = 'false';
			
			if (ggsw_file_in_package($attachmentID, "pano.xml"))
			{
				$attributes['player_file'] = ggsw_url_from_local(ggsw_file_url($attachmentID, "pano2vr_player.js"));
				$attributes['xml_file'] = ggsw_url_from_local(ggsw_file_url($attachmentID, "pano.xml"));
				$attributes['xml_file_local'] = ggsw_file_path($attachmentID) . "pano.xml";
				$attributes['is_pano'] = 'true';
			}
			else if (ggsw_file_in_package($attachmentID, "object.xml"))
			{
				$attributes['player_file'] = ggsw_url_from_local(ggsw_file_url($attachmentID, "object2vr_player.js"));
				$attributes['xml_file'] = ggsw_url_from_local(ggsw_file_url($attachmentID, "object.xml"));
				$attributes['xml_file_local'] = ggsw_file_path($attachmentID) . "object.xml";
				$attributes['is_pano'] = 'false';
			}
			else 
			{
				return ggsw__("GGPKG incomplete, XML-File is missing!");
			}
			
			if ($attributes['start_preview'] == 'true' || $attributes['start_preview'] == '1')
			{
				$attributes['preview_file'] = ggsw_url_from_local(ggsw_file_url($attachmentID, "preview.jpg"));
				$attributes['preview_play_file'] = ggsw_url_from_local(plugin_dir_url(__FILE__) . "include/play.png");
			}
		}
		else if (strcmp($url, "") == 0)// ----- param 'folder'
		{
			// read config file
			if (file_exists($localdir . "gginfo.json"))
			{
				$config_file = $localdir . "gginfo.json";
				ggsw_parse_gginfo_file($config_file);
				$attributes['async_loading'] = 'true';
			}
				
			$attributes['package_url'] = ggsw_url_from_local($dir);
			$packageTitle = $dir;
			if (strrpos($packageTitle, '/'))
				$packageTitle = substr($packageTitle, strrpos($packageTitle, '/') + 1);
			$attributes['package_title'] = $packageTitle;
			
			if (file_exists($localdir . "skin.js"))
			{
				$attributes['has_skin'] = 'true';
				$attributes['skin_file'] = ggsw_url_from_local($dir . "skin.js");
			}
			else
				$attributes['has_skin'] = 'false';
				
			if (file_exists($localdir . "pano.xml"))
			{
				$attributes['player_file'] = ggsw_url_from_local($dir . "pano2vr_player.js");
				$attributes['xml_file'] = ggsw_url_from_local($dir . "pano.xml");
				$attributes['xml_file_local'] = $dir . "pano.xml";
				$attributes['is_pano'] = 'true';
			}
			else if (file_exists($localdir . "object.xml"))
			{
				$attributes['player_file'] = ggsw_url_from_local($dir . "object2vr_player.js");
				$attributes['xml_file'] = ggsw_url_from_local($dir . "object.xml");
				$attributes['xml_file_local'] = $dir . "object.xml";
				$attributes['is_pano'] = 'false';
			}
			else
			{
				return ggsw__("GGPKG incomplete, XML-File is missing!");
			}
				
			if ($attributes['start_preview'] == 'true' || $attributes['start_preview'] == '1')
			{
				if (file_exists($localdir . "preview.jpg"))
				{
					$attributes['preview_file'] = ggsw_url_from_local($dir .  "preview.jpg");
					$attributes['preview_play_file'] = ggsw_url_from_local(plugin_dir_url(__FILE__) . "include/play.png");
				}
				else
				{
					$attributes['start_preview'] = 'false';
				}
			}
		}
		else // ----- param 'url'
		{
			$attributes['package_url'] = $url;
			$md5_hash = md5($attributes['url']);
			if (is_numeric(substr($md5_hash, 0, 1)))
				$md5_hash = '_' . $md5_hash;
			$packageTitle = $md5_hash;
				
			$remote_json_file = $attributes['package_url'] . "gginfo.json";
			if (ggsw_remote_file_available($remote_json_file))
			{
				$attributes['async_loading'] = 'true';
				if (function_exists('curl_version')) // curl available
				{
					$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $remote_json_file);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_HEADER, false);
					$json_content = curl_exec($curl);
					curl_close($curl);
				}
				else
				{
					$json_content = file_get_contents($remote_json_file);
				}
				
				ggsw_parse_gginfo_json($json_content);
				$json = json_decode($json_content);
				$json_type = $json->{'type'};
				if (isset($json_type))
				{
					if ($json_type == 'panorama')
					{
						$attributes['is_pano'] = 'true';
						$attributes['xml_file'] = $url . "pano.xml";
						$attributes['xml_file_local'] = $url . "pano.xml";
					}
					else
					{
						$attributes['is_pano'] = 'false';
						$attributes['xml_file'] = $url . "object.xml";
						$attributes['xml_file_local'] = $url . "object.xml";
					}
				}
				$json_player = $json->{'player'};
				if (isset($json_player))
				{
					$json_js_player = $json_player->{'js'};
					if (isset($json_js_player))
					{
						$attributes['player_file'] = $url . $json_js_player;
					}
				}
				$json_skin = $json->{'skin'};
				if (isset($json_skin))
				{
					$json_skin_file = $json_skin->{'js'};
					if (isset($json_skin_file))
					{
						$attributes['has_skin'] = 'true';
						$attributes['skin_file'] = $url . $json_skin_file;
					}
				}
				$json_preview = $json->{'preview'};
				if (isset($json_preview))
				{
					$json_preview_file = $json_preview->{'img'};
					if (isset($json_preview_file))
					{
						$attributes['preview_file'] = $url . $json_preview_file;
						$attributes['preview_play_file'] = ggsw_url_from_local(plugin_dir_url(__FILE__) . "include/play.png");
					}
					else
					{
						$attributes['start_preview'] = 'false';
					}
				}
				else 
				{
					$attributes['start_preview'] = 'false';
				}
			}
			else
			{
				return ggsw__("No gginfo.json found at the remote url!");
			}
		}
				
		if ($attributes['is_pano'] == 'true' && isset($options['master_panorama']) && $options['master_panorama'] != "")
		{
			$master_panorama_url = substr($options['master_panorama'], 0, strrpos($options['master_panorama'], '.'));
			$master_panorama_dir = ABSPATH . substr($master_panorama_url, strlen(get_home_url()) + 1);
			$path_parts = pathinfo($master_panorama_dir);
			$master_panorama_dir = $path_parts['dirname'] . "/" . str_replace('-', '_', $path_parts['filename']);
			$master_panorama_url = substr($master_panorama_url, 0, strrpos($master_panorama_url, '/')) . '/' . str_replace('-', '_', $path_parts['filename']);
			$attributes['masterpanorama_dir'] = ggsw_url_from_local($master_panorama_url);
			if (isset($options['master_panoplayer']) && $options['master_panoplayer']=='on')
			{
				if (fopen($master_panorama_dir . "/" . "pano2vr_player.js", "r"))
				{
					$master_panoplayer_file = $master_panorama_url . "/" . "pano2vr_player.js";
					$attributes['player_file_from_masterpanorama'] = ggsw_url_from_local($master_panoplayer_file);
					$attributes['player_from_masterpanorama'] = 'true';
				}
			}
			if (isset($options['master_panoskin']) && $options['master_panoskin'] == 'on')
			{
				if (fopen($master_panorama_dir . "/" . "skin.js", "r"))
				{
					$master_panoskin_file = $master_panorama_url . "/" . "skin.js";
					$attributes['skin_file_from_masterpanorama'] = ggsw_url_from_local($master_panoskin_file);
					$attributes['skin_from_masterpanorama'] = 'true';
					$attributes['has_skin'] = 'true';
				}
			}
		}
		
		if ($attributes['is_pano'] != 'true' && isset($options['master_object']) && $options['master_object'] != "")
		{
			$master_object_url = substr($options['master_object'], 0, strrpos($options['master_object'], '.'));
			$master_object_dir = ABSPATH . substr($master_object_url, strlen(get_home_url()) + 1);
			$path_parts = pathinfo($master_object_dir);
			$master_object_dir = $path_parts['dirname'] . "/" . str_replace('-', '_', $path_parts['filename']);
			$master_object_url = substr($master_object_url, 0, strrpos($master_object_url, '/')) . '/' . str_replace('-', '_', $path_parts['filename']);
			$attributes['masterobject_dir'] = ggsw_url_from_local($master_object_url);
			if (isset($options['master_objectplayer']) && $options['master_objectplayer']=='on')
			{
				if (fopen($master_object_dir . "/" . "object2vr_player.js", "r"))
				{
					$master_objectplayer_file = $master_object_url . "/" . "object2vr_player.js";
					$attributes['player_file_from_masterobject'] = ggsw_url_from_local($master_objectplayer_file);
					$attributes['player_from_masterobject'] = 'true';
				}
			}
			if (isset($options['master_objectskin']) && $options['master_objectskin'] == 'on')
			{
				if (fopen($master_object_dir . "/" . "skin.js", "r"))
				{
					$master_objectskin_file = $master_object_url . "/" . "skin.js";
					$attributes['skin_file_from_masterobject'] = ggsw_url_from_local($master_objectskin_file);
					$attributes['skin_from_masterobject'] = 'true';
					$attributes['has_skin'] = 'true';
				}
			}
		}
							
		if (isset($options['display_map']) && $options['display_map']=='on' && $attributes['is_pano'] == 'true')
			$display_map = 'true';
		else 
			$display_map = 'false';
		if (!isset($attributes['display_map']))
			$attributes['display_map'] = $display_map;
		
		if ((isset($attributes['map_only']) && ($attributes['map_only'] == 'true' || $attributes['map_only'] == '1'))
				|| $attributes['display_map'] == 'true')
			ggsw_add_googlemaps_script();
			
		$attributes['gyro_file'] = ggsw_url_from_local(plugin_dir_url(__FILE__) . "include/pano2vrgyro.js");
		if (isset($options['gyro']) && $options['gyro']=='on' && $attributes['is_pano'] == 'true')
			$gyro = 'true';
		else 
			$gyro = 'false';
		if (!isset($attributes['gyro']))
			$attributes['gyro'] = $gyro;
					
		if (isset($options['gyro_north']) && $options['gyro_north']=='on' && $attributes['is_pano'] == 'true')
			$gyro_north = 'true';
		else 
			$gyro_north = 'false';
		if (!isset($attributes['gyro_north']))
			$attributes['gyro_north'] = $gyro_north;
					
		if (isset($options['display_userdata']) && $options['display_userdata']=='on')
			$display_userdata = 'true';
		else 
			$display_userdata = 'false';
		if (!isset($attributes['display_userdata']))
			$attributes['display_userdata'] = $display_userdata;
		
		$attributes['userdata_html'] = $options['userdata'];
		
		$attributes['error_missing_xml'] = ggsw__('GGPKG incomplete, XML-File is missing!');
		$attributes['error_html5_required'] = ggsw__('This content requires HTML5/CSS3, WebGL, or Adobe Flash Player Version 9 or higher.');
		$attributes['error_javascript_required'] = ggsw__('Please enable Javascript!');

		return ggsw_ggpkg_html($attributes);	
	}
}

function ggsw_map_shortcode($attributes)
{
	global $post;
	global $ggsw_import_settings;
	$options = $ggsw_import_settings;
	$attachmentID = $attributes['id'];
	if (intval($attachmentID) != 0)
	{
		$attachment = get_attached_file($attachmentID);
		if ($attachment)
		{
			$width = $options['width'];
			$height = $options['height'];
			if (isset($attributes['width']))
				$width = $attributes['width'];
			if (isset($attributes['height']))
				$height = $attributes['height'];
			
			$ID = $attachmentID . "_" . $post->ID;
			return ggsw_map_html($ID, $width, $height);
		}
	}
}

add_shortcode('ggpkg', 'ggsw_shortcode');
?>