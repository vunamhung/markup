<?php

namespace vnh;

function the_attr($context, $attributes = [], $args = []) {
	echo attr($context, $attributes, $args); //phpcs:disable
}

function attr($context, $attributes = [], $args = []) {
	$defaults['class'] = sanitize_html_class($context);

	$attributes = wp_parse_args($attributes, $defaults);
	$attributes = apply_filters("vnh/attr/{$context}", $attributes, $context, $args);

	$output = '';
	foreach ($attributes as $key => $value) {
		if (!$value) {
			continue;
		}

		if ($value === true) {
			$output .= sprintf('%s ', esc_html($key));
		} else {
			$output .= sprintf('%s="%s" ', esc_html($key), esc_attr($value));
		}
	}

	$output = apply_filters("vnh/attr/{$context}/output", $output, $attributes, $context, $args);

	return trim($output);
}
