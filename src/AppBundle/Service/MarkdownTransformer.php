<?php
/**
 * Created by PhpStorm.
 * User: leaphu
 * Date: 2017/7/21
 * Time: 上午2:02
 */

namespace AppBundle\Service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Doctrine\Common\Cache\Cache;
class MarkdownTransformer
{
    private $markdownParser;
    /**
     * @var Cache
     */
    private $cache;

    public  function __construct(MarkdownParserInterface $markdownParser,Cache $cache)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
    }

    public function parse($str)
    {

        $cache = $this->cache;
        $key = md5($str);
        if($cache->contains($key)) {
            return $cache->fetch($key);
        }
        sleep(1);
        $str =  $this->markdownParser ->transform($str);
        $cache->save($key,$str);
        return $str;
    }
}