<?php
//---------------------------------------------------------------
# a handy function for determining if the given url is an external link
# if it is determined to be external it will return ' target="_blank" '
# otherwise return an empty string.
function target($url){
  $local = str_replace(array('http://', 'https://'), '', home_url());
  $target = (strpos($url, $local) == false ? ' target="_blank" ' : '');
  return $target;
}
