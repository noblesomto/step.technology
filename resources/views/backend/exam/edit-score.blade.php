@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'enrollments'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Edit Exam Result</h1>
    <nav class="text-sm text-gray-500 mt-1">
        <a href="/admin/index" class="hover:text-step-primary">Home</a>
        <span class="mx-1">/</span>
        <a href="/admin/enrollments" class="hover:text-step-primary">Exam Enrollments</a>
        <span class="mx-1">/</span>
        <span class="text-step-primary">Edit</span>
    </nav>
</div>

<div class="bg-white rounded-lg border border-gray-200 p-6 sm:p-8 max-w-xl">
    <div class="mb-6 pb-6 border-b border-gray-100">
        <p class="text-sm text-gray-500">Candidate</p>
        <p class="font-step-heading font-semibold text-lg text-gray-900">{{ $user->first_name ?? '—' }} {{ $user->last_name ?? '' }}</p>
        <p class="text-sm text-gray-500">{{ $user->email ?? '—' }}</p>
    </div>

    <form action="/admin/enrollments/{{ $score->id }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Score</label>
            @if ($errors->has('score')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('score') }}</span> @endif
            <input type="number" name="score" value="{{ old('score', $score->score) }}" min="0" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
            @if ($score->total_questions)
                <p class="text-xs text-gray-400 mt-1">Out of {{ $score->total_questions }} questions</p>
            @endif
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status</label>
            <select name="status" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
                <option value="pending" @selected(old('status', $score->status) === 'pending')>Pending</option>
                <option value="approved" @selected(old('status', $score->status) === 'approved')>Approved</option>
            </select>
            <p class="text-xs text-gray-400 mt-1">Switching to Approved emails the candidate automatically.</p>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Admin Notes</label>
            <textarea name="admin_notes" rows="3" class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3 py-2.5">{{ old('admin_notes', $score->admin_notes) }}</textarea>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Save Changes</button>
            <a href="/admin/enrollments" class="text-sm font-step-heading font-semibold text-gray-500 hover:text-step-primary">Cancel</a>
        </div>
    </form>
</div>

@include('backend.layouts.tailwind.footer')
