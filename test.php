<?php

class Math_Complex {
    // Свойства: действительная и мнимая части.
    public $re, $im;
    // Метод: добавить число к текущему значению. число задается
    // своей действительной и мнимой частью.
    function add(Math_Complex $y) {
        $this->re += $y->re;
        $this->im += $y->im;
    }
    // Преобразуем число в строку
    function __toString() {
        return "({$this->re}, {$this->im})";
    }
}
$a = new Math_Complex;
$a->re = 314;
$a->im = 101;

$b = new Math_Complex;
$b->re = 303;
$b->im = 6;

$a->add($b);

echo $a->__toString();
?>