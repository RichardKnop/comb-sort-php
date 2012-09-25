<?php
 
define('SHRINK_FACTOR', 1.3);
 
$arr = array();
for ($i = 0; $i < 100; ++$i) {
    $arr[] = $i;
}
shuffle($arr);
$sortedArr = combSort($arr);
var_dump($sortedArr);
 
function combSort(array $arr) {
    $gap = floor(count($arr)/SHRINK_FACTOR);
    while ($gap > 0) {
        for ($i = 0; $i < count($arr)-$gap; ++$i) {
            $arrWithGapsKeys = array();
            $arrWithGaps = array();
            $loop = true;
            $j = $i;
            while ($loop) {
                if (isset($arr[$j])) {
                    $arrWithGapsKeys[] = (int)$j;
                    $arrWithGaps[] = $arr[$j];
                    $j += $gap;
                } else {
                    $loop = false;
                }
            }
            $arrWithGapsOrdered = bubbleSort($arrWithGaps);
            foreach ($arrWithGapsKeys as $key) {
                $arr[$key] = current($arrWithGapsOrdered);
                next($arrWithGapsOrdered);
            }
        }
        $gap = floor($gap/SHRINK_FACTOR);
    }
    return $arr;
}
 
function bubbleSort(array $arr) {
    $sorted = false;
    while (false === $sorted) {
        $sorted = true;
        for ($i = 0; $i < count($arr)-1; ++$i) {
            $current = $arr[$i];
            $next = $arr[$i+1];
            if ($next < $current) {
                $arr[$i] = $next;
                $arr[$i+1] = $current;
                $sorted = false;
            }
        }
    }
    return $arr;
}
