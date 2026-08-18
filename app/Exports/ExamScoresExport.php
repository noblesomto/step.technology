<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExamScoresExport implements FromCollection, WithHeadings, WithStyles
{
    public function __construct(protected ?int $batchId = null)
    {
    }

    public function collection()
    {
        return DB::table('users')
            ->join('exam_scores', 'users.user_id', '=', 'exam_scores.user_id')
            ->leftJoin('exam_batches', 'exam_scores.exam_batch_id', '=', 'exam_batches.id')
            ->when($this->batchId, fn ($q) => $q->where('exam_scores.exam_batch_id', $this->batchId))
            ->select(
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.phone',
                'exam_batches.name as batch_name',
                'exam_scores.score',
                'exam_scores.total_questions',
                'exam_scores.status',
                'exam_scores.submitted_at'
            )
            ->orderBy('users.last_name')
            ->get();
    }

    public function headings(): array
    {
        return ['First Name', 'Last Name', 'Email', 'Phone', 'Exam Sitting', 'Score', 'Total Questions', 'Status', 'Submitted At'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
