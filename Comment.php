<?php

namespace vnh\markup;

use vnh\contracts\Bootable;

class Comment implements Bootable {
	public function boot() {
		add_filter('vnh/attr/comment', [$this, 'comment']);
		add_filter('vnh/attr/comment-time', [$this, 'time']);
		add_filter('vnh/attr/comment-author', [$this, 'author']);
		add_filter('vnh/attr/comment-author-name', [$this, 'author_name']);
		add_filter('vnh/attr/comment-author-link', [$this, 'author_link']);
	}

	public function comment($attributes) {
		$attributes['class'] = 'comment-body';
		$attributes['itemprop'] = 'comment';
		$attributes['itemscope'] = true;
		$attributes['itemtype'] = 'https://schema.org/Comment';

		return $attributes;
	}

	public function time($attributes) {
		$attributes['datetime'] = esc_attr(get_comment_time('c'));
		$attributes['itemprop'] = 'datePublished';

		return $attributes;
	}

	public function author($attributes) {
		$attributes['itemprop'] = 'author';
		$attributes['itemscope'] = true;
		$attributes['itemtype'] = 'https://schema.org/Person';

		return $attributes;
	}

	public function author_name($attributes) {
		$attributes['itemprop'] = 'name';

		return $attributes;
	}

	public function author_link($attributes) {
		$attributes['rel'] = 'external nofollow';
		$attributes['itemprop'] = 'url';

		return $attributes;
	}
}
