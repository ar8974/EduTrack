<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UserImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'first_name'   => $row['first_name'] ?? null,
            'last_name'    => $row['last_name'] ?? null,
            'email'        => $row['email'] ?? null,
            'password_hash'=> Hash::make($row['password'] ?? 'password'),
            'role_id'      => $row['role_id'] ?? 3,
            'dept_id'      => $row['dept_id'] ?? null,
            'is_active'    => $row['is_active'] ?? 1,
            'created_at'   => now(),
        ]);
    }
}
