<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace blitze\sitemaker\exception;

/**
* Base exception
*/
class base extends \Exception
{
	/**
	 * Null if the message is a string, array if the message was submitted as an array
	 * @var string|array
	 */
	protected $message_full;

	/**
	 * Send a string to translate all of the portions with the parent message
	 * (typically used to format a string with the given message portions).
	 * Null to ignore. Default: Null
	 * @var string|null
	 */
	protected $parent_message = null;

	protected $previous;

	/**
	 * Constructor
	 *
	 * Different from normal exceptions in that we do not enforce $message to be a string.
	 *
	 * @param string|array $message
	 * @param int $code
	 * @param \Exception $previous
	 * @access public
	 */
	public function __construct($message = null, $code = 0, \Exception $previous = null)
	{
		// We're slightly changing the way exceptions work
		// Tools, such as xdebug, expect the message to be a string, so to prevent errors
		// with those tools, we store our full message in message_full and only a string in message
		if (is_array($message))
		{
			$this->message = (string) $message[0];
		}
		else
		{
			$this->message = $message;
		}
		$this->message_full = $message;

		$this->code = $code;
		$this->previous = $previous;
	}

	/**
	 * Translate this exception
	 *
	 * @param \phpbb\language\language $translator
	 * @return array|string
	 * @access public
	 */
	public function get_message(\phpbb\language\language $translator)
	{
		return $this->translate_portions($translator);
	}

	/**
	 * Translate all portions of the message sent to the exception
	 *
	 * Goes through each element of the array and tries to translate them
	 *
	 * @param \phpbb\language\language $translator
	 * @return array|string Array if $parent_message === null else a string
	 * @access protected
	 */
	protected function translate_portions(\phpbb\language\language $translator)
	{
		// Make sure our language file has been loaded
		$this->add_lang($translator);

		// Ensure we have an array
		if (!is_array($this->message_full))
		{
			$this->message_full = array($this->message_full);
		}

		// Translate each message portion
		foreach ($this->message_full as &$message)
		{
			// Attempt to translate each portion
			$translated_message = $translator->lang('EXCEPTION_' . $message);

			// Check if translating did anything
			if ($translated_message !== 'EXCEPTION_' . $message)
			{
				// It did, so replace message with the translated version
				$message = $translated_message;
			}
		}
		// Always unset a variable passed by reference in a foreach loop
		unset($message);

		if ($this->parent_message !== null)
		{
			// Prepend the parent message to the message portions
			array_unshift($this->message_full, (string) $this->parent_message);

			// We return a string
			return call_user_func_array(array($translator, 'lang'), $this->message_full);
		}

		// We return an array
		return $this->message_full;
	}

	/**
	 * Add our language file
	 *
	 * @param \phpbb\language\language $translator
	 * @return null
	 * @access public
	 */
	public function add_lang(\phpbb\language\language $translator)
	{
		static $is_loaded = false;

		// We only need to load the language file once
		if ($is_loaded)
		{
			return;
		}

		// Add our language file
		$translator->add_lang('exceptions', 'blitze/sitemaker');

		// So the language file is only loaded once
		$is_loaded = true;
	}

	/**
	 * Output a string of this error message
	 *
	 * This will hopefully be never called, always catch the expected exceptions
	 * and call get_message to translate them into an error that a user canunderstand
	 *
	 * @return string
	 * @access public
	 */
	public function __toString()
	{
		return (is_array($this->message_full)) ? var_export($this->message_full, true) : (string) $this->message_full;
	}
}
