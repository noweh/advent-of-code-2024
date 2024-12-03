<?php

// load the input file
$input = file_get_contents('./inputs/input-2.txt');
$lines = explode("\n", $input);

// Part 1
$safe1 = 0;
foreach ($lines as $line) {
    $list = explode(' ', $line);

    $head = (int)$list[0];
    $order = null;
    for ($i = 1; $i < count($list); $i++) {
        $current = (int)$list[$i];
        if (!$order) {
            $order = $current > $head ? 'asc' : 'desc';
        } elseif ($order === 'asc' && $current < $head || $order === 'desc' && $current > $head) {
            continue 2;
        }

        if (abs($head - $current) < 1 || abs($head - $current) > 3) {
            continue 2;
        }

        $head = $current;
    }
    ++$safe1;
}

echo $safe1 . "\n";

// Part 2
$safe2 = 0;
foreach ($lines as $line) {
    $list = explode(' ', $line);

    $head = (int)$list[0];
    $order = null;
    $alreadyFirstError = false;
    for ($i = 1; $i < count($list); $i++) {
        $current = (int)$list[$i];
        if (!$order) {
            $order = $current > $head ? 'asc' : 'desc';
        } elseif ($order === 'asc' && $current < $head || $order === 'desc' && $current > $head) {
            if ($alreadyFirstError) {
                continue 2;
            }
            $alreadyFirstError = true;
        }

        if (abs($head - $current) < 1 || abs($head - $current) > 3) {
            if ($alreadyFirstError) {
                continue 2;
            }
            $alreadyFirstError = true;
        }

        $head = $current;
    }
    ++$safe2;
}

echo $safe2 . "\n";