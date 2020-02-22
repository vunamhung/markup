<?php

namespace vnh\markup;

use vnh\contracts\Bootable;

class Search_Form implements Bootable {
	public $unique_id;
	public $placeholder;
	public $input_value;

	public function __construct() {
		$this->unique_id = wp_unique_id('searchform-');
		$this->placeholder = __('Search this website', 'vnh_textdomain');
		$this->input_value = apply_filters('vnh/search_query', get_search_query());
	}

	public function boot() {
		add_filter('vnh/attr/search-form', [$this, 'search_form']);
		add_filter('vnh/attr/search-form-label', [$this, 'search_form_label']);
		add_filter('vnh/attr/search-form-input', [$this, 'search_form_input']);
		add_filter('vnh/attr/search-form-submit', [$this, 'search_form_submit']);
		add_filter('vnh/attr/search-form-meta', [$this, 'search_form_meta']);
	}

	public function search_form($attributes) {
		$attributes['itemprop'] = 'potentialAction';
		$attributes['itemscope'] = true;
		$attributes['itemtype'] = 'https://schema.org/SearchAction';
		$attributes['method'] = 'get';
		$attributes['action'] = home_url('/');
		$attributes['role'] = 'search';

		return $attributes;
	}

	public function search_form_label($attributes) {
		$attributes['class'] = 'search-form-label screen-reader-text';
		$attributes['for'] = $this->unique_id;

		return $attributes;
	}

	public function search_form_input($attributes) {
		$attributes['type'] = 'search';
		$attributes['itemprop'] = 'query-input';
		$attributes['name'] = 's';
		$attributes['id'] = $this->unique_id;
		$attributes['value'] = $this->input_value;
		$attributes['placeholder'] = $this->placeholder;

		return $attributes;
	}

	public function search_form_submit($attributes) {
		$attributes['type'] = 'submit';

		return $attributes;
	}

	public function search_form_meta($attributes) {
		$attributes['class'] = '';
		$attributes['itemprop'] = 'target';
		$attributes['content'] = home_url('/?s={s}');

		return $attributes;
	}
}
