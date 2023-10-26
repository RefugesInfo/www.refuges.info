<?php

namespace cleantalk\antispam\library\Cleantalk;

class Errors
{
	/**
	 * Please, add new errors type used in code
	 *
	 * @return array
	 */
	private static function errorsStorage()
	{
		return array(
			'sfw_update_error',
			'sfw_send_logs_error'
		);
	}

	/**
	 * Get saved errors
	 *
	 * @return array
	 */
	public static function getErrors()
	{
		global $config;

		return isset($config['cleantalk_errors']) ? json_decode($config['cleantalk_errors'], true) : array();
	}

	/**
	 * Add new error
	 */
	public static function addError($errorId, $errorMessage)
	{
		global $config;

		$errors = self::getErrors();
		$errors[$errorId] = $errorMessage;

		$config->set('cleantalk_errors',  json_encode($errors));
	}

	/**
	 * Remove error
	 */
	public static function removeError($errorId)
	{
		global $config;

		$errors = self::getErrors();

		if (isset($errors[$errorId])) {
			unset($errors[$errorId]);
		}

		$config->set('cleantalk_errors',  json_encode($errors));
	}
}