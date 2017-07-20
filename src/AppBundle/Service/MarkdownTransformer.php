<?php
/**
 * Created by PhpStorm.
 * User: leaphu
 * Date: 2017/7/21
 * Time: 上午2:02
 */

namespace AppBundle\Service;


class MarkdownTransformer
{
    public function parse($str)
    {
        return strtoupper($str);
    }
}