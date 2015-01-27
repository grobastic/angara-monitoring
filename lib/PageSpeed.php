<?php
class PageSpeed {
    var $start;
    var $stop;
    var $speed;
  function __construct() {
      $this->start = microtime(true);
  }
  function __destruct() {
      $this->stop =  microtime(true);
      $this->speed = $this->stop - $this->start;
      echo "<br>Время выполнения скрипта: ". $this->speed;
  }
}