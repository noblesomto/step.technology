@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'users'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">New User</h1>
    <nav class="text-sm text-gray-500 mt-1">
        <a href="/admin/index" class="hover:text-step-primary">Home</a>
        <span class="mx-1">/</span>
        <a href="/admin/users" class="hover:text-step-primary">Users</a>
        <span class="mx-1">/</span>
        <span class="text-step-primary">New</span>
    </nav>
</div>

<div class="bg-white rounded-lg border border-gray-200 p-6 sm:p-8 max-w-3xl">
    <form action="/admin/users" method="POST" class="space-y-4">
        @csrf

        @include('backend.users._form', ['user' => null, 'passwordRequired' => true])

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Create User</button>
            <a href="/admin/users" class="text-sm font-step-heading font-semibold text-gray-500 hover:text-step-primary">Cancel</a>
        </div>
    </form>
</div>

@include('backend.layouts.tailwind.footer')
