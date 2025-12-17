<?php

function extractRejectionReasons($data): array
{
    $rejectionReasons = [];
    // Check if the current data is an array
    if (is_array($data) || is_object($data)) {
        // Iterate over each item in the array or each property in the object
        foreach ($data as $key => $value) {
            // Check if the current key is 'rejectionReasons'
            if ($key === 'rejectionReasons') {
                // If so, add the value to the $rejectionReasons array
                $rejectionReasons = array_merge($rejectionReasons, $value);
            } else {
                // Recursively call the function for each item or property
                $rejectionReasons = array_merge($rejectionReasons, extractRejectionReasons($value));
            }
        }
    }
    return $rejectionReasons;
}