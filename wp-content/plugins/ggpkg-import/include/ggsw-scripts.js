jQuery(document).ready(function() {
	var fileInput = '';
	jQuery('#ggsw_player_master_pano_button').click(function() {
		 fileInput = '#ggsw_player_master_pano';
		 formfield = jQuery('#ggsw_player_master_pano').attr('name');
		 tb_show('', 'media-upload.php?TB_iframe=true');
		 return false;
		});

	jQuery('#ggsw_player_master_object_button').click(function() {
		 fileInput = '#ggsw_player_master_object';
		 formfield = jQuery('#ggsw_player_master_object').attr('name');
		 tb_show('', 'media-upload.php?TB_iframe=true');
		 return false;
		});

	window.send_to_editor = function(html) {
	 imgurl = jQuery(html).attr('href');
	 jQuery(fileInput).val(imgurl);
	 tb_remove();
	};
});