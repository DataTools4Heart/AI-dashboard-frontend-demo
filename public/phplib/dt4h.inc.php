<?php
function getSitesInfo() {
    return iterator_to_array($GLOBALS['sitesCol']->find());
}