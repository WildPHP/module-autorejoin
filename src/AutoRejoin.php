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

namespace WildPHP\Modules\AutoRejoin;

use WildPHP\Core\Configuration\Configuration;
use WildPHP\Core\Connection\IRCMessages\KICK;
use WildPHP\Core\Connection\Queue;
use WildPHP\Core\ContainerTrait;
use WildPHP\Core\ComponentContainer;
use WildPHP\Core\EventEmitter;
use WildPHP\Core\Logger\Logger;

class AutoRejoin
{
	use ContainerTrait;

	/**
	 * AutoRejoin constructor.
	 *
	 * @param ComponentContainer $container
	 */
	public function __construct(ComponentContainer $container)
	{
		EventEmitter::fromContainer($container)
			->on('irc.line.in.kick', [$this, 'autoRejoin']);

		$this->setContainer($container);
	}

	public function autoRejoin(KICK $ircMessage, Queue $queue)
	{
		$currentNickname = Configuration::fromContainer($this->getContainer())
			->get('currentNickname')
			->getValue();

		if ($currentNickname != $ircMessage->getTarget())
			return;

		$channel = $ircMessage->getChannel();
		$offender = $ircMessage->getNickname();

		Logger::fromContainer($this->getContainer())
			->info('Rejoining channel after being kicked...', [
				'kickedBy' => $offender,
				'channel' => $channel
			]);

		$queue->join($channel);
	}
}