<?php


namespace App\Services;


use App\Entity\User;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Symfony\Component\Mailer\Mailer;

class MailerManager
{

    public function confirmRegistration(User $user, Mailer $mailer, TwigExtension $twig) {

    }

}