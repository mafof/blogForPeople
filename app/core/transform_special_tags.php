<?php
namespace App\Core;

trait TransformSpecialTags {
    private static function transformHtmlTagImgToSpecialTagImg($text, $tagsImage) {
        if(empty($tagsImage)) return $text;
        $imgSpecialTag = '[inpImg=';

        foreach($tagsImage as $item) {
            $imgTag = $item[0];

            $uri = explode("=", $imgTag)[1];
            $uri = substr($uri, 1, mb_strlen($uri) - 3);

            $text = preg_replace($imgTag, $imgSpecialTag . $uri . ']', $text);
            $text = preg_replace(['/<\[/', '/\]>/'], ['[', ']'], $text);
        }

        return $text;
    }

    public static function transformHtmlTagsToSpecialTags($text) {
        $text = preg_replace(['/\<b\>/', '/\<\/b\>/'], ['[b]', '[/b]'], $text);
        $text = preg_replace(['/\<s\>/', '/\<\/s\>/'], ['[s]', '[/s]'], $text);
        $text = preg_replace(['/\<div class="spoiler"\>/', '/\<\/div\>/'], ['[h]', '[/h]'], $text);
        $text = preg_replace('/\<br\>/', '&#13', $text);

        preg_match_all('/\<img src=\'[a-zA-Zа-яА-Я0-9:\/.\-]+\'\>/', $text, $resultTagImage, PREG_OFFSET_CAPTURE);
        $text = TransformSpecialTags::transformHtmlTagImgToSpecialTagImg($text, $resultTagImage[0]);

        return $text;
    }

    private static function transformSpecialTagImgToHtmlTagImg($text, $tagsImage) {
        if(empty($tagsImage)) return $text;
        $offset = 0;
        $resultString = '';

        foreach ($tagsImage as $key => $item) {
            $url = explode('=', $tagsImage[$key][0])[1];
            $url = substr($url, 0, mb_strlen($url)-1);

            $resultString .= substr($text, $offset, $tagsImage[$key][1] - $offset) . "<img src='". $url ."'>";
            $offset += $tagsImage[$key][1] + mb_strlen($tagsImage[$key][0]);
        }

        return $resultString;
    }

    public static function transformSpecialTagsToHtmlTags($text) {
        $text = preg_replace(['/(\[b\])/', '/(\[\/b\])/'], ['<b>', '</b>'], $text);
        $text = preg_replace(['/(\[s\])/', '/(\[\/s\])/'], ['<s>', '</s>'], $text);
        $text = preg_replace(['/(\[h\])/', '/(\[\/h\])/'], ['<div class="spoiler">', '</div>'], $text);
        $text = preg_replace('/(\[nl\])/', '<br>', $text);

        preg_match_all('/\[inpImg=[a-zA-Zа-яА-Я0-9:\/.\-]+\]/', $text, $resultTagImage, PREG_OFFSET_CAPTURE);
        $text = TransformSpecialTags::transformSpecialTagImgToHtmlTagImg($text, $resultTagImage[0]);

        return $text;
    }
}