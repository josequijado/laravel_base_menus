<?php
    if (env('USER_MUST_BE_VERIFIED') === true) {
        return [
            'middlesMaster' => ['web', 'auth', 'scope', 'verified',],
            'middlesAdmin' => ['web', 'auth', 'scope', 'verified',],
            'middlesUser' => ['web', 'auth', 'verified',],
        ];
    } else {
        return [
            'middlesMaster' => ['web', 'auth', 'scope',],
            'middlesAdmin' => ['web', 'auth', 'scope',],
            'middlesUser' => ['web', 'auth',],
        ];
    }
