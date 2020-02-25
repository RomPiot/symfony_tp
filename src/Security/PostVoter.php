<?php
namespace App\Security;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class PostVoter extends Voter
{
    // these strings are just invented: you can use anything
    const DELETE = 'delete';
    const EDIT = 'edit';
    const PUBLISH = 'publish';
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::DELETE, self::EDIT, self::PUBLISH])) {
            return false;
        }

        // only vote on Post objects inside this voter
        if (!$subject instanceof Post) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // ROLE_ADMIN can do anything! The power!
        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        // you know $subject is a Post object, thanks to supports
        /** @var Post $post */
        $post = $subject;

        switch ($attribute) {
            case self::DELETE:
                return $this->canDelete($post, $user);
            case self::EDIT:
                return $this->canEdit($post, $user);
            case self::PUBLISH:
                return $this->canPublish($post, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canDelete(Post $post, User $user)
    {
        // if they can edit, they can delete
        if ($this->canPublish($post, $user)) {
            return true;
        }

        // the Post object could have, for example, a method isPrivate()
        // that checks a boolean $private property
        return !$post->getIsPublished();
    }

    private function canPublish(Post $post, User $user)
    {
        // if they can edit, they can delete
        if ($this->security->isGranted('ROLE_AUTHOR')) {
            return $user === $post->getAuthor();
        }
    }

    private function canEdit(Post $post, User $user)
    {
        // this assumes that the data object has a getAuthor() method
        // to get the entity of the user who owns this data object
        if (($this->canPublish($post, $user)) && $post->getIsPublished() OR ($user->getRoles() == "ROLE_ADMIN")) {
            return $user === $post->getAuthor();
        }
    }
}