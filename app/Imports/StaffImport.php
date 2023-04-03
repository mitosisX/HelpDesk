<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class StaffImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $role = Role::where('name', 'staff')
            ->first()
            ->id;

        return new User([
            'name' => $row[0],
            'email' => $row[1],
            'location' => $row[2],
            'role' => $role,
            'password' => bcrypt('12345'),
        ]);
    }
}
