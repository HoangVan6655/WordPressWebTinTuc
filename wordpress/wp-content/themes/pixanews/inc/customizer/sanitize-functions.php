<?php
function pixanews_sanitize_fa_style($value) {
	$default_value = 'style1';
	$value = sanitize_text_field( $value );
	
	$valid_values = array(
	   'style1',
	   'style2',
	   'style3',
	);
	
	if (in_array($value, $valid_values)) {
		return $value; 
	}
	else {
		return $default_value;	
	}
}

function pixanews_sanitize_sidebar_layout( $value ) {
		
		$default_value = 'right-sidebar';
	    $value = sanitize_text_field( $value );
	    
		$valid_values = array(
		   'no-sidebar',
		   'right-sidebar',
		   'right-sidebar-narrow',
		   'no-sidebar-narrow-primary'
	    );
		
		if (in_array($value, $valid_values)) {
			return $value; 
		}
		else {
			return $default_value;	
		}
	}
	