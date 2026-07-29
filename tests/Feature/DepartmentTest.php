<?php
use App\Models\Department;

test('hr user can view departments index page', function () {
    // 1. Arrange: Buat user HR
    $hr = createHrUser();
    // 2. Act: Login sebagai HR lalu buka /departments
    $response = $this->actingAs($hr)->get(route('departments.index'));
    // 3. Assert: Pastikan halaman berhasil dibuka (Status 200 OK)
    $response->assertOk();
});
test('non hr user cannot view departments index page', function () {
    // 1. Arrange: Buat user Staff (Bukan HR)
    $staff = createStaffUser();
    // 2. Act: Login sebagai Staff lalu coba buka /departments
    $response = $this->actingAs($staff)->get(route('departments.index'));
    // 3. Assert: Pastikan akses ditolak (Status 403 Forbidden)
    $response->assertStatus(403);
});
test('hr user can create new department', function () {
    // 1. Arrange: Buat user HR
    $hr = createHrUser();
    $departmentData = [
        'name' => 'Marketing Department',
        'description' => 'Handles marketing and communications',
        'status' => 'active',
    ];
    // 2. Act: Login sebagai HR lalu POST data ke /departments
    $response = $this->actingAs($hr)->post(route('departments.store'), $departmentData);
    // 3. Assert: Pastikan redirect ke index dan data tersimpan di database
    $response->assertRedirect(route('departments.index'));
    $this->assertDatabaseHas('departments', [
        'name' => 'Marketing Department',
    ]);
});
