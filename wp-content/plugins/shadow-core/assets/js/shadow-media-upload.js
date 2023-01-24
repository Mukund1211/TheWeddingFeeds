/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */

shadowMediaControl = {
	parent_el: false,
	// Initializes a new media manager or returns an existing frame.
	frame: function() {
		if ( this._frame )
			return this._frame;
		
		var $parent = this.parent_el;

		this._frame = wp.media({
			title: $parent.data('title'),
			library: {
				type: 'image'
			},
			button: {
				text: $parent.data('update-text'),
			},
			multiple: false
		});

		this._frame.on( 'open', this.updateFrame ).state('library').on( 'select', this.select );

		return this._frame;
	},

select: function() {
	var attachment = this.get('selection').first().toJSON();
		$parent = shadowMediaControl.parent_el;
		$img_wrap = $parent.find('.shadow-image-select-wrap'),
		$media_button = $parent.find('.shadow-media-control-choose'),
		img_src = '';

	// Update Image
	if (attachment.sizes.thumbnail) {
		img_src = attachment.sizes.thumbnail.url;
	} else {
		img_src = attachment.sizes.full.url;
	}
	if ($img_wrap.find('img').length) {
		$img_wrap.find('img').attr('src', img_src);
	} else {
		$img_wrap.append('<img src="'+ img_src +'" alt="Media Image">');
	}
	
	// Add Remove Button, if needed
	if (!$parent.find('.shadow-media-control-remove').length) {
		$img_wrap.after('<a href="#" class="button shadow-media-control-remove">'+ $parent.data('remove') +'</a>');
	}
	
	// Update Media Button Caption
	$media_button.text($media_button.data('caption-change'));
	
	$parent.find('input').val(attachment.id).trigger('change');		
},

	updateFrame: function() {
		// Do something when the media frame is opened.
	},

	init: function() {
		jQuery(document).on('click', '.shadow-media-control-choose', function(e) {
			e.preventDefault();
			shadowMediaControl.parent_el = jQuery(this).parents('p');
			shadowMediaControl.frame().open();
		});
		jQuery(document).on('click', '.shadow-media-control-remove', function(e) {
			e.preventDefault();
			var $parent = jQuery(this).parents('p'),
				$media_button = $parent.find('.shadow-media-control-choose');
			$parent.find('img').remove();
			$parent.find('input').val('').trigger('change');
			$media_button.text($media_button.data('caption-select'));
			jQuery(this).remove();
		});
	}
};

shadowMediaControl.init();