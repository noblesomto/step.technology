@include('exam.dashboard.layouts.header-section')

<style>
    /* Modern Card Design */
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        height: 100%;
    }

    .stat-card:hover {
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
    }

    .stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 3.5rem;
        height: 3.5rem;
        border-radius: 12px;
        flex-shrink: 0;
    }

    /* Welcome Card Styling */
    .welcome-card {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 16px;
        padding: 2rem;
        border: 1px solid #e2e8f0;
    }

    /* List Styling */
    .industry-list {

        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 0.75rem;
        margin-top: 1.5rem;
    }

    .industry-item {
        display: flex;
        align-items: center;
        padding: 0.5rem 0;
        color: #4b5563;
    }

    .industry-item::before {
        content: "•";
        color: #3b82f6;
        font-weight: bold;
        display: inline-block;
        margin-right: 0.5rem;
    }

    /* Button Styling */
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(37, 99, 235, 0.3);
    }

    /* Header Styling */
    .page-header {
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.75rem;
    }

    .page-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border-radius: 2px;
    }

    /* Status Indicators */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-complete {
        background-color: #dcfce7;
        color: #166534;
    }

    .status-pending {
        background-color: #ffedd5;
        color: #9a3412;
    }

    /* Layout Improvements */
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    /* Value Styling */
    .stat-value {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1e293b;
        margin-top: 0.5rem;
    }

    /* Flash Message Styling */
    .alert-container {
        margin-bottom: 1.5rem;
    }
</style>

<main class="bg-gray-50 px-4 py-8 md:px-6 pb-20 flex-grow">
    <div class="container mx-auto p-4 max-w-6xl">
        <h1 class="page-header text-3xl md:text-4xl">Exam Dashboard</h1>

        <div class="alert-container">
            @include('exam.dashboard.layouts.flash-message')
        </div>

        @if($user->exam_taken === "yes")
            <div class="grid-container">
                <!-- Exam Status Card -->
                <div class="stat-card">
                    <div class="flex items-center">
                        <div class="stat-icon bg-blue-100 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold text-gray-700">Exam Status</h2>
                            <div class="stat-value">
                                <span class="status-badge status-complete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Completed
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">You have successfully taken the exam</p>
                        </div>
                    </div>
                </div>

                <!-- Exam Score Card -->
                <div class="stat-card">
                    <div class="flex items-center">
                        <div class="stat-icon bg-green-100 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold text-gray-700">Exam Score</h2>
                            <div class="stat-value">{{ $exam->score ?? '—' }}/40</div>
                            <p class="text-sm text-gray-500 mt-1">Your performance score</p>
                        </div>
                    </div>
                </div>

                <!-- Additional Stats Card (if needed) -->
                <div class="stat-card">
                    <div class="flex items-center">
                        <div class="stat-icon bg-purple-100 text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold text-gray-700">Completion Date</h2>
                            <div class="stat-value text-xl">
                               @if(isset($exam) && !is_null($exam) && $exam->updated_at)
                                    {{ $exam->updated_at->format('M d, Y') }}
                                @elseif($user->exam_completed_at)
                                    {{ $user->exam_completed_at->format('M d, Y') }}
                                @else
                                    —
                                @endif
                            </div>
                            <p class="text-sm text-gray-500 mt-1">When you completed the exam</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="welcome-card">
                <div class="text-center md:text-left">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Ready to Take the STEP Exam?</h2>
                    <p class="text-gray-600 max-w-3xl mx-auto md:mx-0">
                        The STEP exam evaluates your knowledge across multiple key industries. This comprehensive assessment helps identify your strengths and areas for development.
                    </p>

                    <div class="industry-list">
                        <div class="industry-item">Artificial Intelligence (AI)</div>
                        <div class="industry-item">Energy</div>
                        <div class="industry-item">Oil & Gas</div>
                        <div class="industry-item">Information Technology (IT)</div>
                        <div class="industry-item">Other Emerging Areas</div>
                    </div>

                    <div class="mt-8 text-center md:text-left">
                        <a href="{{ route('exam.start') }}" class="btn-primary inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Start Exam
                        </a>

                        <div class="mt-4 text-sm text-gray-500">
                            <p>Estimated time: 30 minutes</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</main>

@include('exam.dashboard.layouts.footer')
</div>
</div>
