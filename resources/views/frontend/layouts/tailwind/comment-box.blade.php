{{-- Decorative — matches current site behavior, form has no backend handler --}}
<div class="mt-12" x-data="{ rating: 0, hover: 0 }">
    <h3 class="font-step-heading font-semibold text-xl text-step-primary mb-1">Add Your Comments</h3>
    <span class="block w-16 h-1 bg-step-accent mb-6"></span>

    <div class="mb-6">
        <p class="text-sm font-step-heading font-semibold text-gray-700 mb-2">Your Rating</p>
        <div class="flex gap-1">
            @for ($i = 1; $i <= 5; $i++)
                <button type="button" @click="rating = {{ $i }}" @mouseenter="hover = {{ $i }}" @mouseleave="hover = 0">
                    <i class="fa fa-star" :class="(hover || rating) >= {{ $i }} ? 'text-step-accent' : 'text-gray-300'"></i>
                </button>
            @endfor
        </div>
    </div>

    <form action="#" method="post" class="space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <input type="text" name="fname" placeholder="First Name*" required class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-4 py-2.5">
            <input type="text" name="lname" placeholder="Last Name*" required class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-4 py-2.5">
        </div>
        <input type="email" name="email" placeholder="Email*" required class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-4 py-2.5">
        <textarea name="comment" rows="4" placeholder="Your Comments" class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-4 py-2.5"></textarea>
        <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold px-6 py-3 rounded-full hover:bg-step-accent transition-colors">Submit Now</button>
    </form>
</div>
