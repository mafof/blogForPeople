<?php
namespace App\Core;

trait TransformSpecialTags {
    private static function transformHtmlTagImgToSpecialTagImg($text) {}

    public static function transformHtmlTagsToSpecialTags($text) {

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