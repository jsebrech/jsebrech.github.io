<?php
header("Content-type: text/plain; charset=utf-8");

echo "Lies".PHP_EOL.PHP_EOL;

$str = "abcxyz";
$char = $str[1];
echo "Lie 1: " . $char . PHP_EOL;
echo "Lie 2: " . strlen($str) . PHP_EOL;
$pos = strpos($str, "xyz");
echo "Lie 3: " . $pos . PHP_EOL;
$xyz = substr($str, 3, 3);
echo "Lie 4: " . $xyz . PHP_EOL;

echo PHP_EOL;

echo "Actually" . PHP_EOL.PHP_EOL;

$str = "аbcxyz";
echo "Truth 1: " . $str[1] . PHP_EOL;
echo "Truth 2: " . strlen($str) . PHP_EOL;
$pos = strpos($str, "xyz");
echo "Truth 3: " . $pos . PHP_EOL;
$xyz = substr($str, 3, 3);
echo "Truth 4: " . $xyz . PHP_EOL;

echo PHP_EOL;
echo "Some more...".PHP_EOL.PHP_EOL;

$arr = array("c", "b", "a");
sort($arr);
echo "Lie 5: " . implode($arr, ",") . PHP_EOL;
$arr = array("c", "b", "ä");
sort($arr);
echo "Truth 5: " . implode($arr, ",") . PHP_EOL;
$arr = array("resume", "résumé", "rope");
sort($arr);
echo "Truth 5b: " . implode($arr, ",") . PHP_EOL;
/*
 * natsort() sorts by byte, except for numbers where
 * it tries to sort by the whole number if starting at the same position
 * test11 < test100
 */
natsort($arr);
echo "Truth 5c: " . implode($arr, ",") . PHP_EOL;
sort($arr, SORT_LOCALE_STRING);
echo "Truth 5d: " . implode($arr, ",") . " (".setlocale(LC_COLLATE, 0) . ")" . PHP_EOL;
setlocale(LC_COLLATE, "en_US.UTF8");
sort($arr, SORT_LOCALE_STRING);
echo "Truth 5e: " . implode($arr, ",") . " (".setlocale(LC_COLLATE, 0) . ")" . PHP_EOL;
setlocale(LC_COLLATE, "C");
sort($arr);
// requires intl extension, not enabled by default, PHP 5.3+ only
$arr = array('rope', 'résumé', 'resume');
$col = new Collator("");
$col->sort($arr);
echo "Truth 5f: " . implode($arr, ",") . " (Collator)" . PHP_EOL;

echo PHP_EOL;
function hellŏ() {
  echo "test".PHP_EOL;
}
hellŏ();

echo PHP_EOL;
echo "mbstring:".PHP_EOL;
mb_internal_encoding("UTF-8");
$str = "аbcxyz";
echo "mb_strlen: " . mb_strlen($str) . PHP_EOL;
$pos = mb_strpos($str, "xyz");
echo "mb_strpos: " . $pos . PHP_EOL;
$xyz = mb_substr($str, 3, 3);
echo "mb_substr: " . $xyz . PHP_EOL;
echo "But \$str[1] still gives: " . $str[1] . PHP_EOL;

echo PHP_EOL;
echo "iconv:".PHP_EOL;
iconv_set_encoding("internal_encoding", "UTF-8");
$str = "аbcxyz";
echo "iconv_strlen: " . iconv_strlen($str) . PHP_EOL;
$pos = iconv_strpos($str, "xyz");
echo "iconv_strpos: " . $pos . PHP_EOL;
$xyz = iconv_substr($str, 3, 3);
echo "iconv_substr: " . $xyz . PHP_EOL;

echo PHP_EOL;
echo "intl:".PHP_EOL;
$str = "аbcxyz";
echo "grapheme_strlen: " . grapheme_strlen($str) . PHP_EOL;
$pos = grapheme_strpos($str, "xyz");
echo "grapheme_strpos: " . $pos . PHP_EOL;
$xyz = grapheme_substr($str, 3, 3);
echo "grapheme_substr: " . $xyz . PHP_EOL;

echo PHP_EOL;
echo "difference between mbstring, iconv and intl:".PHP_EOL;
$str = json_decode("\"u\\u0306\"");
echo $str . PHP_EOL;
echo "strlen: ".strlen($str).PHP_EOL;
echo "mb_strlen: ". mb_strlen($str).PHP_EOL;
echo "iconv_strlen: ". iconv_strlen($str).PHP_EOL;
echo "grapheme_strlen: ".grapheme_strlen($str).PHP_EOL;

