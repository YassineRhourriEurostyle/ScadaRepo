<?php
namespace App\Security;

use App\Entity\Project;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class ProjectVoter extends Voter
{
    const CREATE = 'create';
    const EDIT = 'edit';
    const VIEW = 'view';

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW, self::EDIT, self::CREATE))) {
            return false;
        }

        // only vote on Project objects inside this voter
        if (!$subject instanceof Project) {
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

        $project = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($project, $token);
            case self::EDIT:
                return $this->canEdit($project, $token);
            case self::CREATE:
                return $this->canCreate($project, $token);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Project $project, TokenInterface $token)
    {
        if ($this->decisionManager->decide($token, array('ROLE_READ'))) {
            return true;
        }

        $user = $token->getUser();

        if ($this->decisionManager->decide($token, array('ROLE_KAM')) && !$user->getMarques()->isEmpty()) {
            return true;
        }

        return false;
    }

    private function canEdit(Project $project, TokenInterface $token)
    {
        if ($this->decisionManager->decide($token, array('ROLE_EDIT'))) {
            return true;
        }

        $user = $token->getUser();

        if ($this->decisionManager->decide($token, array('ROLE_KAM')) && $user->getMarques()->contains($project->getMarque())) {
            return true;
        }

        return false;
    }

    private function canCreate(Project $project, TokenInterface $token)
    {
        if ($this->decisionManager->decide($token, array('ROLE_CREATE', 'ROLE_KAM'))) {
            return true;
        }

        return false;
    }
}