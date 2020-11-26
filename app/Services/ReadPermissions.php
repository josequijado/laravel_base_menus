<?php

namespace App\Services;

class ReadPermissions {
    public function permissions()
    {
        $permissions = null;
        if (auth()->user()) {
            $permissions = auth()->user()->permissions;
            $permissions = $permissions->hierarchy();
        }

        return $permissions;
    }
}
