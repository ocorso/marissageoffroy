<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /framework/post-like.php
 * Version of this file : 1.7
 *
 *
 * BASED ON THE wptuts.com article :
 * http://wp.tutsplus.com/tutorials/how-to-create-a-simple-post-rating-system-with-wordpress-and-jquery/
 *
 */
?>
<?php

$timebeforerevote = 10000000000;


	add_action('wp_ajax_nopriv_post-like', 'post_like');
	add_action('wp_ajax_post-like', 'post_like');
	add_action( 'wp_enqueue_scripts', 'like_JS' );
	function like_JS() {
		wp_enqueue_script( 'like_post', get_template_directory_uri() . '/js/ajax-like.js', array( 'jquery' ),null, false );
		wp_localize_script('like_post', 'ajax_var', array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax-nonce')
		));
	}

	function post_like() {
		$nonce = $_POST['nonce'];
	    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
	        die ( 'Busted!');

		if(isset($_POST['post_like'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
			$post_id = $_POST['post_id'];

			$meta_IP = get_post_meta($post_id, "voted_IP");

			$voted_IP = $meta_IP[0];
			if(!is_array($voted_IP))
				$voted_IP = array();

			$meta_count = get_post_meta($post_id, "votes_count", true);

			if(!hasAlreadyVoted($post_id)) {
				$voted_IP[$ip] = time();

				update_post_meta($post_id, "voted_IP", $voted_IP);
				update_post_meta($post_id, "votes_count", ++$meta_count);

				echo $meta_count;
			}
		else
			echo "already";
		}
		exit;
	}

	function hasAlreadyVoted($post_id) {
		global $timebeforerevote;

		$meta_IP = get_post_meta($post_id, "voted_IP");
		if(!$meta_IP) $meta_IP=array('0'=>'');
		$voted_IP = $meta_IP[0];
		if(!is_array($voted_IP))
			$voted_IP = array();
		$ip = $_SERVER['REMOTE_ADDR'];

		if(in_array($ip, array_keys($voted_IP))) {
			$time = $voted_IP[$ip];
			$now = time();
			if(round(($now - $time) / 60) > $timebeforerevote)
				return false;
			return true;
		}
		return false;
	}

	function getPostLikeLink($post_id) {
		global $data;
		if($data["post_like"]==1) {

			$themename = "twentyeleven";

			$vote_count = get_post_meta($post_id, "votes_count", true);

			if(hasAlreadyVoted($post_id)) {
				$output = '<p class="post-like voted clearfix">';
				$output .= '<a href="#" class="ttip like voted" title="Thank you !"><em class="icon-heart"></em></a>';
			} else {
				$output = '<p class="post-like clearfix">';
				$output .= '<a href="#" data-post_id="'.$post_id.'" class="ttip like" title="Like this !"><em class="icon-heart-empty"></em></a>';
			}
			$output .= ' <span class="vote-count">'.$vote_count.'</span></p>';

			return $output;

		}
	}

	function getVoteCount($post_id) {
		global $data;
		if($data["post_like"]==1) {
			$vote_count = get_post_meta($post_id, "votes_count", true);
			if($vote_count=="") { $vote_count="0"; }
			return $vote_count;
		}
	}

	function getPostLikeLinkinTb($post_id) {
		global $data;
		if($data["post_like"]==1) {

			$themename = "twentyeleven";

			$vote_count = get_post_meta($post_id, "votes_count", true);

			if(hasAlreadyVoted($post_id))
				$output = '<a href="#" class="btn-rdd ttip like voted" title="Thank you !"><em class="icon-heart"></em><span class="vote-count">'.$vote_count.'</span></a>';
			else
				$output = '<a href="#" class="btn-rdd ttip like" title="'.$vote_count. ' likes" data-post_id="'.$post_id.'"><em class="icon-heart-empty"></em><span class="vote-count"></span></a>';

			return $output;
		}
	}