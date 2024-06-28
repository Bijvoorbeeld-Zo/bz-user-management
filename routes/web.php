<?php

use Illuminate\Support\Facades\Route;

Route::middleware('signed')
    ->middleware('web')
    ->get('invitation/{invitation}/accept', \JornBoerema\BzUserManagement\Livewire\AcceptInvitation::class)
    ->name('invitation.accept');
