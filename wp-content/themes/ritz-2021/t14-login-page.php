<?php
// Template Name: T14 Menu Upload Page
global $template_name;

$template_name = 'T14 Menu Upload Page';

global $ritz_template_name;
$ritz_template_name = 'ritz-old-template';



function url()
{
	if (isset($_SERVER['HTTPS'])) {
		$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	} else {
		$protocol = 'http';
	}
	return $protocol . "://" . $_SERVER['SERVER_NAME'];
}

get_header();
?>
<style>
    .container {
        padding-top: 2em;
        padding-bottom: 2em;
    }

    .login-form a {
        font-weight: 600;
    }

    .container, div {
        line-height: 1.3;
    }

    .menus-form {
        padding-top: 2em;
        padding-bottom: 2em;
    }

    th {
        font-weight: 600;
        text-align: left;
        text-decoration: underline;
        border: 1px solid grey;
    }

    td {
        padding-right: 1em;
        padding-left: 1em;
        border: 1px solid grey;
        vertical-align: middle;
    }
</style>
<div class="container grid-container">
    <h2>Editor for the Ritz Hotel Menus</h2>
    <div class="login-form">
		<?php

		do_shortcode('[wpam]');

		?>
    </div>
    <div class="menus-form">
		<?php
		$account = new Account;
		$loggedIn = $account->sessionLogin();
		//$loggedIn = true;
		if ($loggedIn) {
			if (have_rows('restaurant_menus', 'option')) :
				?>
                <h3>Restaurant Menus</h3>
                <table>
                    <tr>
                        <th>Menu Name</th>
                        <th>Choose File</th>
                        <th>Replace Menu</th>
                        <th>Link to Menu</th>
                        <th>QR Code</th>
                    </tr>
					<?php
					$i = 1;
					while (have_rows('restaurant_menus', 'option')) : the_row();
						$redirect_address = get_sub_field('redirect_address');
						$menu_file = get_sub_field('menu_file');
						$menu_name = get_sub_field('menu_name');
						?>
                        <tr>
                            <form action="<?php echo get_stylesheet_directory_uri(); ?>/functions/process_menu_upload.php" method="post" enctype="multipart/form-data">
                                <td>
									<?php echo $menu_name; ?>
                                </td>
                                <td>
                                    <input type="hidden" value="yes" name="menu-return">
                                    <input type="hidden" value="<?php echo $i; ?>" name="menu-index">
                                    <input type="file" name="profilepicture" size="25"/>
                                </td>
                                <td>
                                    <input type="submit" name="submit" value="Replace"/>
                                </td>
                                <td>
									<?php
									echo url() . '/' . trim($redirect_address, '/');
									?>
                                    <br>
                                    <a href="<?php echo url() . '/' . trim($redirect_address, '/'); ?>" target="_blank">Click to view</a>
                                </td>
                                <td><img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=<?php echo urldecode(url() . '/' . trim($redirect_address, '/') . '/'); ?>&choe=UTF-8" ?></td>
                            </form>
                        </tr>
						<?php
						$i++;
					endwhile;
					?>
                </table>
			<?php
			endif;

		}
		?>
    </div>
</div>
<?php get_footer(); ?>
