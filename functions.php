<?php

/**
 * Helper function to dump object's properties and methods
 * @param type $object
 */
function dumpPropertiesAndMethods($object) {
    var_dump(get_object_vars($object), (get_class_methods($object)));
}
