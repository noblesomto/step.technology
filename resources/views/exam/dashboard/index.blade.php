@include('exam.dashboard.layouts.header')
@include('exam.dashboard.layouts.nav', ['active' => 'dashboard'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Exam Dashboard</h1>
    <nav class="text-sm text-gray-500 mt-1">
        <span class="text-step-primary">Dashboard</span>
    </nav>
</div>

@include('exam.dashboard.layouts.flash-message')

@if ($activeBatchExam)
    {{-- Already submitted this sitting --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h5 class="font-step-heading font-semibold text-sm text-gray-500 mb-3">Exam Status</h5>
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-full bg-step-primary/10 flex items-center justify-center">
                    <i class="fa fa-check-circle text-step-primary"></i>
                </div>
                @if ($activeBatchExam->status === 'approved')
                    <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Approved</span>
                @elseif ($activeBatchExam->status === 'rejected')
                    <span class="inline-block bg-red-50 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-full">Not Approved</span>
                @else
                    <span class="inline-block bg-yellow-50 text-yellow-700 text-xs font-semibold px-2.5 py-1 rounded-full">Awaiting Review</span>
                @endif
            </div>
            <p class="text-sm text-gray-500 mt-3">
                @if ($activeBatchExam->status === 'approved')
                    Your result has been reviewed and approved.
                @else
                    Submitted — an admin will review your result shortly.
                @endif
            </p>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h5 class="font-step-heading font-semibold text-sm text-gray-500 mb-3">Exam Score</h5>
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-full bg-step-primary/10 flex items-center justify-center">
                    <i class="fa fa-bar-chart text-step-primary"></i>
                </div>
                <h6 class="font-step-heading font-bold text-xl text-gray-900">
                    {{ $activeBatchExam->status === 'approved' ? $activeBatchExam->score.'/'.$activeBatchExam->total_questions : '—' }}
                </h6>
            </div>
            <p class="text-sm text-gray-500 mt-3">{{ $activeBatchExam->status === 'approved' ? 'Your performance score' : 'Visible once approved' }}</p>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h5 class="font-step-heading font-semibold text-sm text-gray-500 mb-3">Submitted</h5>
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-full bg-step-primary/10 flex items-center justify-center">
                    <i class="fa fa-calendar text-step-primary"></i>
                </div>
                <h6 class="font-step-heading font-bold text-xl text-gray-900">{{ $activeBatchExam->submitted_at?->format('j M Y') ?? $activeBatchExam->created_at->format('j M Y') }}</h6>
            </div>
            <p class="text-sm text-gray-500 mt-3">When you completed the exam</p>
        </div>
    </div>
@elseif ($activeBatch)
    {{-- Sitting open, not yet taken --}}
    <div class="bg-gradient-to-br from-step-primary/5 to-step-primary/10 border border-step-primary/20 rounded-lg p-6 sm:p-8">
        <h2 class="font-step-heading font-bold text-2xl text-gray-900 mb-2">Ready to Take the STEP Exam?</h2>
        <p class="text-gray-600 max-w-2xl">
            The STEP exam evaluates your knowledge across multiple key industries. This comprehensive assessment helps identify your strengths and areas for development.
        </p>

        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 mt-6 max-w-xl">
            @foreach (['Artificial Intelligence (AI)', 'Energy', 'Oil & Gas', 'Information Technology (IT)', 'Other Emerging Areas'] as $topic)
                <li class="flex items-center gap-2 text-gray-700 text-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-step-primary"></span> {{ $topic }}
                </li>
            @endforeach
        </ul>

        <a href="/user/start-exam" class="inline-flex items-center gap-2 mt-8 bg-step-primary text-white font-step-heading font-semibold px-6 py-3 rounded-full hover:bg-step-accent transition-colors">
            <i class="fa fa-pencil-square-o"></i> Start Exam
        </a>
        <p class="text-sm text-gray-500 mt-3">Estimated time: {{ \App\Http\Controllers\Exam\UserController::EXAM_DURATION_MINUTES }} minutes</p>
    </div>
@else
    {{-- No sitting open --}}
    <div class="bg-white border border-gray-200 rounded-lg p-6 sm:p-8 text-center">
        <div class="w-14 h-14 rounded-full bg-step-primary/10 flex items-center justify-center mx-auto mb-4">
            <i class="fa fa-clock-o text-step-primary text-2xl"></i>
        </div>
        <h2 class="font-step-heading font-bold text-xl text-gray-900 mb-2">No Exam Sitting Open</h2>
        <p class="text-gray-500 max-w-md mx-auto">There is no exam sitting open right now. Please check back later — you'll be notified when the next sitting is scheduled.</p>
    </div>
@endif

@if ($latestExam && (!$activeBatchExam || $latestExam->id !== $activeBatchExam->id))
    <div class="mt-6 bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="font-step-heading font-semibold text-gray-900 mb-4">Previous Result</h3>
        <div class="flex flex-wrap items-center gap-x-8 gap-y-2 text-sm">
            <div>
                <p class="text-gray-500">Status</p>
                @if ($latestExam->status === 'approved')
                    <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full mt-1">Approved</span>
                @elseif ($latestExam->status === 'rejected')
                    <span class="inline-block bg-red-50 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-full mt-1">Not Approved</span>
                @else
                    <span class="inline-block bg-yellow-50 text-yellow-700 text-xs font-semibold px-2.5 py-1 rounded-full mt-1">Pending</span>
                @endif
            </div>
            <div>
                <p class="text-gray-500">Score</p>
                <p class="font-medium text-gray-900">{{ $latestExam->status === 'approved' ? $latestExam->score.'/'.$latestExam->total_questions : '—' }}</p>
            </div>
            <div>
                <p class="text-gray-500">Date</p>
                <p class="font-medium text-gray-900">{{ $latestExam->created_at->format('j M Y') }}</p>
            </div>
        </div>
    </div>
@endif

@include('exam.dashboard.layouts.footer')
