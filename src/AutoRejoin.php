<?php
/**
 * Copyright 2017 The WildPHP Team
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace WildPHP\Modules\AutoRejoin;

use WildPHP\Core\ComponentContainer;
use WildPHP\Core\Configuration\Configuration;
use WildPHP\Core\Connection\IRCMessages\KICK;
use WildPHP\Core\Connection\Queue;
use WildPHP\Core\ContainerTrait;
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

	/**
	 * @param KICK $ircMessage
	 * @param Queue $queue
	 */
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