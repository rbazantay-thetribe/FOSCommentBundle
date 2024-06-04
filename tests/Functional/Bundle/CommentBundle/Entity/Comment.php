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
use FOS\CommentBundle\Entity\Comment as BaseComment;
use FOS\CommentBundle\Model\SignedCommentInterface;
use FOS\CommentBundle\Model\ThreadInterface;
use FOS\CommentBundle\Model\VotableCommentInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: 'test_comment')]
#[ORM\ChangeTrackingPolicy('DEFERRED_EXPLICIT')]
class Comment extends BaseComment implements SignedCommentInterface, VotableCommentInterface
{
    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected $id;


    #[ORM\ManyToOne(targetEntity: Thread::class)]
    protected $thread;


    #[ORM\Column(type: 'string', nullable: true)]
    protected $author;


    #[ORM\Column(type: 'integer')]
    protected $score = 0;


    public function getThread(): Thread
    {
        return $this->thread;
    }

    public function setThread(ThreadInterface $thread): void
    {
        $this->thread = $thread;
    }


    public function setAuthor(UserInterface $author): void
    {
        $this->author = method_exists($author, 'getUsername') ? $author->getUsername() : $author->getUserIdentifier();

    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setScore($score): void
    {
        $this->score = $score;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function incrementScore($by = 1): void
    {
        $this->score += $by;
    }

    public function getAuthorName(): string
    {
        return $this->author ?: parent::getAuthorName();
    }
}
