<?php
namespace App\Security;

use App\Entity\Vehicle;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class VehicleVoter extends Voter
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

        // only vote on Vehicle objects inside this voter
        if (!$subject instanceof Vehicle) {
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

        $vehicle = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($vehicle, $token);
            case self::EDIT:
                return $this->canEdit($vehicle, $token);
            case self::CREATE:
                return $this->canCreate($vehicle, $token);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Vehicle $vehicle, TokenInterface $token)
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

    private function canEdit(Vehicle $vehicle, TokenInterface $token)
    {
        if ($this->decisionManager->decide($token, array('ROLE_EDIT'))) {
            return true;
        }

        $user = $token->getUser();

        if ($this->decisionManager->decide($token, array('ROLE_KAM')) && $user->getMarques()->contains($vehicle->getMarque())) {
            return true;
        }

        return false;
    }

    private function canCreate(Vehicle $vehicle, TokenInterface $token)
    {
        if ($this->decisionManager->decide($token, array('ROLE_CREATE', 'ROLE_KAM'))) {
            return true;
        }

        return false;
    }
}