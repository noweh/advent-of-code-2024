<?php

// load the input file
$input = file_get_contents('./inputs/inputs-1.txt');

// split the input into two lists
$list1 = [];
$list2 = [];
$lines = explode("\n", $input);
foreach ($lines as $line) {
    $content = explode('   ', $line);
    $list1[] = (int)$content[0];
    $list2[] = (int)$content[1];
}

sort($list1);
sort($list2);

// loop through the lists and compare the values
// add the difference to the $diff variable
$diff = 0;
// add the common values to the $common variable
$common = 0;
// cache the result of the same quantity
$commonCache = [];
for ($i = 0; $i < count($list1); $i++) {
    // Part 1
    if ($list1[$i] !== $list2[$i]) {
        $diff += abs($list1[$i] - $list2[$i]);
    }

    // Part 2
    if (isset($commonCache[$list1[$i]])) {
        $common += $commonCache[$list1[$i]];
    } else {
        $sameQuantity = 0;
        for ($j = 0; $j < count($list1); $j++) {
            if ($list1[$i] === $list2[$j]) {
                ++$sameQuantity;
            }

        }
        $common += $list1[$i] * $sameQuantity;
        $commonCache[$list1[$i]] = $list1[$i] * $sameQuantity;
    }

}
echo $diff . "\n";
echo $common . "\n";