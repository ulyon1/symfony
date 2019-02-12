<?php

namespace Metinet\Security;

use Metinet\Blog\BlogPost;
use Metinet\Students\Student;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class BlogPostVoter extends Voter
{
    public const EDIT = 'edit';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject): bool
    {
        // if the attribute isn't one we support, return false
        if ($attribute !== self::EDIT) {

            return false;
        }

        // only vote on Post objects inside this voter
        if (!$subject instanceof BlogPost) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if ($this->security->isGranted('ROLE_ADMIN')) {

            return true;
        }

        if (!$user instanceof Student) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Post object, thanks to supports
        /** @var BlogPost $post */
        $post = $subject;

        if (self::EDIT === $attribute) {

            return $this->canEdit($post, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canEdit(BlogPost $post, Student $author): bool
    {
        return $author->getId() === $post->getStudentId();
    }
}
