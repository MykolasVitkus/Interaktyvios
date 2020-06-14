<?php

namespace App\DataFixtures\MongoDB;

use App\Document\Configuration;
use App\Document\ContactMessage;
use App\Document\Section;
use App\Document\SocialLink;
use App\Document\User;
use Doctrine\Bundle\MongoDBBundle\Fixture\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ODM\MongoDB\DocumentManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setEmail('admin')->setPlainPassword('admin');

        $manager->persist($user);

        $configuration = new Configuration();
        $configuration
            ->setSiteTitle('Mykolas Vitkus - portfolio')
            ->setFullName('Mykolas Vitkus')
            ->setHeadline('software developer')
            ->setPersonalEmail('mykolasvitkus@gmail.com')
        ;
        $manager->persist($configuration);
        $manager->flush();

        $link = new SocialLink();

        $link
            ->setIcon('linkedin')
            ->setUrl('https://www.linkedin.com/in/mykolas-vitkus-7b9159152/')
        ;
        $manager->persist($link);
        $manager->flush();

        for ($i = 0; $i < 2; $i++) {
            $message = new ContactMessage();

            $message
                ->setTitle('About our agreement')
                ->setEmail('gamblingen@confriti.tk')
                ->setContent('Hello, i was really interested by your profile! I would like to offer you a scholarship, please reply!')
                ->setName('George')
                ->setSentAt(new \DateTime('-1 day'))
            ;

            $manager->persist($message);
            $manager->flush();

            $message = new ContactMessage();

            $message
                ->setTitle('Question')
                ->setEmail('gamblingen@confriti.tk')
                ->setContent('Hello, i was really interested by your profile! I would like to offer you a scholarship, please reply!')
                ->setName('George')
                ->setSentAt(new \DateTime('-2 day'))

            ;

            $manager->persist($message);
            $manager->flush();

            $message = new ContactMessage();

            $message
                ->setTitle('I really liked your profile')
                ->setEmail('ckelsy1@gerher3-privberh.fun')
                ->setContent('Hello, i was really interested by your profile! I would like to offer you a scholarship, please reply!')
                ->setName('Lyan')
                ->setSentAt(new \DateTime('-3 day'))

            ;

            $manager->persist($message);
            $manager->flush();

            $message = new ContactMessage();

            $message
                ->setTitle('New terms')
                ->setEmail('1riska@westernbloggen.online')
                ->setContent('Hello, i was really interested by your profile! I would like to offer you a scholarship, please reply!')
                ->setName('Adam')
                ->setSentAt(new \DateTime('-4 day'))

            ;

            $manager->persist($message);
            $manager->flush();

            $message = new ContactMessage();

            $message
                ->setTitle('Contact me')
                ->setEmail('9bigbilly2000o@w45678.com')
                ->setContent('Hello, i was really interested by your profile! I would like to offer you a scholarship, please reply!')
                ->setName('John')
                ->setSentAt(new \DateTime('-5 day'))

            ;

            $manager->persist($message);
            $manager->flush();
        }
        $section = new Section();
        $section
            ->setTitle('About')
            ->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
        ;

        $manager->persist($section);

        $section = new Section();
        $section
            ->setTitle('My Skills')
            ->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
        ;

        $manager->persist($section);
        $manager->flush();
    }
}
