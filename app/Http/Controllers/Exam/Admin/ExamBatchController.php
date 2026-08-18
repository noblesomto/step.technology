<?php

namespace App\Http\Controllers\Exam\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamBatch;
use Illuminate\Http\Request;

class ExamBatchController extends Controller
{
    public function index()
    {
        $title = "Exam Sittings - " . config('global.site_name');
        $batches = ExamBatch::withCount('scores')->orderBy('starts_at', 'desc')->paginate(20);

        return view('backend.exam.batches.index', compact('title', 'batches'));
    }

    public function create()
    {
        $title = "New Exam Sitting - " . config('global.site_name');
        return view('backend.exam.batches.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'is_active' => 'nullable|boolean',
        ]);

        $batch = ExamBatch::create($request->only(['name', 'description', 'starts_at', 'ends_at']));

        if ($request->boolean('is_active')) {
            $batch->activate();
        }

        return redirect('/admin/exam-batches')->with('status', ['text' => 'Exam sitting created', 'type' => 'success']);
    }

    public function edit(ExamBatch $examBatch)
    {
        $title = "Edit Exam Sitting - " . config('global.site_name');
        return view('backend.exam.batches.edit', ['title' => $title, 'batch' => $examBatch]);
    }

    public function update(Request $request, ExamBatch $examBatch)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'is_active' => 'nullable|boolean',
        ]);

        $examBatch->update($request->only(['name', 'description', 'starts_at', 'ends_at']));

        if ($request->boolean('is_active')) {
            $examBatch->activate();
        } elseif ($examBatch->is_active) {
            $examBatch->update(['is_active' => false]);
        }

        return redirect('/admin/exam-batches')->with('status', ['text' => 'Exam sitting updated', 'type' => 'success']);
    }

    public function activate(ExamBatch $examBatch)
    {
        $examBatch->activate();

        return redirect('/admin/exam-batches')->with('status', ['text' => $examBatch->name . ' is now the open sitting', 'type' => 'success']);
    }

    public function deactivate(ExamBatch $examBatch)
    {
        $examBatch->update(['is_active' => false]);

        return redirect('/admin/exam-batches')->with('status', ['text' => $examBatch->name . ' is now closed', 'type' => 'success']);
    }
}
