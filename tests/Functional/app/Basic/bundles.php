<?php

/*
 * This file is part of the FOSCommentBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

return [
    \Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    \Symfony\Bundle\SecurityBundle\SecurityBundle::class => ['all' => true],
    \Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    \Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    \FOS\RestBundle\FOSRestBundle::class => ['all' => true],
    \FOS\CommentBundle\FOSCommentBundle::class => ['all' => true],
    \JMS\SerializerBundle\JMSSerializerBundle::class => ['all' => true],
    \FOS\CommentBundle\Tests\Functional\Bundle\CommentBundle\CommentBundle::class => ['all' => true]
];
