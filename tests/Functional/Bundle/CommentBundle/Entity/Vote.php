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
use FOS\CommentBundle\Entity\Vote as BaseVote;
use FOS\CommentBundle\Model\SignedVoteInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: 'test_vote')]
#[ORM\ChangeTrackingPolicy('DEFERRED_EXPLICIT')]
class Vote extends BaseVote implements SignedVoteInterface
{

    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected $id;


    #[ORM\Column(type: 'string')]
    protected $voter;


    public function setVoter(UserInterface $voter): void
    {
        $this->voter = method_exists($voter, 'getUsername') ? $voter->getUsername() : $voter->getUserIdentifier();
    }


    public function getVoter(): UserInterface
    {
        return $this->voter;
    }
}
