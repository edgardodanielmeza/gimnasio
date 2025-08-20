<?php

use Laravel\Jetstream\Features;

return [
    'stack' => 'livewire',
    'middleware' => ['web'],
    'features' => [
        Features::teams(['invitations' => true]),
        Features::profilePhotos(),
        Features::api(),
        Features::accountDeletion(),
    ],
    'profile_photo_disk' => 'public',
];
