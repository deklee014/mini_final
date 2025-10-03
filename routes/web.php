
<?php

use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Manager\StaffManagementController;
use App\Http\Controllers\Manager\ReportController;
use App\Http\Controllers\Staff\MemberApprovalController;
use App\Http\Controllers\Member\ProfileController as MemberProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// หน้าแรก
Route::get('/', function () {
    return view('welcome');
});

// หน้ารอการอนุมัติ
Route::get('/pending-approval', function () {
    return view('pending-approval');
})->middleware('auth')->name('pending-approval');

// Dashboard หลังล็อกอิน
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    // เปลี่ยนเส้นทางตาม role
    if ($user->isAdmin()) {
        return redirect()->route('admin.users.index');
    } elseif ($user->isManager()) {
        return redirect()->route('manager.reports.index');
    } elseif ($user->isStaff()) {
        return redirect()->route('staff.approvals.index');
    } else {
        // Member ต้องได้รับการอนุมัติก่อน
        if (!$user->is_approved) {
            return redirect()->route('pending-approval');
        }
        return redirect()->route('member.profile.index');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (Breeze default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes - จัดการทุกอย่าง
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserManagementController::class);
});

// Manager Routes - จัดการ Staff และดูรายงาน
Route::middleware(['auth', 'approved', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    // จัดการ Staff
    Route::resource('staff', StaffManagementController::class);
    
    // รายงาน
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/members', [ReportController::class, 'members'])->name('reports.members');
    Route::get('reports/staff', [ReportController::class, 'staff'])->name('reports.staff');
});

// Staff Routes - อนุมัติและจัดการสมาชิก
Route::middleware(['auth', 'approved', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    // อนุมัติสมาชิก
    Route::get('approvals', [MemberApprovalController::class, 'index'])->name('approvals.index');
    Route::post('approvals/{user}/approve', [MemberApprovalController::class, 'approve'])->name('approvals.approve');
    Route::delete('approvals/{user}/reject', [MemberApprovalController::class, 'reject'])->name('approvals.reject');
    
    // จัดการสมาชิก
    Route::get('members', [MemberApprovalController::class, 'approved'])->name('members.index');
    Route::get('members/{user}/edit', [MemberApprovalController::class, 'edit'])->name('members.edit');
    Route::put('members/{user}', [MemberApprovalController::class, 'update'])->name('members.update');
});

// Member Routes - จัดการข้อมูลตัวเอง
Route::middleware(['auth', 'approved', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('profile', [MemberProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [MemberProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [MemberProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/password', [MemberProfileController::class, 'editPassword'])->name('profile.password');
    Route::put('profile/password', [MemberProfileController::class, 'updatePassword'])->name('profile.password.update');
});

require __DIR__.'/auth.php';