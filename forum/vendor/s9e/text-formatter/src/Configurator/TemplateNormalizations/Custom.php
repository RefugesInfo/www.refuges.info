<?php

/**
* @package   s9e\TextFormatter
* @copyright Copyright (c) 2010-2020 The s9e authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\TextFormatter\Configurator\TemplateNormalizations;

use DOMElement;

class Custom extends AbstractNormalization
{
	/**
	* @var callback Normalization callback
	*/
	protected $callback;

	/**
	* Constructor
	*
	* @param  callback $callback Normalization callback
	*/
	public function __construct(callable $callback)
	{
		$this->callback = $callback;
	}

	/**
	* Call the user-supplied callback
	*
	* @param  DOMElement $template <xsl:template/> node
	* @return void
	*/
	public function normalize(DOMElement $template)
	{
		call_user_func($this->callback, $template);
	}
}