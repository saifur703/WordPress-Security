## HOW TO RECOVER WORDPRESS PASSWORD USING FTP & A .PHP FILE?

1. Create a file named "password.php"
2. Add below code in the file and save
3. Upload the file in the WordPress site root Folder where WordPress is installed
4. Now access the file to change the password. like: "https://your-website.com/password.php"

```

<?php
/*
	This program is free software; you can redistribute it and/or modify
    	it under the terms of the GNU General Public License as published by
    	the Free Software Foundation; either version 2 of the License, or
    	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
    	but WITHOUT ANY WARRANTY; without even the implied warranty of
    	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
    	along with this program; if not, write to the Free Software
    	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

require './wp-blog-header.php';

function meh() {
	global $wpdb;

	if ( isset( $_POST['update'] ) ) {
		$user_login = ( empty( $_POST['e-name'] ) ? '' : sanitize_user( $_POST['e-name'] ) );
		$user_pass  = ( empty( $_POST[ 'e-pass' ] ) ? '' : $_POST['e-pass'] );
		$answer = ( empty( $user_login ) ? '<div id="message" class="updated fade"><p><strong>The user name field is empty.</strong></p></div>' : '' );
		$answer .= ( empty( $user_pass ) ? '<div id="message" class="updated fade"><p><strong>The password field is empty.</strong></p></div>' : '' );
		if ( $user_login != $wpdb->get_var( "SELECT user_login FROM $wpdb->users WHERE ID = '1' LIMIT 1" ) ) {
			$answer .="<div id='message' class='updated fade'><p><strong>That is not the correct administrator username.</strong></p></div>";
		}
		if ( empty( $answer ) ) {
			$wpdb->query( "UPDATE $wpdb->users SET user_pass = MD5('$user_pass'), user_activation_key = '' WHERE user_login = '$user_login'" );
			$plaintext_pass = $user_pass;
			$message = __( 'Someone, hopefully you, has reset the Administrator password for your WordPress blog. Details follow:' ). "\r\n";
			$message  .= sprintf( __( 'Username: %s' ), $user_login ) . "\r\n";
			$message .= sprintf( __( 'Password: %s' ), $plaintext_pass ) . "\r\n";
			@wp_mail( get_option( 'admin_email' ), sprintf( __( '[%s] Your WordPress administrator password has been changed!' ), get_option( 'blogname' ) ), $message );
			$answer="<div id='message' class='updated fade'><p><strong>Your password has been successfully changed</strong></p><p><strong>An e-mail with this information has been dispatched to the WordPress blog administrator</strong></p><p><strong>You should now delete this file off your server. DO NOT LEAVE IT UP FOR SOMEONE ELSE TO FIND!</strong></p></div>";
		}
	}

	return empty( $answer ) ? false : $answer;
}

$answer = meh();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>WordPress Password Reset</title>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<link rel="stylesheet" href="<?php bloginfo( 'wpurl' ); ?>/wp-admin/wp-admin.css?version=<?php bloginfo( 'version' ); ?>" type="text/css" />
</head>
<body>
	<div class="wrap">
		<form method="post" action="">
			<h2>WordPress Password Reset</h2>
			<p><strong>Use of this file/codes is at your own risk, including the risk that you might be exposed to content that is objectionable, or otherwise inappropriate. All code is provided "as -is", without any warranty, whether express or implied, of its accuracy, completeness. User further acknowledge and agree that No one can be held liable for any loss or damage which may be incurred by the usage of this script. Only the Users will be responsible for any misuse or unauthorized access.</strong></p>
			<p> You must know the Administrator's Username to use this script. (The default username in most cases is "admin")</p>
			<?php
			echo $answer;
			?>
			<p class="submit"><input type="submit" name="update" value="Update Options" /></p>

			<fieldset class="options">
				<legend>WordPress Administrator</legend>
				<label><?php _e( 'Enter Username:' ) ?><br />
					<input type="text" name="e-name" id="e-name" class="input" value="<?php echo attribute_escape( stripslashes( $_POST['e-name'] ) ); ?>" size="20" tabindex="10" /></label>
				</fieldset>
				<fieldset class="options">
					<legend>Password</legend>
					<label><?php _e( 'Enter New Password:' ) ?><br />
					<input type="text" name="e-pass" id="e-pass" class="input" value="<?php echo attribute_escape( stripslashes( $_POST['e-pass'] ) ); ?>" size="25" tabindex="20" /></label>
				</fieldset>

				<p class="submit"><input type="submit" name="update" value="Update Options" /></p>
			</form>
		</div>
	</body>
</html>
<?php exit; ?>

```
