<?php

/**
* @package   s9e\TextFormatter
* @copyright Copyright (c) 2010-2019 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\TextFormatter\Configurator\RulesGenerators;

use s9e\TextFormatter\Configurator\Helpers\TemplateInspector;
use s9e\TextFormatter\Configurator\RulesGenerators\Interfaces\BooleanRulesGenerator;

class AutoCloseIfVoid implements BooleanRulesGenerator
{
	/**
	* {@inheritdoc}
	*/
	public function generateBooleanRules(TemplateInspector $src)
	{
		return ($src->isVoid()) ? ['autoClose' => true] : [];
	}
}