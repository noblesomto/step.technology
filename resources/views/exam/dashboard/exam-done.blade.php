@include('exam.dashboard.layouts.header')
@include('exam.dashboard.layouts.nav', ['active' => 'dashboard'])

<div class="max-w-lg mx-auto text-center bg-white rounded-lg border border-gray-200 shadow-sm p-10 mt-6">
    <div class="w-16 h-16 rounded-full bg-step-primary/10 flex items-center justify-center mx-auto mb-4">
        <i class="fa fa-check text-step-primary text-2xl"></i>
    </div>
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Exam Completed!</h1>

    <p class="mt-4 text-gray-600">Thank you for completing the exam.</p>
    <p class="mt-2 text-gray-600">
        @if ($examScore && $examScore->status === 'approved')
            Your result has been reviewed. Your score: <strong>{{ $examScore->score }}/{{ $examScore->total_questions }}</strong>.
        @else
            Your results are being reviewed. Please check back later or look out for an email notification.
        @endif
    </p>

    <a href="/user/index" class="mt-6 inline-block bg-step-primary text-white font-step-heading font-semibold px-6 py-3 rounded-full hover:bg-step-accent transition-colors">
        Go to Dashboard
    </a>
</div>

@include('exam.dashboard.layouts.footer')
