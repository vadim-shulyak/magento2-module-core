<?php declare(strict_types=1);

namespace EnjoyDevelop\Core\Model;

interface AdminLinkServiceInterface
{
    public const PRODUCT_BASE_LINK = 'catalog/product/edit';

    /**
     * Returns Product Admin Url
     *
     * @param int $id
     * @return string
     */
    public function getAdminProductLink(int $id): string;
}
