<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\MemberController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager');
});

Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff');
});

Route::middleware(['auth', 'role:member'])->group(function () {
    Route::get('/member', [MemberController::class, 'index'])->name('member');
});
