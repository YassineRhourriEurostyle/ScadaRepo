<?php
namespace App\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Twig extensions for year related functions
 */
class GmdYearExtension extends AbstractExtension
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('inYearRange', array($this, 'inYearRange')),
            new TwigFunction('currentSemesterName', array($this, 'currentSemesterName')),
        );
    }

    /**
     * Checks if a given year is within the range given. The range is based on the year of the current semester
     * The parameters are start and offset values
     */
    public function inYearRange($year, $start, $offset)
    {
        $currentSemester = $this->container->get('app.semester_manager')->getCurrentSemester();
        $startYear = $currentSemester->getYear() + $start;
        $endYear = $startYear + $offset;

        if ($year >= $startYear && $year <= $endYear) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns the name of the current semester
     */
    public function currentSemesterName()
    {
        $currentSemester = $this->container->get('app.semester_manager')->getCurrentSemester();
        
        return $currentSemester->getReadableName();


    }

    public function getName()
    {
        return 'gmdYearExtension';
    }
}