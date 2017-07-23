<?php
/**
 * Created by PhpStorm.
 * User: leaphu
 * Date: 2017/7/21
 * Time: 上午2:02
 */

namespace AppBundle\Service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownTransformer
{
    private $markdownParser;
    public  function __construct(MarkdownParserInterface $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function parse($str)
    {
            return $this->markdownParser
                ->transform($str);
    }
}