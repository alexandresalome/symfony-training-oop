<?php

$iterator = new ArrayIterator([1, 2, 3]);

while ($item = $iterator->current()) {
    var_dump($item);
    $iterator->next();
}
