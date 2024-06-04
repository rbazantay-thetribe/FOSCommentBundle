<?php

/*
 * This file is part of the FOSCommentBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use FOS\CommentBundle\FOSCommentBundle;
use FOS\CommentBundle\Tests\Functional\Bundle\CommentBundle\CommentBundle;
use FOS\RestBundle\FOSRestBundle;
use HandcraftedInTheAlps\RestRoutingBundle\RestRoutingBundle;
use JMS\SerializerBundle\JMSSerializerBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;

return [
    FrameworkBundle::class => ['all' => true],
    SecurityBundle::class => ['all' => true],
    TwigBundle::class => ['all' => true],
    DoctrineBundle::class => ['all' => true],
    FOSRestBundle::class => ['all' => true],
    RestRoutingBundle::class => ['all' => true],
    FOSCommentBundle::class => ['all' => true],
    JMSSerializerBundle::class => ['all' => true],
    CommentBundle::class => ['all' => true]
];
