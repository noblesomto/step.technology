@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => 'Verify Membership'])

<section class="py-16">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="font-step-heading font-bold text-2xl sm:text-3xl text-step-primary">Search the STEP Register</h2>
            <p class="text-gray-600 mt-3">Confirm a member's registration by name or Reg/License No (e.g. STEP/CORETEP/0001).</p>
        </div>

        <form method="GET" action="/verify-membership" class="flex flex-col sm:flex-row gap-3 max-w-2xl mx-auto">
            <div class="relative flex-1">
                <input type="text" name="q" value="{{ $search }}" placeholder="Enter name or Reg/License No" class="w-full h-12 rounded-full border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm pl-11 pr-4">
                <i class="fa fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
            <button type="submit" class="h-12 bg-step-primary text-white font-step-heading font-semibold px-8 rounded-full hover:bg-step-accent transition-colors">Search</button>
        </form>

        <div class="mt-12">
            @if ($search === '')
                <p class="text-center text-gray-400">Enter a name or Reg/License No above to check a member's registration status.</p>
            @elseif ($results->isEmpty())
                <div class="text-center bg-red-50 border border-red-100 rounded-lg py-8 px-6">
                    <i class="fa fa-times-circle text-red-500 text-2xl mb-2"></i>
                    <p class="text-red-700 font-medium">No registered member found matching "{{ $search }}".</p>
                </div>
            @else
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                                <tr>
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">Reg/License No</th>
                                    <th class="px-4 py-3">Type</th>
                                    <th class="px-4 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($results as $row)
                                    @php($fullName = trim($row->title.' '.$row->first_name.' '.$row->last_name))
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3">
                                            <div class="font-medium text-gray-900">{{ $fullName ?: $row->company_name }}</div>
                                            @if ($fullName && $row->company_name)
                                                <div class="text-xs text-gray-500">{{ $row->company_name }}</div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-step-primary font-semibold">{{ $row->reg_no }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $row->user_type }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center gap-1 bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full"><i class="fa fa-check-circle"></i> Verified Member</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

@include('frontend.layouts.tailwind.cta-banner')
@include('frontend.layouts.tailwind.footer')
