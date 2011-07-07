<?php 


// this function is used in the 
function wikiembed_settings_page() {
	global $wikiembed_options, $wikiembed_version;
	$updated = false;
	$option = "wikiembed_options";
	if ( isset($_POST[$option]) ):
			$value = $_POST[$option];
		if ( !is_array($value) )
			$value = trim($value);
		$value = stripslashes_deep($value);
		
		$updated = update_option($option, $value);
		$wikiembed_options = $value;
		
	endif; 	
	?>
	
	<div class="wrap">
		
	    <div class="icon32" id="icon-options-general"><br></div>
		<h2>Wiki Embed Settings </h2>
		
		<form method="post" action="admin.php?page=wikiembed_settings_page">
			<?php settings_fields('wikiembed_options'); ?>
						<a href="#" id="show-help" >Explain More</a>
		<?php if($updated): ?>
		<div class="updated below-h2" id="message"><p>Wiki Embed Settings Updated</p></div>
		<?php endif; ?>
		<h3>Enable Wiki Embed Functionality </h3>
		<p>If there is functionality that wiki embed has that you don't want &mdash; disable it. This will keep pages lean and mean. </p>
		<table class="form-table">
		
		
		<tr>
			<th valign="top" class="label" scope="row">	
			</th>
			<td class="field">
	
			<input type="checkbox" aria-required="true" value="1" name="wikiembed_options[tabs]" id="wiki-embed-edit" <?php checked( isset($wikiembed_options['tabs']) ); ?> /> <span ><label for="wiki-embed-edit">Ability to convert a Wiki page headlines into tabs </label></span>    <br />
			<div class="help-div">Loads the tabs javascript file on each page of the site.</div>
			<!-- 
			<input type="checkbox" aria-required="true" value="1" name="wikiembed_options[overlay]" id="wiki-embed-contents" <?php checked( isset($wikiembed_options['overlay']) ); ?> /> <span ><label for="wiki-embed-contents">Ability or internal wiki links to be displayed in an Overlay indtead of linking to the site</label></span>    <br /> 
			<div class="help-div"> Loads the overlay javascirpt and css files on each page of the site.<br /> </div>
			-->
			<input type="checkbox" aria-required="true" value="1" name="wikiembed_options[style]" id="wiki-embed-overlay" <?php checked( isset($wikiembed_options['style']) ); ?> /><span ><label for="wiki-embed-overlay"> Additional styling not commonly found in your theme.</label></span>    <br />
			<div class="help-div">Loads wiki-embed css files on each page of the site. <br /> </div>
			
			<input type="checkbox" aria-required="true" value="1" name="wikiembed_options[tabs-style]" id="wiki-embed-tab-style" <?php checked(  isset($wikiembed_options['tabs-style']) ); ?> /> <span ><label for="wiki-embed-tab-style">Additional tabs styling, useful if you theme doesn't support tab styling </label></span>    <br />
			
			<div class="help-div">Loads tabs css files on each page of the site.<br /> </div>
			</td>
		</tr>
				
			</table>
			
			
			<h3>Global Settings </h3>
			<p>These settings are applied site-wide</p>
			
			<table class="form-table">
			<tr> <!-- Update Content -->
				<th valign="top" class="label" scope="row">
					<span class="alignleft"><label for="src">Update content from the wiki</label></span>
				</th>
				<td class="field">
				<select name="wikiembed_options[wiki-update]" id="wiki-embed-update">
					<option value="5" <?php selected( $wikiembed_options['wiki-update'], "5" ); ?>>Every 5 minutes </option>
					<option value="30" <?php selected( $wikiembed_options['wiki-update'], "30" ); ?>>Every 30 minutes </option>
					<option value="360" <?php selected( $wikiembed_options['wiki-update'], "360" ); ?>>Every 6 hours </option>
					<option value="1440" <?php selected( $wikiembed_options['wiki-update'], "1440" ); ?>>Daily </option>
					<option value="262974383" <?php selected( $wikiembed_options['wiki-update'], "262974383" ); ?>>Manually</option>
				</select>
				<div class="help-div">Set the duration the content of the wiki page will be stored on your site, before it is refreshed again.<br /> <em>Manually</em> means the content will be stored for <em>6 months</em> which will allow you to refresh the content manually.</div>
				</td>
			</tr>
			<tr><!-- Internal wiki links -->
				<th valign="top" class="label" scope="row">
					<span class="alignleft"><label for="src">Internal wiki links</label></span><br />
					<div class="help-div">Internal wiki links are links that take you to a different page on the same wiki.</div>
				</th>
				<td class="field">
					<label><input name="wikiembed_options[wiki-links]" type="radio" value="default"  <?php checked($wikiembed_options['wiki-links'],"default"); ?> /> Default &mdash; links takes you back to the wiki</label>  <br />
					<label><input name="wikiembed_options[wiki-links]" type="radio" value="overlay" <?php checked($wikiembed_options['wiki-links'],"overlay"); ?> /> Overlay &mdash; links open with the content in an overlay window</label> <br />
					
					<label><input name="wikiembed_options[wiki-links]" type="radio" value="new-page" <?php checked($wikiembed_options['wiki-links'],"new-page"); ?>  /> WordPress Page &mdash; links open a WordPress page with the content of the wiki</label>  <br />
					Note: You can make the links open in specific page by specifying a <a href="?page=wiki-embed">target url</a>. 
					
					<br /><label>email
					<input type="text" name="wikiembed_options[wiki-links-new-page-email]" value="<?php echo $wikiembed_options['wiki-links-new-page-email']; ?>"   /></label> <div class="help-div">Specify an email address if you would like to be contacted when some access a new page. that has not been cached yet. This will help you create a better site structure as the content on the wiki grows.</div>
				</td>
			</tr>
			<tr>
				<th valign="top" class="label" scope="row">
					<span class="alignleft"><label for="src">Credit wiki page</label></span><br />
					<div class="help-div">This makes it easy to insert a link back to the wiki page.</div>
					
				</th>
				<td>
				<input type="checkbox" aria-required="true" value="1" name="wikiembed_options[default][source]" id="wiki-embed-display-links" <?php checked( isset($wikiembed_options['default']['source'])); ?> /> <span ><label for="wiki-embed-display-links">Display a link to the content source after the embedded content</label></span>  
				<br />
				
				<div id="display-wiki-source" >
					<div style="float:left; width:80px;" >Before the link <br /><input type="text" name="wikiembed_options[default][pre-source]" size="7" value="<?php echo esc_attr($wikiembed_options['default']['pre-source']); ?>" /><br /> </div>
				
					<div style="float:left; width:230px; padding-top:23px;" >http://www.link-to-the-wiki-page.com</div>
				</div>
				</td>
			</tr>
			</table>
			
			<h3>Shortcode Defaults</h3>
			<p>Tired of checking off all the same settings across the site. Set the shortcodes defaults here</p>
			<table class="form-table">
			<tr>
				<th valign="top" class="label" scope="row">
				</th>
				<td class="field">
				<input type="checkbox" aria-required="true" value="1" name="wikiembed_options[default][tabs]" id="wiki-embed-tabs" <?php checked( isset($wikiembed_options['default']['tabs']) ); ?> /> <span ><label for="wiki-embed-tabs">Top sections converted into tabs</label></span>   <br />
				<div class="help-div">Wiki pages are usually divided up though headings into sections. This setting turns these sections into tabs. <br /> </div>
				
				<input type="checkbox" aria-required="true" value="1" name="wikiembed_options[default][no-edit]" id="wiki-remove-edit" <?php checked( isset($wikiembed_options['default']['no-edit']) ); ?> /> <span ><label for="wiki-remove-edit">Remove edit links</label></span>    <br />
				<div class="help-div">Often wiki pages have edit links displayed next to sections, which is not always desired. </div>
				<input type="checkbox" aria-required="true" value="1" name="wikiembed_options[default][no-contents]" id="wiki-embed-contents" <?php checked( isset($wikiembed_options['default']['no-contents']) ); ?> /> <span ><label for="wiki-embed-contents">Remove table of contents</label></span>    <br />
				<div class="help-div">Often wiki pages have a table of contents (a list of content) at the top of each page. </div>
				</td>
			</tr>

			</table>
			
			<h3>Security</h3>
			<p>Restrict the urls of wikis that you want content to be embedded from. This way only url from </p>
			<table class="form-table">
			<tr>
				<th valign="top" class="label" scope="row">
				</th>
				<td class="field">
				<span>Separate urls by new lines</span><br />
				<textarea name="wikiembed_options[security][whitelist]"  rows="10" cols="50"><?php echo $wikiembed_options['security']['whitelist']; ?></textarea>
					<div class="help-div">We are checking only the beginning of the url if it matches the url that you provided.  So for example: <em>http://en.wikipedia.org/wiki/</em> would allow any urls from the english wikipedia, but not from <em>http://de.wikipedia.org/wiki/</em> German wikipedia</div>
				</td>
			</tr>
			</table>
		
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>	
	</div>
	<?php	
}

//display contextual help for Books
// add_action( 'contextual_help', 'wiki_embed_add_help_text', 10, 3 );

function wiki_embed_add_help_text($contextual_help, $screen_id, $screen) { 
  if ('wiki-embed_page_wikiembed_settings_page' == $screen->id ) {
    $contextual_help =
      '<h3>' . __('Wiki Embed Explained') . '</h3>' .
      '<ul>' .
      '<li>' . __('Specify the correct genre such as Mystery, or Historic.') . '</li>' .
      '<li>' . __('Specify the correct writer of the book.  Remember that the Author module refers to you, the author of this book review.') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the book review to be published in the future:') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.') . '</li>' .
      '</ul>' .
      
      '<h3>' . __('Shortcode') . '</h3>';

     
      } 
  return $contextual_help;
}





// Sanitize and validate input. Accepts an array, return a sanitized array.
function wikiembed_options_validate($wikiembed_options) {
	
	$wikiembed_options['tabs'] =  ( isset($wikiembed_options['tabs']) && $wikiembed_options['tabs'] == 1 ? 1 : 0 );
	$wikiembed_options['style'] =  ( isset($wikiembed_options['style']) && $wikiembed_options['style'] == 1 ? 1 : 0 );
	$wikiembed_options['tabs-style'] =  ( isset($wikiembed_options['tabs-style']) && $wikiembed_options['tabs-style'] == 1 ? 1 : 0 );
	$wikiembed_options['wiki-update'] =  ( is_numeric($wikiembed_options['wiki-update']) ? $wikiembed_options['wiki-update'] : "30" );
	
	$wikiembed_options['wiki-links'] = ( in_array($wikiembed_options['wiki-links'],array("default","overlay","new-page")) ? $wikiembed_options['wiki-links']:"default" );
	$wikiembed_options['wiki-links-new-page-email'] = wp_rel_nofollow($wikiembed_options['wiki-links-new-page-email']);
	$wikiembed_options['default']['source'] =  ( isset($wikiembed_options['default']['source']) && $wikiembed_options['default']['source'] == 1 ? 1 : 0 );
	$wikiembed_options['default']['pre-source'] = wp_rel_nofollow($wikiembed_options['default']['pre-source']);
	
	
	$wikiembed_options['default']['no-contents'] =  ( isset($wikiembed_options['default']['no-contents']) && $wikiembed_options['default']['no-contents'] == 1 ? 1 : 0 );
	$wikiembed_options['default']['no-edit'] =  ( isset($wikiembed_options['default']['no-edit']) && $wikiembed_options['default']['no-edit'] == 1 ? 1 : 0 );
	$wikiembed_options['default']['tabs'] =  ( isset($wikiembed_options['default']['tabs']) && $wikiembed_options['default']['tabs'] == 1 ? 1 : 0 );
	
	$wikiembed_options['security']['whitelist'] = ( isset($wikiembed_options['security']['whitelist'] ) ? $wikiembed_options['security']['whitelist'] : null);
	
	
	return $wikiembed_options;
}
