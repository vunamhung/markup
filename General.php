<?php

namespace vnh\markup;

use vnh\contracts\Bootable;

class General implements Bootable {
	public function boot() {
		add_filter('vnh/attr/head', [$this, 'head']);
		add_filter('vnh/attr/body', [$this, 'body']);
		add_filter('vnh/attr/header', [$this, 'header']);
		add_filter('vnh/attr/site-title', [$this, 'site_title']);
		add_filter('vnh/attr/site-description', [$this, 'site_description']);
		add_filter('vnh/attr/main', [$this, 'main']);
		add_filter('vnh/attr/sidebar', [$this, 'sidebar']);
		add_filter('vnh/attr/footer', [$this, 'footer']);
	}

	public function head($attributes) {
		$attributes['class'] = '';

		if (!is_front_page()) {
			return $attributes;
		}

		$attributes['itemscope'] = true;
		$attributes['itemtype'] = 'https://schema.org/WebSite';

		return $attributes;
	}

	public function body($attributes) {
		$attributes['class'] = implode(' ', get_body_class());
		$attributes['itemscope'] = true;
		$attributes['itemtype'] = 'https://schema.org/WebPage';

		// Search results pages.
		if (is_search()) {
			$attributes['itemtype'] = 'https://schema.org/SearchResultsPage';
		}

		return $attributes;
	}

	public function header($attributes) {
		$attributes['id'] = 'masthead';
		$attributes['role'] = 'banner';
		$attributes['itemscope'] = true;
		$attributes['itemtype'] = 'https://schema.org/WPHeader';

		return $attributes;
	}

	public function site_title($attributes) {
		$attributes['itemprop'] = 'headline';

		return $attributes;
	}

	public function site_description($attributes) {
		$attributes['itemprop'] = 'description';

		return $attributes;
	}

	public function main($attributes) {
		$attributes['id'] = 'main';
		$attributes['role'] = 'main';

		return $attributes;
	}

	public function sidebar($attributes) {
		$attributes['id'] = 'sidebar';
		$attributes['role'] = 'complementary';
		$attributes['aria-label'] = esc_attr__('Blog Sidebar', 'vnh_textdomain');

		return $attributes;
	}

	public function footer($attributes) {
		$attributes['id'] = 'colophon';
		$attributes['itemscope'] = true;
		$attributes['itemtype'] = 'https://schema.org/WPFooter';

		return $attributes;
	}
}
