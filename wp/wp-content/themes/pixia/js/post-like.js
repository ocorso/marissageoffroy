jQuery(document).ready(function() 
{
	jQuery(".post-like a").click(function()
	{
		//CHECK IF WE ARE CLICKING ON THE BUTTON THAT "SHOULD" BE INACTIVE
		if (jQuery(this).hasClass('alreadyvoted'))
		{
			return false;
		}
		else
		{
			heart = jQuery(this);
			post_id = heart.data("post_id");
			jQuery.ajax(
			{
				type: "post",
				url: ajax_var.url,
				data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
				success: function(count)
				{
					if(count != "already")
					{
						heart.addClass("voted");
						heart.find(".count").text(''+count+'');
						heart.qtip("hide");
						heart.attr("pir_title","You already liked this");
					}
				}
			});
			return false;
		}
	});
});