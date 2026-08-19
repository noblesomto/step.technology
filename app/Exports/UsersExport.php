<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select("user_id", "first_name", "last_name", "gender", "phone", "email", "user_type", "profession", "member_status")->get();
    }

    public function headings(): array
    {
        return ["ID", "First Name", "Last Name", "Gender", "Phone", "Email", "User Type", "Profession", "Member Status"];
    }

    public function styles(Worksheet $sheet)
{
    return [
       // Style the first row as bold text.
       1    => ['font' => ['bold' => true]],
    ];
}

}
