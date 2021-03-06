<?php
declare(strict_types=1);
namespace In2code\Luxletter\Widget;

use Doctrine\DBAL\DBALException;
use In2code\Luxletter\Domain\Repository\NewsletterRepository;
use In2code\Luxletter\Utility\ObjectUtility;
use TYPO3\CMS\Dashboard\Widgets\AbstractNumberWithIconWidget;
use TYPO3\CMS\Extbase\Object\Exception;

/**
 * Class NewsletterWidget
 */
class NewsletterWidget extends AbstractNumberWithIconWidget
{
    protected $title =
        'LLL:EXT:luxletter/Resources/Private/Language/locallang_db.xlf:module.dashboard.widget.newsletter.title';
    protected $description =
        'LLL:EXT:luxletter/Resources/Private/Language/locallang_db.xlf:module.dashboard.widget.newsletter.description';
    protected $iconIdentifier = 'extension-luxletter';
    protected $height = 1;
    protected $width = 1;

    protected $subtitle = '';
    protected $number = 0;
    protected $icon = 'luxletter-widget-newsletter';

    /**
     * @return void
     * @throws DBALException
     * @throws Exception
     */
    public function initializeView(): void
    {
        $newsletterRepository = ObjectUtility::getObjectManager()->get(NewsletterRepository::class);
        $this->number = $newsletterRepository->findAll()->getQuery()->setLimit(10000)->execute()->count();
        parent::initializeView();
    }
}
