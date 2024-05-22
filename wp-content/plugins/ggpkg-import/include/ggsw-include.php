<?php
/*  Copyright 2013  Plugin Gnome  (email : support@ggnome.com)

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

function ggsw_chmod($path, $filePerm=0644, $dirPerm=0755)
{
	if (!file_exists($path))
		return(false);

	if (is_file($path))
	{
		chmod($path, $filePerm);
	}
	elseif (is_dir($path))
	{
		$foldersAndFiles = scandir($path);
		$entries = array_slice($foldersAndFiles, 2);

		foreach ($entries as $entry)
			ggsw_chmod($path."/".$entry, $filePerm, $dirPerm);

		chmod($path, $dirPerm);
	}
	return(true);
}

function ggsw_get_xmlpano($xml_file)
{
	libxml_use_internal_errors(true);
	$xmlpano = simplexml_load_file($xml_file);
	if (!$xmlpano)
	{
		$errorString = "";
		foreach(libxml_get_errors() as $error)
		{
			$errorString .= $error->message;
		}
		$xmlpano = array("error" => $errorString);
		return $xmlpano;
	}
	
	if($xmlpano->getName() == 'tour')
	{
		$startPano = $xmlpano['start'];
		$nodes = $xmlpano->panorama;
		foreach ($nodes as $node)
		{
			if (strcmp($node['id'], $startPano) == 0)
			{
				$xmlpano = $node;
				break;
			}
		}
	}
	return $xmlpano;
}

function ggsw_has_coordinates($xml_file)
{
	$xmlpano = ggsw_get_xmlpano($xml_file);
	if (isset($xmlpano["error"]))
		return false;
	
	if ($xmlpano->userdata['longitude'] != "" && $xmlpano->userdata['latitude'] != "")
		return true;
	else
		return false;
}

function ggsw_convert_placeholders($placeholder_string, $xml_file)
{
	$xmlpano = ggsw_get_xmlpano($xml_file);
	
	if (isset($xmlpano->error))
		return $xmlpano->error;

	if (!isset($xmlpano) || !isset($xmlpano->userdata))
	{
		$title = '';
		$description = '';
		$author = '';
		$datetime = '';
		$copyright = '';
		$source = '';
		$info = '';
		$comment = '';
		$longitude = '';
		$latitude = '';
	}
	else 
	{
		$title = $xmlpano->userdata['title'];
		$description = $xmlpano->userdata['description'];
		$author = $xmlpano->userdata['author'];
		$datetime = $xmlpano->userdata['datetime'];
		$copyright = $xmlpano->userdata['copyright'];
		$source = $xmlpano->userdata['source'];
		$info = $xmlpano->userdata['info'];
		$comment = $xmlpano->userdata['comment'];
		$longitude = $xmlpano->userdata['longitude'];
		$latitude = $xmlpano->userdata['latitude'];
	}
	$placeholder_string = str_replace('$ut', $title, $placeholder_string);
	$placeholder_string = str_replace('$ud', $description, $placeholder_string);
	$placeholder_string = str_replace('$ua', $author, $placeholder_string);
	$placeholder_string = str_replace('$ue', $datetime, $placeholder_string);
	$placeholder_string = str_replace('$uc', $copyright, $placeholder_string);
	$placeholder_string = str_replace('$us', $source, $placeholder_string);
	$placeholder_string = str_replace('$ui', $info, $placeholder_string);
	$placeholder_string = str_replace('$uo', $comment, $placeholder_string);
	$placeholder_string = str_replace('$lat', $latitude, $placeholder_string);
	$placeholder_string = str_replace('$lng', $longitude, $placeholder_string);
	return $placeholder_string;
}

function ggsw_attribute_set_true($attribute)
{
	if (isset($attribute) && ($attribute == 'true' || $attribute == '1'))
		return true;
	else 
		return false;
}

function ggsw_attribute_set_false($attribute)
{
	if (isset($attribute) && ($attribute == 'false' || $attribute == '0'))
		return true;
	else 
		return false;
}

function ggsw_ggpkg_html($attributes)
{
	// list of attributes:
	//		id (mandatory)								- identifies package
	//		package_url (madatory)						- url of package path
	//		package_title (mandatory)					- title of package (without .ggpkg)
	//		width (mandatory)							- width of player
	//		height (mandatory)							- height of player
	//		gyro (optional)								- use gyro on handheld devices
	//		gyro_north (optional)						- use true north for gyro
	//		gyro_file (optional)						- url of gyro js file
	//		player_file (mandatory)						- url of package player
	//		global_player (optional)					- url of an external player file
	//		start_preview (optional)					- if player starts as preview image
	//		preview_file (optional)						- url of preview image
	//		preview_play_file (optional)				- url of play button image
	//		has_skin (optional)							- if package contains skin file
	// 		skin_file (optional)						- url of package skin
	//		is_pano	(mandatory)							- if package contains pano2vr or object2vr
	//		xml_file (mandatory)						- url of package xml file
	// 		xml_file_local (mandatory)					- local path of package xml file
	//		userdata_html (optional)					- html code for userdata
	//		userdata_only (optional)					- display userdata instead of pano/object
	//		map_only (optional)							- display map instead of pano
	//		display_userdata (optional)					- if userdata should be displayed below pano/object (default=false)
	//		display_map (optional)						- if map should be displayed below pano (default=false)
	//		masterpanorama_dir (optional)				- url of masterpanorama dir
	//		player_from_masterpanorama (optional) 		- if player from masterpano should be used
	//		player_file_from_masterpanorama (optional)	- url of masterpano player
	//		skin_from_masterpanorama (optional)			- if skin from masterpanorama should be used
	//		skin_file_from_masterpanorama (optional)	- url of masterpano skin
	//		masterobject_dir (optional)					- url of masterobject dir
	//		player_from_masterobject (optional) 		- if player from masterobject should be used
	//		player_file_from_masterobject (optional)	- url of masterobject player
	//		skin_from_masterobject (optional)			- if skin from masterobject should be used
	//		skin_file_from_masterobject (optional)		- url of masterobject skin
	//		error_missing_xml							- error text for missing xml
	//		error_html5_required						- error text for missing html5
	// 		error_javascript_required					- error text for missing javascript
	//		async_loading (optional)					- if set and true, asynchronous loading is used

	$ID = $attributes['id'];

	$width = $attributes['width'];
	$height = $attributes['height'];
	if (is_numeric($width))
		$width = $width . "px";
	if (is_numeric($height))
		$height = $height . "px";
	
	if (isset($attributes['has_skin']) && ggsw_attribute_set_true($attributes['has_skin']))
		$has_skin = true;
	else
		$has_skin = false;

	if (isset($attributes['is_pano']) && isset($attributes['xml_file']) && ggsw_attribute_set_true($attributes['is_pano']))
	{
		$XMLFile = $attributes['xml_file'];
		$is_pano = true;
	}
	else if (isset($attributes['is_pano']) && isset($attributes['xml_file']) && ggsw_attribute_set_false($attributes['is_pano']))
	{
		$XMLFile = $attributes['xml_file'];
		$is_pano = false;
	}
	else
	{
		return $attributes['error_missing_xml'];
	}
	
	$gyro = false;
	if (isset($attributes['gyro']) && ggsw_attribute_set_true($attributes['gyro']))
		$gyro = true;

	$gyro_north = false;
	if (isset($attributes['gyro_north']) && ggsw_attribute_set_true($attributes['gyro_north']))
		$gyro_north = true;

	if (isset($attributes['map_only']) && ggsw_attribute_set_true($attributes['map_only']))
	{
		if (ggsw_has_coordinates($attributes['xml_file_local']))
			$html = ggsw_map_html($ID, $width, $height, $attributes['xml_file_local'], !(isset($attributes['start_preview']) && ggsw_attribute_set_true($attributes['start_preview'])));
		else 
			$html = "";
	}
	else if (isset($attributes['userdata_only']) && ggsw_attribute_set_true($attributes['userdata_only']))
	{
		$userdata = $attributes['userdata_html'];
		$userdata = ggsw_convert_placeholders($userdata, $attributes['xml_file_local']);
		$html = $userdata;
	}
	else
	{
		if (isset($attributes['display_userdata']) && ggsw_attribute_set_true($attributes['display_userdata']))
			$display_userdata = true;
		else
			$display_userdata =	false;
			
		if (isset($attributes['display_map']) && ggsw_attribute_set_true($attributes['display_map']) && ggsw_has_coordinates($attributes['xml_file_local']))
			$display_map = true;
		else
			$display_map = false;
			
		if (isset($attributes['player_from_masterpanorama']) && ggsw_attribute_set_true($attributes['player_from_masterpanorama']))
			$master_panoplayer = true;
		else
			$master_panoplayer = false;

		if (isset($attributes['skin_from_masterpanorama']) && ggsw_attribute_set_true($attributes['skin_from_masterpanorama']))
			$master_panoskin = true;
		else
			$master_panoskin = false;

		if (isset($attributes['player_from_masterobject']) && ggsw_attribute_set_true($attributes['player_from_masterobject']))
			$master_objectplayer = true;
		else
			$master_objectplayer = false;

		if (isset($attributes['skin_from_masterobject']) && ggsw_attribute_set_true($attributes['skin_from_masterobject']))
			$master_objectskin = true;
		else
			$master_objectskin = false;

		$html = "<div id='container" . $ID ."' style='width:" . $width . "; height:" . $height . "; position: relative;'>";
		if (isset($attributes['start_preview']) && ggsw_attribute_set_true($attributes['start_preview']))
		{
			$html .= "<div style='width:100%; height:100%; overflow: hidden; position:relative;'>";
			$html .= "<img src='" . $attributes['preview_file'] . "' alt='GGPKG Preview Image' onclick='startPlayer" . $ID . "();'style='min-width:100%; max-width: 10000px; min-height: 100%; max-height: 10000px; position: absolute;'>";
			if (substr($width, strlen($width)-1) == '%')
				$html .= "<img src='" . $attributes['preview_play_file'] . "' alt='GGPKG Preview Image' onclick='startPlayer" . $ID . "();' style='width: 120px; height: 120px; display: block; top: " . strval($height/2 - 60) . "px; left: 50%; margin-left: -60px; box-shadow: none; position: absolute;'>";
			else
				$html .= "<img src='" . $attributes['preview_play_file'] . "' alt='GGPKG Preview Image' onclick='startPlayer" . $ID . "();' style='width: 120px; height: 120px; display: block; top: " . strval($height/2 - 60) . "px; left: " . strval($width/2 - 60) . "px; box-shadow: none; position: absolute;'>";
			$html .= "</div>";
		}
		else
			$html .= $attributes['error_html5_required'];
		$html .= "</div>";

		if ($is_pano) // Pano2VR Content
		{
			if (isset($attributes['global_player']))
				$html .= "<script type='text/javascript' src='" . $attributes['global_player'] . "'></script>";
			else if ($master_panoplayer)
				$html .= "<script type='text/javascript' src='" . $attributes['player_file_from_masterpanorama'] . "'></script>";
			else
				$html .= "<script type='text/javascript' src='" . $attributes['player_file'] . "'></script>";
			if ($has_skin)
			{
				if ($master_panoskin)
					$html .= "<script type='text/javascript' src='" . $attributes['skin_file_from_masterpanorama'] . "'></script>";
				else
					$html .= "<script type='text/javascript' src='" . $attributes['skin_file'] . "'></script>";
			}
			if ($gyro)
			{
				$html .= "<script type='text/javascript' src='" . $attributes['gyro_file']. "'></script>";
			}

			$html .= "<script type='text/javascript'>";
				
			$play_js = "if (ggHasHtml5Css3D() || ggHasWebGL()) {";
			if ($master_panoplayer)
			{
				$play_js .= "if  (typeof " . $attributes['master_pano'] . "_pano2vrPlayer != 'undefined') ";
				$play_js .= "pano" . $ID . "=new " . $attributes['master_pano'] . "_pano2vrPlayer('container" . $ID . "');";
				$play_js .= "else ";
				$play_js .= "pano" . $ID . "=new pano2vrPlayer('container" . $ID . "');";
			}
			else
			{
				$play_js .= "if  (typeof " . $attributes['package_title'] . "_pano2vrPlayer != 'undefined') ";
				$play_js .= "pano" . $ID . "=new " . $attributes['package_title'] . "_pano2vrPlayer('container" . $ID . "');";
				$play_js .= "else ";
				$play_js .= "pano" . $ID . "=new pano2vrPlayer('container" . $ID . "');";
			}
			if ($has_skin)
			{
				if ($master_panoskin)
				{
					$play_js .= "if  (typeof " . $attributes['master_pano'] . "_pano2vrSkin != 'undefined') ";
					$play_js .= "skin" . $ID . "=new " . $attributes['master_pano'] . "_pano2vrSkin(pano" . $ID . ", '" . $attributes['masterpanorama_dir'] . "');";
					$play_js .= "else ";
					$play_js .= "skin" . $ID . "=new pano2vrSkin(pano" . $ID . ", '" . $attributes['masterpanorama_dir'] . "');";
				}
				else
				{
					$play_js .= "if  (typeof " . $attributes['package_title'] . "_pano2vrSkin != 'undefined') ";
					$play_js .= "skin" . $ID . "=new " . $attributes['package_title'] . "_pano2vrSkin(pano" . $ID . ", '" . $attributes['package_url'] . "');";
					$play_js .= "else ";
					$play_js .= "skin" . $ID . "=new pano2vrSkin(pano" . $ID . ", '" . $attributes['package_url'] . "');";
				}
			}
			if (isset($attributes['async_loading']) && ggsw_attribute_set_true($attributes['async_loading']))
			{
				if (isset($attributes['start_preview']) && ggsw_attribute_set_false($attributes['start_preview']))
				{
					$play_js .= "window.addEventListener('load', function() {";
				}
				if ($gyro)
				{
					$gyro_function = "gyro" . $ID . "=new pano2vrGyro(pano" . $ID . ", 'container" . $ID . "');";
					if ($gyro_north)
					{
						$gyro_function .= "gyro" . $ID . ".setTrueNorth(true);";
					}
					$play_js .= "pano" . $ID . ".readConfigUrlAsync('" . $attributes['xml_file'] . "', function() {" . $gyro_function . "});";
				}
				else 
				{
					$play_js .= "pano" . $ID . ".readConfigUrlAsync('" . $attributes['xml_file'] . "');";
				}
				if (isset($attributes['start_preview']) && ggsw_attribute_set_false($attributes['start_preview']))
				{
					$play_js .= "});";
				}
			}
			else
			{
				$play_js .= "pano" . $ID . ".readConfigUrl('" . $attributes['xml_file'] . "');";
				if ($gyro)
				{
					$play_js .= "gyro" . $ID . "=new pano2vrGyro(pano" . $ID . ", 'container" . $ID . "');";
				}
				if ($gyro_north)
				{
					$play_js .= "gyro" . $ID . ".setTrueNorth(true);";
				}
			}
			$play_js .= "} else if (swfobject.hasFlashPlayerVersion('10.0.0')) {";
			$play_js .= "var flashvars = {};";
			$play_js .= "var params = {};";
			$play_js .= "function ggXmlReady() { initMap" . $ID . "();  };";
			$play_js .= "flashvars.externalinterface='1';";
			$play_js .= "params.quality = 'high';";
			$play_js .= "params.bgcolor = '#ffffff';";
			$play_js .= "params.allowscriptaccess = 'sameDomain';";
			$play_js .= "params.allowfullscreen = 'true';";
			$play_js .= "var attributes = {};";
			$play_js .= "attributes.id = 'pano" . $ID . "';";
			$play_js .= "attributes.name = 'pano" . $ID . "';";
			$play_js .= "attributes.align = 'middle';";
			$play_js .= "flashvars.panoxml= '" . $attributes['xml_file'] . "';";
			if ($has_skin)
			{
				if ($master_panoskin)
					$play_js .= "flashvars.skinxml= '" . str_replace('skin.js', 'skin.xml', $attributes['skin_file_from_masterpanorama']) . "';";
				else
					$play_js .= "flashvars.skinxml= '" . str_replace('skin.js', 'skin.xml', $attributes['skin_file']) . "';";
			}
			$play_js .= "params.base='" . $attributes['package_url'] . "';";
			$play_js .= "swfobject.embedSWF(";
			$play_js .= "'" . $attributes['package_url'] . "/pano2vr_player.swf', 'container" . $ID . "',";
			$play_js .= "'" . $width . "', '" . $height . "',";
			$play_js .= "'10.0.0', '',";
			$play_js .= "flashvars, params, attributes);";
			$play_js .= "}";
		}
		else // Object2VR Content
		{
			if (isset($attributes['global_player']))
				$html .= "<script type='text/javascript' src='" . $attributes['global_player'] . "'></script>";
			else if ($master_objectplayer)
				$html .= "<script type='text/javascript' src='" . $attributes['player_file_from_masterobject'] . "'></script>";
			else
				$html .= "<script type='text/javascript' src='" . $attributes['player_file'] . "'></script>";
			if ($has_skin)
			{
				if ($master_objectskin)
					$html .= "<script type='text/javascript' src='" . $attributes['skin_file_from_masterobject'] . "'></script>";
				else
					$html .= "<script type='text/javascript' src='" . $attributes['skin_file'] . "'></script>";
			}
			$html .= "<script type='text/javascript'>";
			
			$play_js = "if ((!ggHasCanvas) || ggHasCanvas()) {";
			if ($master_objectplayer)
			{
				$play_js .= "if  (typeof " . $attributes['master_object'] . "_object2vrPlayer != 'undefined') ";
				$play_js .= "object" . $ID . "=new " . $attributes['master_object'] . "_object2vrPlayer('container" . $ID . "');";
				$play_js .= "else ";
				$play_js .= "object" . $ID . "=new object2vrPlayer('container" . $ID . "');";
			}
			else
			{
				$play_js .= "if  (typeof " . $attributes['package_title'] . "_object2vrPlayer != 'undefined') ";
				$play_js .= "object" . $ID . "=new " . $attributes['package_title'] . "_object2vrPlayer('container" . $ID . "');";
				$play_js .= "else ";
				$play_js .= "object" . $ID . "=new object2vrPlayer('container" . $ID . "');";
			}
			if ($has_skin)
			{
				if ($master_objectskin)
				{
					$play_js .= "if  (typeof " . $attributes['master_object'] . "_object2vrSkin != 'undefined') ";
					$play_js .= "skin" . $ID . "=new " . $attributes['master_object'] . "_object2vrSkin(object" . $ID . ", '" . $attributes['masterobject_dir'] . "/');";
					$play_js .= "else ";
					$play_js .= "skin" . $ID . "=new object2vrSkin(object" . $ID . ", '" . $attributes['masterobject_dir'] . "/');";
				}
				else
				{
					$play_js .= "if  (typeof " . $attributes['package_title'] . "_object2vrSkin != 'undefined') ";
					$play_js .= "skin" . $ID . "=new " . $attributes['package_title'] . "_object2vrSkin(object" . $ID . ", '" . $attributes['package_url'] . "/');";
					$play_js .= "else ";
					$play_js .= "skin" . $ID . "=new object2vrSkin(object" . $ID . ", '" . $attributes['package_url'] . "/');";
				}
			}
			if (isset($attributes['async_loading']) && ggsw_attribute_set_true($attributes['async_loading']))
			{
				$play_js .= "window.addEventListener('load', function() {";
				$play_js .= "object" . $ID . ".readConfigUrlAsync('" . $attributes['xml_file'] . "');";
				$play_js .= "});";
			}
			else 
			{
				$play_js .= "object" . $ID . ".readConfigUrl('" . $attributes['xml_file'] . "');";
			}
			$play_js .= "} else if (swfobject.hasFlashPlayerVersion('9.0.0')) {";
			$play_js .= "var flashvars = {};";
			$play_js .= "var params = {};";
			$play_js .= "flashvars.externalinterface='1';";
			$play_js .= "params.quality = 'high';";
			$play_js .= "params.bgcolor = '#ffffff';";
			$play_js .= "params.allowscriptaccess = 'sameDomain';";
			$play_js .= "params.allowfullscreen = 'true';";
			$play_js .= "var attributes = {};";
			$play_js .= "attributes.id = 'object" . $ID . "';";
			$play_js .= "attributes.name = 'object" . $ID . "';";
			$play_js .= "attributes.align = 'middle';";
			$play_js .= "flashvars.objxml= '" . $attributes['xml_file'] . "';";
			if ($has_skin)
			{
				if ($master_objectskin)
					$play_js .= "flashvars.skinxml= '" . str_replace('skin.js', 'skin.xml', $attributes['skin_file_from_masterobject']) . "';";
				else
					$play_js .= "flashvars.skinxml= '" . str_replace('skin.js', 'skin.xml', $attributes['skin_file']) . "';";
			}
			$play_js .= "params.base='" . $attributes['package_url'] . "';";
			$play_js .= "swfobject.embedSWF(";
			$play_js .= "'" . $attributes['package_url'] . "/object2vr_player.swf', 'container" . $ID . "',";
			$play_js .= "'" . $width . "', '" . $height . "',";
			$play_js .= "'9.0.0', '',";
			$play_js .= "flashvars, params, attributes);";
			$play_js .= "}";
		}
		
		if (isset($attributes['start_preview']) && ggsw_attribute_set_true($attributes['start_preview']))
		{
			$html .= "function startPlayer" . $ID . "() {";
			$html .= $play_js;
			$html .= "if (typeof(placeMarkers" . $ID . ") !== 'undefined' && typeof(placeMarkers" . $ID . ") === 'function')";
			$html .= "placeMarkers" . $ID ."();";
			$html .= "if (typeof(updateRadar" . $ID . ") !== 'undefined' && typeof(updateRadar" . $ID . ") === 'function')";
			$html .= "setInterval(function() { updateRadar" . $ID . "(); }, 50);";
			$html .= "}";
		}
		else
			$html .= $play_js;
		
		$html .= "</script>";
		$html .= "<noscript>";
		$html .= "<p><b>" . $attributes['error_javascript_required'] . "</b></p>";
		$html .= "</noscript>";
		
		if($display_userdata)
		{
			$userdata = $attributes['userdata_html'];
			$userdata = ggsw_convert_placeholders($userdata, $attributes['xml_file_local']);
			$html.= "<br>" . $userdata;
		}

		if ($display_map)
			$html .= "<br>" . ggsw_map_html($ID, $width, $height, $attributes['xml_file_local'], !(isset($attributes['start_preview']) && ggsw_attribute_set_true($attributes['start_preview'])));
	}
	return $html;
}


function ggsw_map_html($ID, $width, $height, $xml_file, $start_radar)
{
	$xmlpano = ggsw_get_xmlpano($xml_file);
	if (isset($xmlpano->error))
		return $xmlpano->error;
	$latitude = $xmlpano->userdata['latitude'];
	$longitude = $xmlpano->userdata['longitude'];
	
	//$html = "<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=true'></script>";
	$html = "<div id='mapdiv" . $ID . "' style='width:" . $width . "; height:" . $height . "'>map goes here!</div>";
	$html .= "<script type='text/javascript'>";
	$html .= "window.addEventListener('load', function() { initMap" . $ID . "(); });";
	$html .= "var lastFov" . $ID . " = -1;";
	$html .= "var lastPan" . $ID . " = -1;";
	$html .= "var lastZoom" . $ID . " = -1;";
	$html .= "var radar" . $ID . " = null;";
	$html .= "var activeNodeLatLng" . $ID . ";";
	$html .= "var map" . $ID . ";";
	// ----- function placeMarkers()
	$html .= "function placeMarkers" . $ID . "()";
	$html .= "{";
	$html .= "var ids=pano" . $ID . ".getNodeIds();";
	$html .= "var marker;";
	$html .= "var markerLocation;";
	$html .= "var bounds=new google.maps.LatLngBounds();";
	$html .= "for(var i=0;i<ids.length;i++) {";
	$html .= "var id=ids[i];";
	$html .= "var gps=pano" . $ID . ".getNodeLatLng(id);";
	$html .= "if ((gps.length>=2) && ((gps[0]!=0) || (gps[1]!=0))) {";
	$html .= "markerLocation = new google.maps.LatLng(gps[0], gps[1]);";
	$html .= "marker = new google.maps.Marker({position: markerLocation,map: map" . $ID . "});";
	$html .= "marker.setTitle(pano" . $ID . ".getNodeTitle(id));";
	$html .= "marker.setAnimation(google.maps.Animation.DROP);";
	$html .= "marker.setClickable(true);";
	$html .= "marker.ggId=id;";
	$html .= "bounds.extend(markerLocation);";
	$html .= "google.maps.event.addListener(marker, 'click', function() {";
	$html .= "pano" . $ID . ".openNext('{' + this.ggId + '}');";
	$html .= "activeNodeLatLng" . $ID . "=this.position;";
	$html .= "lastFov" . $ID . "=-1;";
	$html .= "});";
	$html .= "}";
	$html .= "}";
	$html .= "if (!bounds.isEmpty()) {";
	$html .= "map" . $ID . ".fitBounds(bounds);";
	$html .= "}";
	$html .= "}";
	// ----- function updateRadar()
	$html .= "function updateRadar" . $ID . "()";
	$html .= "{";
	$html .= "if ((!activeNodeLatLng" . $ID . ") || (!pano" . $ID . ") || (!map" . $ID . ")) return;";
	$html .= "var d2r = Math.PI/180 ;";
	$html .= "var r2d = 180/Math.PI ;";
	$html .= "var fov = pano" . $ID . ".getFov();";
	$html .= "var pan = pano" . $ID . ".getPanNorth();";
	$html .= "var zoom = map" . $ID . ".getZoom();";
	$html .= "var gps=pano" . $ID . ".getNodeLatLng('');";
	$html .= "if ((gps.length>=2) && ((gps[0]!=0) || (gps[1]!=0))) {";
	$html .= "if (zoom<6) zoom = 6;";
	$html .= "if ((fov==lastFov" . $ID . ") && (pan==lastPan" . $ID . ") && (zoom==lastZoom" . $ID . ") && (gps[0]==activeNodeLatLng" . $ID . ".lat()) && (gps[1]==activeNodeLatLng" . $ID . ".lng())) return;";
	$html .= "lastPan" . $ID . "=pan;";
	$html .= "lastFov" . $ID . "=fov;";
	$html .= "lastZoom" . $ID . "=zoom;";
	$html .= "activeNodeLatLng" . $ID . " = new google.maps.LatLng(gps[0], gps[1]);";
	$html .= "var rLat = " . min($width, $height)/130 . "*r2d / Math.pow(2,zoom);";
	$html .= "var rLng = rLat/Math.cos(activeNodeLatLng" . $ID . ".lat() * d2r);";
	$html .= "var radar_poly = new Array();";
	$html .= "radar_poly.push(activeNodeLatLng" . $ID . ");";
	$html .= "var segments=5;";
	$html .= "for (i=-segments; i<=segments; i++) {";
	$html .= "var angle = (fov / (2*segments)) * i;";
	$html .= "var x = -rLng * Math.sin((pan+angle)*d2r) + activeNodeLatLng" . $ID . ".lng();";
	$html .= "var y =  rLat * Math.cos((pan+angle)*d2r) + activeNodeLatLng" . $ID . ".lat();";
	$html .= "radar_poly.push(new google.maps.LatLng(y, x));";
	$html .= "}";
	$html .= "if (radar" . $ID . ") {";
	$html .= "radar" . $ID . ".setMap(null);";
	$html .= "radar" . $ID . " = null;";
	$html .= "}";
	$html .= "radar" . $ID . " = new google.maps.Polygon({";
	$html .= "paths: radar_poly,";
	$html .= "strokeColor: '#000000',";
	$html .= "strokeOpacity: 0.8,";
	$html .= "strokeWeight: 1,";
	$html .= "fillColor: '#000000',";
	$html .= "fillOpacity: 0.35";
	$html .= "});";
	$html .= "radar" . $ID . ".setMap(map" . $ID . ");";
	$html .= "} else {";
	$html .= "if (radar" . $ID . ") {";
	$html .= "activeNodeLatLng" . $ID . " = new google.maps.LatLng(0,0);";
	$html .= "radar" . $ID . ".setMap(null);";
	$html .= "radar" . $ID . " = null;";
	$html .= "}";
	$html .= "}";
	$html .= "}";
	// ----- function initMap()
	$html .= "function initMap" . $ID . "() {";
	if ($latitude!='' && $longitude!='')
		$html .= "activeNodeLatLng" . $ID . " = new google.maps.LatLng(" . $latitude . ", " . $longitude . ");";
	else
		$html .= "activeNodeLatLng" . $ID . " = new google.maps.LatLng(0,0);";
	$html .= "var mapOptions = {";
	$html .= "zoom: 14,";
	$html .= "center: activeNodeLatLng" . $ID . ",";
	$html .= "mapTypeId: google.maps.MapTypeId.HYBRID,";
	$html .= "streetViewControl: false";
	$html .= "};";
	$html .= "map" . $ID . " = new google.maps.Map(document.getElementById('mapdiv" . $ID . "'), mapOptions);";
	if ($start_radar)
	{
		$html .= "placeMarkers" .$ID . "();";
		$html .= "setInterval(function() { updateRadar" . $ID . "(); }, 50);";
	}
	$html .= "}";
	$html .= "</script>";

	return $html;
}
?>