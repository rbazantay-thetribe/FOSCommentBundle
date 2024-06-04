<?php

/*
 * This file is part of the FOSCommentBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace FOS\CommentBundle\Tests\Functional\Bundle\CommentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Thread as BaseThread;

#[ORM\Entity]
#[ORM\Table(name: 'test_thread')]
#[ORM\ChangeTrackingPolicy('DEFERRED_EXPLICIT')]
class Thread extends BaseThread
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    protected $id;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }
}
