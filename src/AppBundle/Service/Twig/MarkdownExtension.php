<?php
/**
 * Created by PhpStorm.
 * User: leaphu
 * Date: 2017/7/23
 * Time: 上午10:17
 */

namespace AppBundle\Service\Twig;


class MarkdownExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('markdownify',array($this,'parseMarkdown'))
        ];
    }

    public function parseMarkdown($str)
    {
        return strtolower($str);
    }

    public function getName()
    {
        return 'app_markdown';
    }

}