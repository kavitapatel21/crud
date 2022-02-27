<?php 
/* Child theme generated with WPS Child Theme Generator */
            
if ( ! function_exists( 'b7ectg_theme_enqueue_styles' ) ) {            
    add_action( 'wp_enqueue_scripts', 'b7ectg_theme_enqueue_styles' );
    
    function b7ectg_theme_enqueue_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
    }
}
?>
<?php
function twenty_twenty_onechild_scripts() {
	
	wp_enqueue_style( 'twenty-twenty-one-style', get_stylesheet_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_onechild_scripts' );

/* valid form */
function twentytwentyone_add_child_class() {
	?>
	<style type="text/css">
		form#myForm input {
		    width: 100%;
		}
		form#myForm label {
		    color:red;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>	
	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}

	jQuery(document).ready(function () {
		jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
		    phone_number = phone_number.replace(/\s+/g, "");
		    return this.optional(element) || phone_number.length > 9 && 
		    phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
		}, "Please enter a valid phone number");

		jQuery("#myForm").validate({
	        rules: {
	            fname: {
	                required:true,
	                minlength: 5,
	                maxlength: 20,
	            },
	            lname : {
	                required:true,
	                minlength: 5,
	                maxlength: 20,
	            },
	            email: {
	                required:true,
	                email: true
	            },
	            phone: {
	            	required:true,
	                phoneUS:true
	            },
	            comments: {
	                required:true,
	            }
	        },

	    });
		jQuery('#submit').click( function() {			
		 	var valid = jQuery("#myForm").valid();

		 	var fname = jQuery("#fname").val();
		 	var lname = jQuery("#lname").val();
		 	var email = jQuery("#email").val();
		 	var phone = jQuery("#phone").val();
		 	var message = jQuery("#message").val();
		 	//console.log(valid);
		 	if (valid === true) {		 		
			    jQuery.ajax({
			        url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			        type: 'POST',
			        dataType: 'json',	        
			        data: {
			        	action: 'data_submit',
			        	fname : fname,
						lname : lname,
						email : email,
						phone : phone,
						message : message,
			        },
			        complete: function () {
						jQuery('#reset').click();
						jQuery('.success').text('Your message was sent successfully')
					}
			    });
		 	}
		});
	});
	</script>
	<?php
}
add_action( 'wp_footer', 'twentytwentyone_add_child_class' );

/* contact_form shortcode */
add_shortcode('contact_form','contact_form_shortcode');
function contact_form_shortcode(){	
?>
	<h3 class="inquiry-title">Submite Your Inquiry</h3>
	<form id="myForm" method="post">
	    <input type="text" id="fname"  name="fname" placeholder="First Name">
		<input type="text" id="lname"  name="lname" placeholder="Last Name">
		<input type="text" id="email"  name="email" placeholder="Email">
		<input type="text" id="phone"  name="phone" placeholder="Phone">
		<textarea name="comments" id="message" placeholder="Message"></textarea>
		<input name="reset" type="reset" id="reset" value="Reset" style="display:none">
		<input id="submit" type="button" name="save" value="Submit">
		<div class="success" style="color:green"></div>    
	</form>	
<?php	
}

/* Submite Data */
add_action('wp_ajax_data_submit' , 'data_submit');
add_action('wp_ajax_nopriv_data_submit','data_submit');
function data_submit(){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];
	$name = $fname.' '.$lname;
	$args = array(
		'post_type' => 'inquiry',
		'post_status' => 'publish',
		'post_title' => $name,		
	);
	$post_id = wp_insert_post($args);
	add_post_meta($post_id, 'email', $email, true);
	add_post_meta($post_id, 'phone', $phone, true);
	add_post_meta($post_id, 'message', $message, true);	
	wp_die();
}

function my_admin_menu() {
	add_menu_page(
		__( 'Contact List', 'plutus' ),
		__( 'Contact List', 'plutus' ),
		'manage_options',
		'contact-list',
		'contact_list_contents',
		'dashicons-editor-ul',
		5
	);
}
add_action( 'admin_menu', 'my_admin_menu' );
function contact_list_contents() {
	echo '<style>
	table {
	  font-family: arial, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	td, th {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
	}

	tr:nth-child(even) {
	  background-color: #dddddd;
	}
	</style>';
	echo '<h3 style="padding-top:50px;font-size:32px;">All Submitted Inquiry</h3>';
	$args = array(
		'post_type' => 'inquiry',
		'posts_per_page' => -1
	);
	$query = new WP_Query($args);
	if ($query->have_posts() ) :

		echo '<table>
			<tr>
				<th>ID</th>
				<th>Full Name</th>				
				<th>Email</th>				
				<th>Phone</th>				
				<th>Comments</th>				
			</tr>';		
			$a = 1;
			while ( $query->have_posts() ) : $query->the_post();
				$id = get_the_ID();
				$name = get_the_title();
				$email = get_post_meta(get_the_ID(), 'email');
				$phone = get_post_meta(get_the_ID(), 'phone');
				$comments = get_post_meta(get_the_ID(), 'message');				
				echo '<tr>
					<td>'. $a .'</td>
					<td>'. $name .'</td>
					<td>'. $email[0] .'</td>
					<td>'. $phone[0] .'</td>
					<td>'. $comments[0] .'</td>
				</tr>';
			$a++;
			endwhile;
		echo '</table>';
	wp_reset_postdata();
	endif;	
}
?>
