<?php

namespace vnh\markup;

use vnh\contracts\Bootable;

class Breadcrumb implements Bootable {
	public function boot() {
		add_filter('vnh/attr/breadcrumb', [$this, 'breadcrumb']);
		add_filter('vnh/attr/breadcrumb-link-wrap', [$this, 'breadcrumb_link_wrap']);
		add_filter('vnh/attr/breadcrumb-link-wrap-meta', [$this, 'breadcrumb_link_wrap_meta']);
		add_filter('vnh/attr/breadcrumb-link', [$this, 'breadcrumb_link']);
		add_filter('vnh/attr/breadcrumb-link-text-wrap', [$this, 'breadcrumb_link_text_wrap']);
	}

	public function breadcrumb($attributes) {
		// Homepage breadcrumb content contains no links, so no schema.org attributes are needed.
		if (is_home()) {
			return $attributes;
		}

		// Breadcrumbs require microdata on the wrapper.
		$attributes['itemprop'] = 'breadcrumb';
		$attributes['itemscope'] = true;
		$attributes['itemtype'] = 'https://schema.org/BreadcrumbList';

		if (is_singular('post') || is_archive() || is_home() || is_page_template('page_blog.php')) {
			unset($attributes['itemprop']);
		}

		return $attributes;
	}

	public function breadcrumb_link_wrap($attributes) {
		$attributes['itemprop'] = 'itemListElement';
		$attributes['itemscope'] = true;
		$attributes['itemtype'] = 'https://schema.org/ListItem';

		return $attributes;
	}

	public function breadcrumb_link_wrap_meta($attributes) {
		static $position = 0;

		$position++;

		$attributes['class'] = '';
		$attributes['itemprop'] = 'position';
		$attributes['content'] = $position;

		return $attributes;
	}

	public function breadcrumb_link($attributes) {
		$attributes['itemprop'] = 'item';

		return $attributes;
	}

	public function breadcrumb_link_text_wrap($attributes) {
		$attributes['itemprop'] = 'name';

		return $attributes;
	}
}
