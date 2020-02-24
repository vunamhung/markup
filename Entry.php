<?php

namespace vnh\markup;

use vnh\contracts\Bootable;

class Entry implements Bootable {
	public function boot() {
		add_filter('vnh/attr/entry', [$this, 'entry'], 10, 2);
		add_filter('vnh/attr/post', [$this, 'entry'], 10, 2);
		add_filter('vnh/attr/page', [$this, 'entry'], 10, 2);
		// Entry title
		add_filter('vnh/attr/entry-title', [$this, 'entry_title']);
		add_filter('vnh/attr/post-title', [$this, 'entry_title']);
		add_filter('vnh/attr/page-title', [$this, 'entry_title']);
		// Entry author
		add_filter('vnh/attr/entry-author', [$this, 'entry_author']);
		add_filter('vnh/attr/post-author', [$this, 'entry_author']);
		add_filter('vnh/attr/page-author', [$this, 'entry_author']);
		// Entry time
		add_filter('vnh/attr/entry-time', [$this, 'entry_time']);
		add_filter('vnh/attr/post-time', [$this, 'entry_time']);
		add_filter('vnh/attr/page-time', [$this, 'entry_time']);
		// Entry title link
		add_filter('vnh/attr/entry-title-link', [$this, 'entry_title_link']);
		// Entry content
		add_filter('vnh/attr/entry-content', [$this, 'entry_content']);
		add_filter('vnh/attr/post-content', [$this, 'entry_content']);
		add_filter('vnh/attr/page-content', [$this, 'entry_content']);
	}

	public function entry($attributes, $context) {
		$attributes['id'] = sprintf('%s-%s', $context, get_the_ID());
		$attributes['class'] = implode(' ', get_post_class());
		$attributes['itemscope'] = true;
		$attributes['itemtype'] = 'https://schema.org/CreativeWork';

		return $attributes;
	}

	public function entry_title($attributes) {
		$attributes['itemprop'] = 'headline';

		return $attributes;
	}

	public function entry_title_link($attributes) {
		$attributes['rel'] = 'bookmark';
		$attributes['href'] = get_permalink();

		return $attributes;
	}

	public function entry_time($attributes) {
		$attributes['itemprop'] = 'datePublished';
		$attributes['datetime'] = get_the_time('c');

		return $attributes;
	}

	public function entry_content($attributes) {
		$attributes['itemprop'] = 'text';

		return $attributes;
	}

	public function entry_author($attributes) {
		$attributes['itemprop'] = 'author';
		$attributes['itemscope'] = true;
		$attributes['itemtype'] = 'https://schema.org/Person';

		return $attributes;
	}
}
