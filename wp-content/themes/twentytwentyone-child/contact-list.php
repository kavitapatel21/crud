<?php 

/* Template Name: Contact List */ 
get_header();
the_content();
	echo '<div class="table-view">';
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
	echo '</div>';

get_footer();

?>