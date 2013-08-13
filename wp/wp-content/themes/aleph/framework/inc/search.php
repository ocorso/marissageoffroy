<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * Search panel
 *
 * /framework/inc/search.php
 * Version of this file : 1.0
 *
 */
?>

		<div id="search_panel">
			<div class="container-fluid">
				<div class="row-fluid clearfix" id="search-form-overlay">
					<div class="span12 clearfix">
						<h1><?php _e("Begin typing to search :", "alephtheme"); ?></h2>
						<form class="clearfix">
							<input id="hidden-search" type="text"  autocomplete="off" />
							<input id="display-search" type="text" autocomplete="off" readonly="readonly" />
						</form>
					</div>
				</div>
						
				<div id="results">
					<div class="clearfix row-fluid">
						<div class="result-list span4">
							<h3 class="cat-title"><?php _e("Posts :", "alephtheme"); ?></h2>
							<ul id="posts"></ul>
						</div>
						<div class="result-list span4">
							<h3 class="cat-title"><?php _e("Portfolio :", "alephtheme"); ?></h2>
							<ul id="portfolios"></ul>
						</div>
						<div class="result-list span4 clearfix">
							<h3 class="cat-title"><?php _e("Pages :", "alephtheme"); ?></h2>
							<ul id="pages"></ul>
						</div>
						<div class="no-results span12 clearfix"></div>
					</div>
				</div>
			</div>
		</div>