@include('dashboard.layouts.tailwind.header')
@include('dashboard.layouts.tailwind.nav', ['active' => 'membership'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Membership Payment</h1>
</div>

<div class="bg-white rounded-lg border border-gray-200 p-6 sm:p-8">
    <h5 class="font-step-heading font-semibold text-lg text-step-primary mb-4">Make Payment and Upload Proof of Payment</h5>

    @if (session('status'))
        <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
            {{ session('status')['text'] }}
        </div>
    @endif

    <form action="/user/membership" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
            @if ($user->user_type == "Young Professional" || $user->user_type == "Corporate Professional")
                <h4 class="font-step-heading font-bold text-lg text-gray-900 mb-2">Amount: &#8358;10,000</h4>
            @elseif ($user->user_type == "Undergradute")
                <h4 class="font-step-heading font-bold text-lg text-gray-900 mb-2">Amount: &#8358;2,500</h4>
            @elseif ($user->user_type == "Corporate Organisation")
                <h4 class="font-step-heading font-bold text-lg text-gray-900 mb-2">Amount: &#8358;25,000</h4>
            @endif
            <p class="text-sm text-gray-600">Account Name: {{ config('global.payment_account_name') }}</p>
            <p class="text-sm text-gray-600">Account Number: {{ config('global.payment_account_number') }}</p>
            <p class="text-sm text-gray-600">Bank: {{ config('global.payment_bank_name') }}</p>
        </div>

        <hr class="border-gray-100 mb-6">

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Upload Payment Proof</label>
            @if ($errors->has('payment_picture'))
                <span class="block text-red-600 text-sm mb-1">{{ $errors->first('payment_picture') }}</span>
            @endif
            <input type="file" name="payment_picture" class="w-full text-sm text-gray-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-md file:border-0 file:bg-step-primary/10 file:text-step-primary file:font-semibold hover:file:bg-step-primary/20">
        </div>

        <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Upload Proof</button>
    </form>

    <hr class="border-gray-100 my-8">

    <div>
        <h5 class="font-step-heading font-semibold text-lg text-step-primary mb-4">Payment Proof</h5>
        @if (empty($proof->payment_amount))
            <p class="text-gray-500 text-sm">Nothing yet...</p>
        @else
            <img src="{{ asset('uploads/payment/'.$proof->payment_picture) }}" loading="lazy" class="max-w-xs rounded-md border border-gray-200">
        @endif
    </div>
</div>

@include('dashboard.layouts.tailwind.footer')
