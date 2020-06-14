<?php


namespace App\Command;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-user';

    private DocumentManager $documentManager;

    public function __construct(DocumentManager $documentManager, string $name = null)
    {
        $this->documentManager = $documentManager;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates a new admin user.')
            ->setHelp('This command allows you to create a user...')
            ->addArgument('email', InputArgument::REQUIRED , 'User password')
            ->addArgument('password', InputArgument::REQUIRED, 'User password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $user = new User();

        $user
            ->setEmail($email)
            ->setRoles(['ROLE_ADMIN'])
            ->setPlainPassword($password)
        ;

        $this->documentManager->persist($user);
        $this->documentManager->flush();

        return 0;
    }
}