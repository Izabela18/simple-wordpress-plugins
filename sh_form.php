<?php
/*
Plugin Name: CMS 2 Labb 2 Contact Form
Description: Simple  Contact Form
Version: 1.0.0
Author: Izabela Walczak-Niznik

*/



    function post_form($placeholder) {


    	echo '<form action="' .  esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
    	echo '<p>';
    	echo 'Your Name (required) <br/>';
    	echo '<input class="inp" type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) . '" size="40" />';
    	echo '</p>';
    	echo '<p>';
    	echo 'Your Email (required) <br/>';
    	echo '<input class="inp" type="email" name="cf-email" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" size="40" />';
    	echo '</p>';
    	echo '<p>';
    	echo 'Subject (required) <br/>';
    	echo '<input class="inp" type="text" name="cf-subject" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["cf-subject"] ) ? esc_attr( $_POST["cf-subject"] ) : '' ) . '" size="40" />';
    	echo '</p>';
    	echo '<p>';
    	echo 'Your Message (required) <br/>';
    	echo '<textarea rows="10" cols="35" name="cf-message" placeholder="'.$placeholder.'">' . ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' ) . '</textarea>';
    	echo '</p>';
    	echo '<p><input class="inp" type="submit" name="cf-submitted" value="Send"></p>';
    	echo '</form>';
    }


    function deliver_mail($to, $success) {

    // if the submit button is clicked, send the email
    if ( isset( $_POST['cf-submitted'] ) ) {

        // sanitize form values
        $name    = sanitize_text_field( $_POST["cf-name"] );
        $email   = sanitize_email( $_POST["cf-email"] );
        $subject = sanitize_text_field( $_POST["cf-subject"] );
        $message = esc_textarea( $_POST["cf-message"] );


        $headers = "From: $name <$email>" . "\r\n";


        // If email has been process for sending, display a success message
        if ( wp_mail( $to, $subject, $message, $headers ) ) {
            echo '<div>';
            echo '<p>'.$success.'</p>';
            echo '</div>';
        } else {
            echo 'An unexpected error occurred';
        }
    }
}



  function cf_shortcode($atts) {

      ob_start();
      wp_enqueue_style( 'cf-style' );

      extract( shortcode_atts( array(
          // if you don't provide an e-mail address, the shortcode will pick the e-mail address of the admin:
          'to' => get_option( 'admin_email' ),
          'placeholder' => "Write your message here",
          'success' => "Thanks for your e-mail! We'll get back to you as soon as we can."
      ), $atts ) );


      post_form($placeholder);
      deliver_mail($to, $success);
      return ob_get_clean();
  }

add_shortcode( 'contact_form', 'cf_shortcode' );

  add_action( 'wp_enqueue_scripts', 'cf_assets' );
  function cf_assets() {
    wp_register_style( 'cf-style', plugin_dir_url( __FILE__ ) . 'css/cf-style.css' );
  }

  ?>
