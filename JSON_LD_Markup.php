<?php

namespace vnh\markup;

use vnh\contracts\Bootable;
use vnh\contracts\Displayable;

class JSON_LD_Markup implements Bootable, Displayable {
	public $generators;

	public function boot() {
		add_action('wp_head', [$this, 'init']);
		add_action('wp_head', [$this, 'display']);
	}

	public function init() {
		$this->generators = apply_filters('vnh/json_ld/generators', $this->generators);
	}

	public function display() {
		if (empty($this->generators)) {
			return;
		}

		foreach ($this->generators as $generator) {
			printf('<script type="application/ld+json">%s</script>%s', wp_json_encode($generator, JSON_PRETTY_PRINT), PHP_EOL);
		}
	}
}
