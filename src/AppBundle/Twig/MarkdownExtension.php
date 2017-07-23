<?php
/**
 * Created by PhpStorm.
 * User: leaphu
 * Date: 2017/7/23
 * Time: 上午10:17
 */

namespace AppBundle\Twig;


use AppBundle\Service\MarkdownTransformer;

class MarkdownExtension extends \Twig_Extension
{
    /**
     * @var MarkdownTransformer
     */
    private $markdownTransformer;

    public function  __construct(MarkdownTransformer $markdownTransformer)
    {

        $this->markdownTransformer = $markdownTransformer;
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('markdownify',array($this,'parseMarkdown'))
        ];
    }

    public function parseMarkdown($str)
    {
        return $this->markdownTransformer->parse($str);
//        return strtolower($str);
    }

    public function getName()
    {
        return 'app_markdown';
    }

}