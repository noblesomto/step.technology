<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Image;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        $title = "My Journals" . config('global.site_title');
        $user_id = $request->session()->get('user_id');

        $journals = Journal::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.journals.index', compact('title', 'journals'));
    }

    public function create()
    {
        $title = "Submit Journal" . config('global.site_title');
        return view('dashboard.journals.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'excerpt' => 'required|string|max:500',
            'body' => 'required|string',
            'feature_image' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $user_id = $request->session()->get('user_id');

        Journal::create([
            'user_id' => $user_id,
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'excerpt' => $request->input('excerpt'),
            'body' => $request->input('body'),
            'feature_image' => $this->storeFeatureImage($request),
            'status' => 'pending',
        ]);

        return redirect('/user/journals')->with('status', [
            'text' => 'Your journal has been submitted and is awaiting admin approval',
            'type' => 'success',
        ]);
    }

    public function edit(Request $request, $id)
    {
        $journal = Journal::where('id', $id)
            ->where('user_id', $request->session()->get('user_id'))
            ->firstOrFail();

        if ($journal->status === 'approved') {
            return redirect('/user/journals')->with('status', [
                'text' => 'An approved journal can no longer be edited',
                'type' => 'danger',
            ]);
        }

        $title = "Edit Journal" . config('global.site_title');
        return view('dashboard.journals.edit', compact('title', 'journal'));
    }

    public function update(Request $request, $id)
    {
        $journal = Journal::where('id', $id)
            ->where('user_id', $request->session()->get('user_id'))
            ->firstOrFail();

        if ($journal->status === 'approved') {
            return redirect('/user/journals')->with('status', [
                'text' => 'An approved journal can no longer be edited',
                'type' => 'danger',
            ]);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'excerpt' => 'required|string|max:500',
            'body' => 'required|string',
            'feature_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $data = [
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'excerpt' => $request->input('excerpt'),
            'body' => $request->input('body'),
            // Re-submitting an edit sends it back to the review queue.
            'status' => 'pending',
            'admin_notes' => null,
        ];

        if ($request->hasFile('feature_image')) {
            $data['feature_image'] = $this->storeFeatureImage($request);
        }

        $journal->update($data);

        return redirect('/user/journals')->with('status', [
            'text' => 'Journal updated and resubmitted for approval',
            'type' => 'success',
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $journal = Journal::where('id', $id)
            ->where('user_id', $request->session()->get('user_id'))
            ->firstOrFail();

        $journal->delete();

        return redirect('/user/journals')->with('status', ['text' => 'Journal deleted', 'type' => 'success']);
    }

    protected function storeFeatureImage(Request $request): string
    {
        $image = $request->file('feature_image');
        $imageName = time().'_'.uniqid().'.'.$image->extension();

        $thumbPath = public_path('/uploads/thumbnails');
        Image::make($image->path())
            ->resize(800, 500, function ($const) {
                $const->aspectRatio();
            })
            ->save($thumbPath.'/'.$imageName);

        $image->move(public_path('/uploads/journals'), $imageName);

        return $imageName;
    }
}
