<?php

function getSteps($n) {
    $floor[1] = 1;
    $floor[2] = 2;

    if ($n == 1) {
        echo $floor[1].PHP_EOL;
    } elseif ($n == 2) {
        echo $floor[2].PHP_EOL;
    } else {
        for ($i = 3; $i <= $n; $i++) {
            $floor[$i] = $floor[$i - 1] + $floor[$i - 2];
        }

        echo $floor[$n].PHP_EOL;
    }
}

function getStepsRecursive($n) {
    if ($n == 1) {
        return (int) 1;
    } elseif ($n == 2) {
        return (int) 2;
    } else {
        return getStepsRecursive($n - 1) + getStepsRecursive($n - 2);
    }
}

getSteps(8);

echo getStepsRecursive(8);