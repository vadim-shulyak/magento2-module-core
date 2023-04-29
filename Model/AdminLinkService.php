<?php declare(strict_types=1);

namespace EnjoyDevelop\Core\Model;

use Magento\Backend\Model\UrlInterface;

class AdminLinkService implements AdminLinkServiceInterface
{
    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @param UrlInterface $url
     */
    public function __construct(UrlInterface $url)
    {
        $this->url = $url;
    }

    /**
     * Returns Product Admin Url
     *
     * @param int $id
     * @return string
     */
    public function getAdminProductLink(int $id): string
    {
        return $this->url->getUrl(AdminLinkServiceInterface::PRODUCT_BASE_LINK, ['id' => $id]);
    }
}
