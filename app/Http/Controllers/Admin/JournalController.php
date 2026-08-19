<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        $title = "Journal Submissions -" . config('global.site_name');

        $status = $request->input('status', 'pending');
        $search = $request->input('search');

        $journals = Journal::with('author')
            ->when($status, fn ($q) => $q->where('status', $status))
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->where('title', 'LIKE', '%'.$search.'%')
                       ->orWhereHas('author', function ($q3) use ($search) {
                           $q3->where('first_name', 'LIKE', '%'.$search.'%')
                              ->orWhere('last_name', 'LIKE', '%'.$search.'%');
                       });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        $counts = [
            'pending' => Journal::pending()->count(),
            'approved' => Journal::approved()->count(),
            'rejected' => Journal::rejected()->count(),
        ];

        return view('backend.journals.index', compact('title', 'journals', 'status', 'search', 'counts'));
    }

    public function show($id)
    {
        $journal = Journal::with('author')->findOrFail($id);
        $title = "Review Journal -" . config('global.site_name');

        return view('backend.journals.show', compact('title', 'journal'));
    }

    public function updateStatus(Request $request, $id, $status)
    {
        abort_unless(in_array($status, ['pending', 'approved', 'rejected']), 404);

        $journal = Journal::findOrFail($id);
        $journal->update([
            'status' => $status,
            'admin_notes' => $request->input('admin_notes', $journal->admin_notes),
            'published_at' => $status === 'approved' ? ($journal->published_at ?? now()) : $journal->published_at,
        ]);

        return redirect()->back()->with('status', [
            'text' => 'Journal marked as '.$status,
            'type' => 'success',
        ]);
    }

    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'journal_ids' => 'required|array',
            'journal_ids.*' => 'integer|exists:journals,id',
            'bulk_status' => 'required|in:approved,pending,rejected',
        ]);

        $journals = Journal::whereIn('id', $request->input('journal_ids'))->get();

        foreach ($journals as $journal) {
            $journal->update([
                'status' => $request->input('bulk_status'),
                'published_at' => $request->input('bulk_status') === 'approved' ? ($journal->published_at ?? now()) : $journal->published_at,
            ]);
        }

        return redirect()->back()->with('status', [
            'text' => count($journals).' journal(s) updated',
            'type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);
        $journal->delete();

        return redirect('/admin/journals')->with('status', ['text' => 'Journal deleted', 'type' => 'success']);
    }
}
