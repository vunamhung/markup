<?php

namespace vnh\markup;

use vnh\contracts\Bootable;
use vnh\contracts\Initable;

class Markup implements Initable, Bootable {
	public $general;
	public $search_form;
	public $entry;
	public $comment;
	public $breadcrumb;

	public function boot() {
		add_action('after_setup_theme', [$this, 'init']);
	}

	public function init() {
		$this->general = new General();
		$this->general->boot();

		$this->search_form = new Search_Form();
		$this->search_form->boot();

		$this->entry = new Entry();
		$this->entry->boot();

		$this->comment = new Comment();
		$this->comment->boot();

		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->boot();
	}
}
