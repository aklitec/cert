<?php
/**
 * Created by PhpStorm.
 * User: mistermed90
 * Date: 10/27/18
 * Time: 4:01 AM
 */

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture


{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('med');
        $user->setEmail('aklitek@contact.ma');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword(
            $this->encoder->encodePassword($user,'0123')
        );
        $manager->persist($user);
        $manager->flush();
    }

}