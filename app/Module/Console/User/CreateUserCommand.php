<?php

declare(strict_types=1);

namespace Minecord\Module\Console\User;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Minecord\Model\User\UserData;
use Minecord\Model\User\UserFacade;

final class CreateUserCommand extends Command
{
	/** @var string */
	public static $defaultName = 'minecord:user:create';

	private UserFacade $userFacade;

	public function __construct(
		UserFacade $userFacade
	) {
		parent::__construct();
		$this->userFacade = $userFacade;
	}

	public function execute(InputInterface $input, OutputInterface $output): int
	{
		/** @var QuestionHelper $questionHelper */
		$questionHelper = $this->getHelper('question');

		$userData = new UserData();
		$userData->displayName = (string) $questionHelper->ask($input, $output, new Question('User display name: '));
		$userData->email = (string) $questionHelper->ask($input, $output, new Question('User email: '));
		$userData->password = (string) $questionHelper->ask($input, $output, new Question('User password: '));

		$user = $this->userFacade->create($userData);

		$output->writeln('<info>New useristrator "' . $user->getDisplayName() . '" was created!</info>');
		
		return 1;
	}
}
