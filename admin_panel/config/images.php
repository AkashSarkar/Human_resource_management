<?php

return [
    'general_size' => env('UPLOAD_GENERAL_SIZE', public_path('resources/images/product/general/')),
    'medium_size' => env('UPLOAD_MEDIUM_SIZE', public_path('resources/images/product/medium/')),
    'large_size' => env('UPLOAD_LARGE_SIZE', public_path('resources/images/product/large/')),
    'pagelarge_size' => env('UPLOAD_PAGELARGE_SIZE', public_path('resources/images/product/pagelarge/')),
    'thumbnail_size' => env('UPLOAD_THUMBNAIL_SIZE', public_path('resources/images/product/thumbnail/')),
];