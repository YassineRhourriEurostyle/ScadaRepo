<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Twig extensions for date related functions
 */
class GmdDateExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return array(
            new TwigFunction('isBeforeToday', array($this, 'isBeforeToday')),
            new TwigFunction('isAfterToday', array($this, 'isAfterToday')),
        );
    }

    /**
     * Checks if the given date is before today's date
     */
    public function isBeforeToday($date)
    {
        $today = new \DateTime();

        return $date < $today;
    }

    /**
     * Checks if the given date is after today's date
     */
    public function isAfterToday($date)
    {
        $today = new \DateTime();

        return $date > $today;
    }

    public function getName()
    {
        return 'gmdDateExtension';
    }
}