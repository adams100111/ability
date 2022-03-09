<?php

use Illuminate\Database\Eloquent\Model;

if (! function_exists('able_to')) {
    /**
     * Assign high numeric IDs to a config item to force appending.
     *
     * @param  $permissions
     * @return bool
     */
    function able_to($permissions): bool
    {
        return false;
    }
}


if (! function_exists('is_model')) {
    /**
     * Determine if an object or class is elquant model.
     *
     * @param  $object_or_class
     * @return bool
     */
    function is_model($object_or_class)
    {
        return is_subclass_of($object_or_class, Model::class);
    }
}
