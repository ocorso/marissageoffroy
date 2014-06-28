<?php
	/* Check if loop through projects in the same (selected) category only */
	global $post;
	if(is_page_template('template-portoflio.php')){
		$loop_through = get_post_meta($wp_query->get_queried_object_id(), 'page_portfolio_loop_through', true); // don't use get_the_ID() nor $post->ID because both will fail.
		$boundary_arrows = get_post_meta($wp_query->get_queried_object_id(), 'page_portfolio_boundary_arrows', true);
		if(empty($loop_through)){
			$loop_through = false; // false = Loop, true = Do not loop
		}
		if(empty($boundary_arrows)){
			$boundary_arrows = false;
		}
	}else if(is_singular('portfolio') && ($parent_page = get_post_meta($post->ID, 'portfolio_back_button', true)) && !empty($parent_page)){
		$loop_through = get_post_meta($parent_page, 'page_portfolio_loop_through', true);
		$boundary_arrows = get_post_meta($parent_page, 'page_portfolio_boundary_arrows', true);
		if(empty($loop_through)){
			$loop_through = false;
		}
		if(empty($boundary_arrows)){
			$boundary_arrows = false;
		}
	}else if(is_home() && ($portfolio_page_id = get_option('front_page')) && $portfolio_page_id != ''){
		$loop_through = get_post_meta($portfolio_page_id, 'page_portfolio_loop_through', true);
		$boundary_arrows = get_post_meta($portfolio_page_id, 'page_portfolio_boundary_arrows', true);
		if(empty($loop_through)){
			$loop_through = false;
		}
		if(empty($boundary_arrows)){
			$boundary_arrows = false;
		}
	}else{
		$loop_through = false;
		$boundary_arrows = false;
	}
?>
<script type="text/javascript">
function bringPortfolio(current_id){

	// If project with such ID does not exist, load project 0 or do nothing
	if(portfolioArrayValid[current_id] === undefined){ 
		if(portfolioArrayValid.length != 0){ 
			bringPortfolio(0); 
		} 
		return;
	}
	
	// Assign projects array to variables
	var title = portfolioArrayValid[current_id][0];
	if(title == ''){
		var title = 'Title not specified'; 
	}
	var desc = portfolioArrayValid[current_id][1];
	var date = portfolioArrayValid[current_id][2];
	var client = portfolioArrayValid[current_id][3];
	var agency = portfolioArrayValid[current_id][4];
	var ourrole = portfolioArrayValid[current_id][5];
	var slides = portfolioArrayValid[current_id][6];
	var permalink = portfolioArrayValid[current_id][7];
	var external_link = portfolioArrayValid[current_id][8]; /* It never exists at this moment but it's reserved space for it */
	var categories_array = portfolioArrayValid[current_id][9];
	
	// Count number of projects
	var number_of_ids = portfolioArrayValid.length;

	// Make it go to the top and fade out current project data
	jQuery('body,html').animate({scrollTop:0},800);
	jQuery('.portfolio_box').removeClass('portfolio_box-visible');

	jQuery('body').addClass('daisho-portfolio-viewing-project');

	setTimeout(function(){
		if(date == ''){ jQuery('.project-date').hide(); }else{ jQuery('.project-date').show(); }
		if(client == ''){ jQuery('.project-client').hide(); }else{ jQuery('.project-client').show(); }
		if(agency == ''){ jQuery('.project-agency').hide(); }else{ jQuery('.project-agency').show(); }
		if(ourrole == ''){ jQuery('.project-ourrole').hide(); }else{ jQuery('.project-ourrole').show(); }
		
		// Show menu, navigation, containers etc.
		jQuery('.portfolio_box').addClass('portfolio_box-visible');
		jQuery('#compact_navigation_container').addClass('compact_navigation_container-visible');
		jQuery('.project-coverslide').addClass('project-coverslide-visible');
		jQuery('.project-navigation').addClass('project-navigation-visible');
		jQuery('.portfolio-arrowright').addClass('portfolio-arrowright-visible');
		jQuery('.portfolio-arrowleft').addClass('portfolio-arrowleft-visible');
		
		// Add current project data
		jQuery('.project-title').html(title);
		jQuery('.project-description').html(desc);
		jQuery('.project-exdate').html(date);
		jQuery('.project-exclient').html(client);
		jQuery('.project-exagency').html(agency);
		jQuery('.project-exourrole').html(ourrole);
		jQuery('.project-slides').html(slides);
		
		// Center and process images in the project view
		verticalimageflow();
		
		// Update document title, URL and brwosing history using HTML5 History API
		if(!window.history.state || (window.history.state.projid != current_id)){
			window.history.pushState({'cancelback': true, 'projid': current_id}, title, permalink);
		}
		jQuery('title').text(title);
		
		// Setup sharing icons (desktop mode)
		if(jQuery(".sharing-icons").length){
			jQuery(".sharing-icons-twitter").attr("href", "https://twitter.com/share?url="+escape(window.location.href)+"&amp;text="+escape(title));
			jQuery(".sharing-icons-facebook").attr("href", "http://www.facebook.com/sharer.php?u="+escape(window.location.href)+"&amp;t="+escape(title));
			jQuery(".sharing-icons-googleplus").attr("href", "https://plus.google.com/share?url="+escape(window.location.href));
		}

		// Re-create controls based on currently viewed project and other settings
		jQuery('.portfolio-arrowright').unbind('click.nextproject');
		jQuery('.portfolio-arrowleft').unbind('click.prevproject');

		<?php if($loop_through || $boundary_arrows){ ?>
			var global_pointer = 0;
			function testCategories(current_id, selected_category_id, this_project, search_direction){
				global_pointer++;
				
				// we checked all the projects, none of them matched criteria (except THIS post), let it continue to do whatever the default action for no projects is (reload current project or do not do anything)
				if(number_of_ids < global_pointer){ return; } // this makes it go only number_of_ids times at most
				
				if(portfolioArrayValid[current_id][9].indexOf(selected_category_id) != -1){ // Category match
					global_pointer = 0;
					if(current_id == this_project){ return; } // Don't load the same project if there is only 1 project available - this can't happen because we hide arrows in such event
					bringPortfolio( current_id );
					return;
				}else{ // No category match found, let's increase or decrease ID by 1 and test again
					if(search_direction == 'next'){
						current_id++; if(current_id == number_of_ids){ current_id = 0; }
						testCategories(current_id, selected_category_id, this_project, 'next');
						return;
					}else{
						current_id--; if(current_id == -1){ current_id = number_of_ids-1; }
						testCategories(current_id, selected_category_id, this_project, 'prev');
						return;
					}
				}
			}
				
			var selected_category_id = jQuery('#filters').find('li a.selected').attr('data-project-category-id');
			var loop_through = '<?php echo $loop_through; ?>';
			var counter = 0;
			var tempProjects = [];
			for(var i = 0; i < portfolioArrayValid.length; i++){
				if((!loop_through) || (selected_category_id == 'all' || selected_category_id === undefined)){
					counter++;
					tempProjects[i] = counter;
				}else{
					if(portfolioArrayValid[i][9].indexOf(selected_category_id) != -1){
						counter++;
						tempProjects[i] = counter;
					}
				}
			}
			if(counter < 2){ // Only 1 project in this category, disable arrows
				jQuery('.project-navigation').removeClass('project-navigation-visible');
				jQuery('.portfolio-arrowright').removeClass('portfolio-arrowright-visible');
				jQuery('.portfolio-arrowleft').removeClass('portfolio-arrowleft-visible');
			}else{
				jQuery('.project-navigation').addClass('project-navigation-visible');
				<?php if($boundary_arrows){ ?>
					if(tempProjects[current_id] == counter){ // Remove right arrow if we're at the end of an array
						jQuery('.portfolio-arrowright').removeClass('portfolio-arrowright-visible');
					}else{
						jQuery('.portfolio-arrowright').addClass('portfolio-arrowright-visible');
					}
					if(tempProjects[current_id] == 1){ // Remove left arrow if we're at the beginning of an array
						jQuery('.portfolio-arrowleft').removeClass('portfolio-arrowleft-visible');
					}else{
						jQuery('.portfolio-arrowleft').addClass('portfolio-arrowleft-visible');
					}
				<?php }else{ ?>
					jQuery('.portfolio-arrowright').addClass('portfolio-arrowright-visible');
					jQuery('.portfolio-arrowleft').addClass('portfolio-arrowleft-visible');
				<?php } ?>
			}
		<?php } ?>
		
		var this_project = current_id;
		/* Right Arrow */
		jQuery('.portfolio-arrowright').on('click.nextproject', function(){
			current_id++; if(current_id == number_of_ids){ current_id = 0; }
			
			/* Check if loop through projects in the same (selected) category only, true = yes, false = no */
			<?php if($loop_through){ ?>
				/* Check currently selected category */
				var selected_category_id = jQuery('#filters').find('li a.selected').attr('data-project-category-id');
				if(selected_category_id == 'all' || selected_category_id === undefined){
					// nothing, let the script continue and load any next project
				}else{ // Some category other than "all" is selected
					testCategories(current_id, selected_category_id, this_project, 'next');
					return;
				}
			<?php } ?>
			
			bringPortfolio( current_id );
		});
	
		/* Left Arrow */
		jQuery('.portfolio-arrowleft').on('click.prevproject', function(){
			current_id--; if(current_id == -1){ current_id = number_of_ids-1; }
			
			<?php if($loop_through){ ?>
				/* Check currently selected category */
				var selected_category_id = jQuery('#filters').find('li a.selected').attr('data-project-category-id');
				if(selected_category_id == 'all' || selected_category_id === undefined){
					// nothing, let the script continue and load any next project
				}else{ // Some category other than "all" is selected
					testCategories(current_id, selected_category_id, this_project, 'prev');
					return;
				}
			<?php } ?>
			
			bringPortfolio( current_id );
		});
	}, 200); // We wait for CSS3 fade out animation to opacity=0 of .portfolio_box (inner container of portfolio) to complete
}

function closePortfolioItem(){
	jQuery('.portfolio_box').removeClass('portfolio_box-visible');
	jQuery('body').removeClass('daisho-portfolio-viewing-project');
	jQuery('#compact_navigation_container').removeClass('compact_navigation_container-visible');
	jQuery('.project-coverslide').removeClass('project-coverslide-visible');
	
	jQuery('.project-navigation').removeClass('project-navigation-visible');
	jQuery('.portfolio-arrowright').removeClass('portfolio-arrowright-visible');
	jQuery('.portfolio-arrowleft').removeClass('portfolio-arrowleft-visible');
	
	jQuery('.project-slides').empty();
	jQuery('title').text(homepage_title);
}
function verticalimageflow(){
	jQuery('.project-slides').find('.myimage').each(function(){
		var current_image = jQuery(this);
		if(current_image.is("img")){
			jQuery('<img />').attr("src",this.src).load(function(){
				if((this.width < 1120) && (this.width != 0)){
					var img_max_width = this.width+"px";
					var img_width = '100%';
				}else{
					var img_max_width = '100%';
					var img_width = '100%';
				}
				current_image.closest('.project-slide-image').css({ 'max-width' : img_max_width, 'width' : img_width });
				current_image.next('span').delay(800).css({"opacity" : 1}); 
			});
		}
	});
}
function supports_history_api(){
	return !!(window.history && history.pushState);
}

<?php if(is_singular('portfolio')){ ?>
	window.onpopstate = function(){
		window.onpopstate = function(ev){
			var evstate = ev.state?ev.state:{};
			if(!evstate.cancelback){
				closePortfolioItem();
			}else{
				if(evstate.projid || evstate.projid == 0){
					bringPortfolio(evstate.projid);
				}
			}
		}
	}
<?php }else{ ?>
	var popped = ('state' in window.history && window.history.state !== null), initialURL = location.href;
	window.onpopstate = function(ev){
		//console.log(ev.state);
		// Ignore inital popstate that some browsers fire on page load
		var initialPop = !popped && location.href == initialURL;
		popped = true;
		if(initialPop){ return; }

		var evstate = ev.state?ev.state:{};
		if(!evstate.cancelback){
			closePortfolioItem();
		}else{
			if(evstate.projid || evstate.projid == 0){
				bringPortfolio(evstate.projid);
			}
		}
	}
<?php } ?>
</script>
<script type="text/javascript">
// center videos inside elements
function centerIsotopeVideos(){
	jQuery('.element').each(function(){
		var $this = jQuery(this);
		if($this.find('video').get(0) !== undefined){
			$this.find('video').bind("loadedmetadata", function(){
				var video_width = $this.find('video').get(0).videoWidth;
				var video_height = $this.find('video').get(0).videoHeight;
				var cont_width = $this.width();
				var cont_height = $this.height();
				
				var cont_ratio = $this.width() / $this.height();
				var video_ratio = $this.find('video').get(0).videoWidth / $this.find('video').get(0).videoHeight;
				
				if(cont_ratio <= video_ratio){
					$this.find('video').css({ 'width' : 'auto', 'height' : '100%', 'top' : 0 }).css({ 'left' : ~(($this.find('video').width()-$this.width())/2)+1 });
					$this.find('video').addClass('project-img-visible');
				}else{
					$this.find('video').css({ 'width' : '100%', 'height' : 'auto', 'left' : 0 }).css({ 'top' : ~(($this.find('video').height()-$this.height())/2)+1 });
					$this.find('video').addClass('project-img-visible');
				}
				$this.find('video').get(0).play();
			}).trigger('loadedmetadata');
		}
	});
}
// center images inside elements
function centerIsotypeImages(){
	jQuery('.element').each(function(){
		var $this = jQuery(this);

		// Center images
		if($this.find('img').get(0) === undefined){ return; }
		var cont_ratio = $this.width() / $this.height();
		var img_ratio = $this.find('img').get(0).width / $this.find('img').get(0).height;

		if(cont_ratio <= img_ratio){
			$this.find('img').css({ 'width' : 'auto', 'height' : '100%', 'top' : 0 }).css({ 'left' : ~(($this.find('img').width()-$this.width())/2)+1 });
			$this.find('img').addClass('project-img-visible');
		}else{
			$this.find('img').css({ 'width' : '100%', 'height' : 'auto', 'left' : 0 }).css({ 'top' : ~(($this.find('img').height()-$this.height())/2)+1 });
			$this.find('img').addClass('project-img-visible');
		}
	});
	centerIsotopeVideos();
}
jQuery(window).load(function(){
	centerIsotypeImages();
});
jQuery(document).ready(function(){
    
    var $container = jQuery('#container');
    var $containerSmall = jQuery('#content-small');

      // add randomish size classes
      $container.find('.element').each(function(){
        var $this = jQuery(this),
            number = parseInt( $this.find('.number').text(), 10 );
        if ( number % 7 % 2 === 1 ) {
          $this.addClass('width2');
        }
        if ( number % 3 === 0 ) {
          $this.addClass('height2');
        }        
		if ( number % 7 === 0 ) { //Rare because it picks random number from 1 to 11 and only 7 matches criteria
          $this.addClass('width3');
          $this.addClass('height2');
        }
      });
	
	// Center images inside thumbnails on window resize end
	var TO = false;
	jQuery(window).bind("resize.centerisotypeimages", function(){
		if(TO !== false){
			clearTimeout(TO);
		}
		TO = setTimeout(centerIsotypeImages, 200);
	});

	// Snippet below is present because individual images load earlier than global window load happens
	jQuery(".project-img").one("load",function(){
		var $this = jQuery(this);
		var cont_ratio = $this.parent().width() / $this.parent().height();
		var img_ratio = $this.get(0).width / $this.get(0).height;
		if(cont_ratio <= img_ratio){
			$this.css({ 'width' : 'auto', 'height' : '100%', 'top' : 0 }).css({ 'left' : ~(($this.width()-$this.parent().width())/2)+1 });
			$this.addClass('project-img-visible');
		}else{
			$this.css({ 'width' : '100%', 'height' : 'auto', 'left' : 0 }).css({ 'top' : ~(($this.height()-$this.parent().height())/2)+1 });
			$this.addClass('project-img-visible');
		}
	});
	
	<?php if(is_singular('portfolio')){ ?>
	<?php $post_id = esc_url(get_permalink($post->ID)); ?>
	<?php $project_title = get_the_title($post->ID); ?>
		
		// Attach arrows on the start
		var number_of_ids = portfolioArrayValid.length;
		if(number_of_ids >= 1){
			for(var current_id = 0;current_id<number_of_ids;current_id=current_id+1){
				if(portfolioArrayValid[current_id][7] == '<?php echo $post_id; ?>'){
					bringPortfolio( current_id );
					//jQuery('.portfolio-arrowright').click(function(){ current_id++; if(current_id == number_of_ids){ current_id = 0; } bringPortfolio( current_id ); });
					//jQuery('.portfolio-arrowleft').click(function(){ current_id--; if(current_id == -1){ current_id = number_of_ids-1; } bringPortfolio( current_id ); });
					break;
				}else{
					jQuery('.portfolio_box').addClass('portfolio_box-visible');
					jQuery('.project-title').html('Hold on!');
					jQuery('.project-description').html('<p><strong>Warning:</strong> this project is excluded from the portfolio page that it is attached to. You can\'t view it using direct link until it\'s a part of this page.</p><p><strong>FIX #1: To fix this, please make sure to include portfolio categories that contain this project to portfolio page with an id of: <?php echo $parent_page; ?></strong>.</p><p><strong>FIX #2: Please change "back button" of this portfolio project to some other place (a place that has this project on a list of thumbnails).</strong></p>');
				}
			}
		}
		
		// Process images once they are loaded
		verticalimageflow();
		
		// Disable arrows if we're in ($boundary_arrows == true) mode
		<?php if($boundary_arrows){ ?>
		
		<?php } ?>
	<?php } ?>
    
    $container.isotope({
      itemSelector : '.element',
      masonry : {
        //columnWidth : 120
        columnWidth : 5,
		gutterWidth: 5,
      },
      masonryHorizontal : {
        rowHeight: 120
      },
      cellsByRow : {
        columnWidth : 240,
        rowHeight : 240
      },
      cellsByColumn : {
        columnWidth : 240,
        rowHeight : 240
      },
      getSortData : {
        symbol : function( $elem ) {
          return $elem.attr('data-symbol');
        },
        category : function( $elem ) {
          return $elem.attr('data-category');
        },
        number : function( $elem ) {
          return parseInt( $elem.find('.number').text(), 10 );
        },
        weight : function( $elem ) {
          return parseFloat( $elem.find('.weight').text().replace( /[\(\)]/g, '') );
        },
        name : function ( $elem ) {
          return $elem.find('.name').text();
        }
      }
    });
    
    
	var $optionSets = jQuery('#options .option-set'),
	$optionLinks = $optionSets.find('a');

	$optionLinks.click(function(){
		var $this = jQuery(this);
		// don't proceed if already selected
		if ( $this.hasClass('selected') ) {
			return false;
		}
		var $optionSet = $this.parents('.option-set');
		$optionSet.find('.selected').removeClass('selected');
		$this.addClass('selected');

		// make option object dynamically, i.e. { filter: '.my-filter-class' }
		var options = {},
			key = $optionSet.attr('data-option-key'),
			value = $this.attr('data-option-value');
		// parse 'false' as false boolean
		value = value === 'false' ? false : value;
		options[ key ] = value;
		if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ){
			// changes in layout modes need extra logic
			changeLayoutMode( $this, options );
		}else{
			// otherwise, apply new options
			$container.isotope( options );
		}

		return false;
	});

	// change layout
	var isHorizontal = false;
	function changeLayoutMode( $link, options ) {
		var wasHorizontal = isHorizontal;
		isHorizontal = $link.hasClass('horizontal');

		if ( wasHorizontal !== isHorizontal ) {
			// orientation change
			// need to do some clean up for transitions and sizes
			var style = isHorizontal ? 
			{ height: '80%', width: $container.width() } : 
			{ width: 'auto' };
			// stop any animation on container height / width
			$container.filter(':animated').stop();
			// disable transition, apply revised style
			$container.addClass('no-transition').css( style );
			setTimeout(function(){
				$container.removeClass('no-transition').isotope( options );
			}, 100 )
		} else {
			$container.isotope( options );
		}
	}
		
	<?php
	if(is_singular('portfolio') && ($parent_page = get_post_meta($post->ID, 'portfolio_back_button', true)) && !empty($parent_page) && ($parent_page != 'none')){
		$this_page_link = get_permalink($parent_page);
	}else if(is_singular('portfolio') || is_home()){
		$this_page_link = get_bloginfo("url");
	}else{ 
		$this_page_link = get_permalink();
	} ?>

	// close bringPortfolio()
	//jQuery('#compact_navigation_container').delegate('.header-back-to-blog-link', 'click', function(){
	jQuery('.header-back-to-blog-link').on('click', function(){
		// If button is supposed to redirect to some external URL
		if(jQuery(this).hasClass('back-link-external')){ return; }
		// Usual action of button
		jQuery('.portfolio_box').removeClass('portfolio_box-visible');
		jQuery('body').removeClass('daisho-portfolio-viewing-project');
		jQuery('#compact_navigation_container').removeClass('compact_navigation_container-visible');
		jQuery('.project-coverslide').removeClass('project-coverslide-visible');
		jQuery('.project-navigation').removeClass('project-navigation-visible');
		jQuery('.portfolio-arrowright').removeClass('portfolio-arrowright-visible');
		jQuery('.portfolio-arrowleft').removeClass('portfolio-arrowleft-visible');
		jQuery('.project-slides').empty();
		jQuery('title').text(homepage_title);
		var document_title = "<?php bloginfo('name'); ?><?php wp_title('-'); ?>";
		var portfoliohistorywpurl = "<?php $biurl=substr($this_page_link,7);if(strpos($biurl,"/")!==false){print(substr($biurl,strpos($biurl,"/")+1));} ?>";
		window.history.pushState({}, document_title, ((portfoliohistorywpurl)?("/"+portfoliohistorywpurl+""):"/"));
	});

	// Close project on background click
	/* jQuery(document).on('click', '.project-coverslide', function(){
		closePortfolioItem();
	}); */
 
	// change size of clicked element
	$container.delegate( '.element', 'click', function(){
		if(jQuery(this).find('.thumbnail-link').length != 0){ return; }
		var current_id = jQuery(this).find('.id').text();
		bringPortfolio(current_id);
		portfolio_closenum = 0;
		portfolio_closedir = false;
		//  jQuery(this).toggleClass('large');
		//  $container.isotope('reLayout', centerIsotypeImages);
	});
	
	// Prevent thumbnail links from working unless they are external links. They are for search engines only. In no-js mode it's going to enable links.
	$container.on('click', '.thumbnail-project-link', function(e){
		e.preventDefault();
	});
	$containerSmall.on('click', '.thumbnail-project-link', function(e){
		e.preventDefault();
	});
	
	// change size of clicked element (small)
	$containerSmall.on('click', '.element', function(){
		if(jQuery(this).find('.thumbnail-link').length != 0){ return; }
		var current_id = jQuery(this).find('.id').text();
		bringPortfolio(current_id);
	});

	// toggle variable sizes of all elements
	jQuery('#toggle-sizes').find('a').click(function(){
		if(jQuery(this).hasClass('toggle-selected')){ return false; }
		jQuery('#toggle-sizes').find('a').removeClass('toggle-selected');
		jQuery(this).addClass('toggle-selected');
		if(!jQuery('#toggle-sizes a:first-child').hasClass('toggle-selected')){
			$container.find('.element').addClass('element-small'); 
		}else{ 
			$container.find('.element').removeClass('element-small'); 
		}
		//$container.find('img').fadeOut(0);
		$container
			.toggleClass('variable-sizes')
			.isotope('reLayout');
		centerIsotypeImages();
		return false;
	});

    
/*       jQuery('#insert a').click(function(){
        var $newEls = jQuery( fakeElement.getGroup() );
        $container.isotope( 'insert', $newEls );

        return false;
      });

      jQuery('#append a').click(function(){
        var $newEls = jQuery( fakeElement.getGroup() );
        $container.append( $newEls ).isotope( 'appended', $newEls );

        return false;
      }); */


	var $sortBy = jQuery('#sort-by');
	jQuery('#shuffle a').click(function(){
		$container.isotope('shuffle');
		$sortBy.find('.selected').removeClass('selected');
		$sortBy.find('[data-option-value="random"]').addClass('selected');
		return false;
	});
});
</script>
<?php if($konzept){ ?>
	<?php get_template_part('project', 'konzeptscripts'); ?>
<?php } ?>