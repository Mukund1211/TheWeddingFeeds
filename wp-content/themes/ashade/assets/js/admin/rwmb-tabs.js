/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */

"use strict";
jQuery(document).ready(function() {
	// Init Tabs DOM
	if (jQuery('.rwmb-meta-box').length) {
		jQuery('.rwmb-meta-box').each(function() {
			var $this_box = jQuery(this),
				this_box_id = $this_box.attr('id');
			
			if ($this_box.find('span.ashade-rwmb-tab').length > 1) {
				// Add TabBox
				$this_box.addClass('has-tabs');
				$this_box.parent().addClass('ashade-tabs-wrapper');
				let $this_tabs_wrap = jQuery('<div class="ashade-rwmb-tabs-box"/>').insertBefore($this_box),
					$this_tabs_list = jQuery('<ul class="ashade-rwmb-tab-list"/>').appendTo($this_tabs_wrap);
				
				//Create Tabs in this Box
				$this_box.find('span.ashade-rwmb-tab').each(function() {
					let $this_parent = jQuery(this).parents('.rwmb-field').addClass('ashade-rwmb-tab-field'),
						current_tab_id = jQuery(this).text(),
						$this_tab_content = jQuery(),
						next_field = $this_parent[0].nextSibling;
					
					// Add Tab to TabBox
					$this_tabs_list.append('<li data-tab="'+ current_tab_id +'">'+ $this_parent.find('h4').text() +'</li>');
					
					while(next_field) {
						if (!jQuery(next_field).find('span.ashade-rwmb-tab').length) {
							$this_tab_content.push(next_field);
							next_field = next_field.nextSibling;
						} else {
							break;
						}
					}
				
					$this_tab_content.wrapAll('<div class="ashade-rwmb-tab-content" data-id="'+ current_tab_id +'" />');
					$this_parent.remove();
				});
				
				$this_box.find('.ashade-rwmb-tab-content').eq(0).addClass('is-active');
				$this_tabs_list.find('li:first-child').addClass('is-active');
				$this_tabs_list.on('click', 'li', function() {
					let $this_li = jQuery(this);
					
					$this_tabs_list.find('.is-active').removeClass('is-active');
					$this_box.find('.is-active').removeClass('is-active');
					$this_li.addClass('is-active');
					$this_box.find('[data-id="'+ $this_li.data('tab') +'"]').addClass('is-active');
				});
			}
		});
	}
});