<?php declare(strict_types=1);

namespace EnjoyDevelop\Core\Plugin\Config\Block\System\Config\Form;

use Magento\Config\Block\System\Config\Form\Field as NativeField;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\View\Asset\Repository;

class Field
{
    /**
     * @var Repository
     */
    private $assetRepo;

    /**
     * @param Repository $assetRepo
     */
    public function __construct(Repository $assetRepo)
    {
        $this->assetRepo = $assetRepo;
    }

    /**
     * Modify retrieved HTML markup for given form element
     *
     * @param NativeField $field
     * @param string $html
     * @param AbstractElement $element
     * @return string
     */
    public function afterRender(
        NativeField $field,
        string $html,
        AbstractElement $element
    ): string {
        if (str_contains((string)$html, 'tooltip-content')) {
            $html = $this->replaceString($html);
        }

        $elementTooltip = (string)$element->getTooltip();
        if ($elementTooltip) {
            $elementTooltip = $this->replaceString($elementTooltip);
            $element->setTooltip($elementTooltip);
        }

        return $html;
    }

    /**
     * Replace String - to allow using of the EnjoyDevelop images in tooltips
     *
     * @param string $content
     * @return string
     */
    private function replaceString(string $content): string
    {
        preg_match('/<img.*?src="(EnjoyDevelop.*?)"/', $content, $result);
        if (count($result) >= 2) {
            $path = $result[1];
            $newPath = $this->assetRepo->getUrl($path);
            if ($newPath) {
                $content = str_replace($path, $newPath, $content);
            }
        }

        return $content;
    }
}
