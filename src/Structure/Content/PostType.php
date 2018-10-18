<?php
/**
 * Abstract class for a custom post type.
 *
 * @author  Jeremy Ward <jeremy.ward@webdevstudios.com>
 * @package WDS\OopsWP\Structure\Content
 */

namespace WDS\OopsWP\Structure\Content;

use WDS\OopsWP\Utility\Registerable;

/**
 * Class PostType
 *
 * @package WDS\OopsWP\Structure\Content
 */
abstract class PostType implements Registerable {
	/**
	 * Post type slug.
	 *
	 * @var string
	 */
	protected $slug;

	/**
	 * Callback to register the post type with WordPress.
	 */
	public function register() {
		register_post_type(
			$this->slug,
			wp_parse_args( $this->get_registration_arguments(),  $this->get_default_registration_arguments() )
		);
	}

	/**
	 * Get the post type arguments.
	 *
	 * Defaults: Everything is set to true by default, with full post type support. Extending classes
	 * can turn off unwanted settings.
	 */
	private function get_default_registration_arguments() {
		return [
			'labels'   => $this->get_labels(),
			'public'   => true,
			'supports' => [ 'title', 'editor' ],
		];
	}

	/**
	 * Define customizations to the post type.
	 *
	 * At a minimum, the extending class should return an empty array.
	 *
	 * @return array
	 */
	abstract protected function get_registration_arguments() : array;

	/**
	 * Get the post type labels.
	 *
	 * Extending classes should be responsible for adding their own post type labels for translation purposes.
	 *
	 * @see https://codex.wordpress.org/Function_Reference/register_post_type#labels
	 * @return array
	 */
	abstract protected function get_labels() : array;
}
