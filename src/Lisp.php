<?php
/**
 * WildPHP - an advanced and easily extensible IRC bot written in PHP
 * Copyright (C) 2017 WildPHP
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Yoshi2889\WPHPModules\Lisp;

use Desmond\Desmond;
use WildPHP\Core\Channels\Channel;
use WildPHP\Core\Commands\Command;
use WildPHP\Core\Commands\CommandHandler;
use WildPHP\Core\Commands\CommandHelp;
use WildPHP\Core\Commands\ParameterStrategy;
use WildPHP\Core\Commands\StringParameter;
use WildPHP\Core\ComponentContainer;
use WildPHP\Core\Connection\Queue;
use WildPHP\Core\ContainerTrait;
use WildPHP\Core\Modules\BaseModule;
use WildPHP\Core\Users\User;

class Lisp extends BaseModule
{
	use ContainerTrait;

	/**
	 * @var Desmond
	 */
	protected $desmondInstance;

	/**
	 * Lisp constructor.
	 *
	 * @param ComponentContainer $container
	 */
	public function __construct(ComponentContainer $container)
	{
		CommandHandler::fromContainer($container)->registerCommand('lisp',
			new Command(
				[$this, 'lispCommand'],
				new ParameterStrategy(1, -1, [
					'code' => new StringParameter()
				], true),
				new CommandHelp([
					'Execute LISP code in Desmond. Usage: lisp [code]'
				]),
				'lisp'
			));

		$this->setContainer($container);
		$this->setDesmondInstance(new Desmond());
	}

	/**
	 * @param Channel $source
	 * @param User $user
	 * @param array $args
	 * @param ComponentContainer $container
	 */
	public function lispCommand(Channel $source, User $user, array $args, ComponentContainer $container)
	{
		$code = $args['code'];

		$return = $this->getDesmondInstance()->run($code);
		$return = $this->getDesmondInstance()->pretty($return);
		$return = str_replace("\n", " || ", str_replace("\r", "", $return));
		if (strlen($return) > 230)
			$return = substr($return, 0, 230) . '... (truncated output)';

		Queue::fromContainer($container)->privmsg($source->getName(), '#> ' . $return);
	}

	/**
	 * @return Desmond
	 */
	public function getDesmondInstance(): Desmond
	{
		return $this->desmondInstance;
	}

	/**
	 * @param Desmond $desmondInstance
	 */
	public function setDesmondInstance(Desmond $desmondInstance)
	{
		$this->desmondInstance = $desmondInstance;
	}

	/**
	 * @return string
	 */
	public static function getSupportedVersionConstraint(): string
	{
		return '^3.0.0';
	}
}