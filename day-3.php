<?php

// load the input file
$input = file_get_contents('./inputs/input-3.txt');

// define the regex pattern
$pattern = '/mul\((\d+),(\d+)\)/';

// Part 1
preg_match_all($pattern, $input, $matches);
$total1 = 0;
foreach ($matches[1] as $key => $x) {
    $y = $matches[2][$key];
    $total1 += $x * $y;
}

echo $total1 . "\n";

// Part 2
// define the regex patterns
$mulPattern = '/mul\((\d+),(\d+)\)/';
$doPattern = '/do\(\)/';
$dontPattern = '/don\'t\(\)/';

// initialize variables
$total2 = 0;
$mulEnabled = true;

// split the input into tokens
$tokens = preg_split('/(do\(\)|don\'t\(\)|mul\(\d+,\d+\))/', $input, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

foreach ($tokens as $token) {
    // check for do() and don't() instructions
    if (preg_match($doPattern, $token)) {
        $mulEnabled = true;
    } elseif (preg_match($dontPattern, $token)) {
        $mulEnabled = false;
    }

    // process mul instructions if enabled
    if ($mulEnabled && preg_match($mulPattern, $token, $matches)) {
        $x = $matches[1];
        $y = $matches[2];
        $total2 += $x * $y;
    }
}

echo $total2 . "\n";