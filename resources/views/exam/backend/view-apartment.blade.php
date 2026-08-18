@include('exam.landlord.layouts.header')
<style>

  @media (min-width: 640px) {
    table {
      display: inline-table !important;
    }

    thead tr:not(:first-child) {
      display: none;
    }
  }

  td:not(:last-child) {
    border-bottom: 0;
  }

  th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, .1);
  }
</style>
<div class="min-h-screen flex">
    <!-- Sidebar -->
    @include('exam.landlord.layouts.nav')

    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-20 hidden md:hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <header class="p-4 bg-white shadow flex">
            <button id="menu-button" class="md:hidden bg-text_red text-white p-2 rounded mr-5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
				  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
				</svg>
            </button>
            <div class="flex-grow lg:flex-grow-0  text-center ">
                <a href="/" class="text-xl flex items-center justify-center font-semibold text-gray-800">
                    <img class="w-48 md:w-64" src="{{ asset('frontend/images/logo.png') }}">
                </a>
            </div>
        </header>

        <main class="bg-grey-100 p-2">
            <div class="container mx-auto p-1">
		        <h1 class="text-2xl font-bold mb-5">Apartment Details</h1>
		        @include('exam.frontend.components.flash-message')
		        <!-- Cards Container -->
		            <div class="grid grid-cols-1 md:grid-cols-10 gap-6">
		            	<div class="col-span-10 md:col-span-3 ">
		            		<div class="p-6 bg-white h-full">
		            			<div>
			            			<img class="w-full h-full object-cover" src="{{ asset('uploads/featured-images/'.$list->featured_image) }}">
			            		</div>
			            		<div class="text-lg mt-4">
			            			<h4 class="font-semibold">{{ $list->list_title }}</h4>
			            			<p class="text-sm text-gray-500"><span class="font-semibold">Address:</span> {{ $list->location }}</p>
			            		</div>
			            		<div class="mt-10">
			            			<h4 class="font-semibold">Avaialability</h4>
			            		</div>
			            		<!-- Calander -->
				                <div class="text-sm md:text-base mb-20">

				                    <div class="max-w-5xl mx-auto mt-2 bg-gray-50 px-2 py-6">
				                      <!-- Month Navigation -->
				                      <div class="flex justify-between items-center mb-4">
				                        <button id="prevMonth" class=" btn2 btn-red rounded-md p-2">
				                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
				                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
				                            </svg>
				                        </button>
				                        <h2 id="currentMonth" class="text-lg font-bold"></h2>
				                        <button id="nextMonth" class=" btn2 btn-red rounded-md p-2">
				                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
				                              <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
				                            </svg>
				                        </button>
				                      </div>

				                      <!-- Weekdays Header -->
				                      <div class="grid grid-cols-7 text-center font-bold mb-2">
				                        <div>Sun</div>
				                        <div>Mon</div>
				                        <div>Tue</div>
				                        <div>Wed</div>
				                        <div>Thu</div>
				                        <div>Fri</div>
				                        <div>Sat</div>
				                      </div>

				                      <!-- Calendar Days -->
				                      <div id="calendarDays" class="grid grid-cols-7 gap-2"></div>
				                    </div>
				                    <div class="flex  mt-2 space-x-3">
				                        <div class="flex items-center">
				                            <span class="w-4 h-4 rounded bg-text_red mr-1"></span>
				                            <span>Booked</span>
				                        </div>
				                        <div class="flex items-center">
				                            <span class="w-4 h-4 rounded bg-green-200 mr-1"></span>
				                            <span>Pending</span>
				                        </div>
				                    </div>
				                </div>
				                <div class="mt-10">
				                	<div class="border-b-2 border-gray-300 pb-2 mb-4">
				                		<h4 class="font-semibold">Book/Block Days</h4>
				                	</div>
				                	<form action="/landlord/book/{{ $list->list_id }}" method="POST">
				                	@csrf
				                		<div class="mb-1 mt-1">
								            <label class="text-sm font-semibold">Select Date *</label>
								            @if ($errors->has('checkin'))
								                <span class="text-red-700 py-1">{{ $errors->first('checkin') }}</span>
								            @endif
								            <input type="text" id="datepicker" name="date" placeholder="" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
								        </div>
								        <input type="hidden" id="checkin" name="checkin">
		                                <input type="hidden" id="checkout" name="checkout">
		                                <input type="hidden" id="nights" name="nights">

								        <div class="mb-1 mt-3">
								            <label class="text-sm font-semibold">Total Nights</label>
                                			<p class="mt-2"> <span id="nights-display">0</span> Night(s)</p>
								        </div>
								        <div class="mb-1 mt-3">
								            <button type="submit" class="btn2 btn-yellow w-full py-1 text-xl flex justify-center items-center">
								                <span>Book</span>
								                <span class="ml-2">
								                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
								                      <path fill-rule="evenodd" d="M16.72 7.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H3a.75.75 0 0 1 0-1.5h16.19l-2.47-2.47a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
								                    </svg>
								                </span>
								            </button>
								        </div>
				                	</form>
				                </div>
		            		</div>
		            	</div>
		            	<div class="col-span-10 md:col-span-7">
		            		<div class="p-6 bg-white">

		            			<!-- Revenue Card Section -->
			            		<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
				                <!-- Booked Apartments Card -->
				                <div class="bg-white shadow-lg rounded-lg p-6">
				                    <div class="flex items-center">
				                        <!-- Icon -->
				                        <div class="bg-blue-500 text-white p-3 rounded-full">
				                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
				            			  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
				            			</svg>
				                        </div>
				                        <!-- Content -->
				                        <div class="ml-4">
				                            <h2 class="text-base font-semibold text-gray-700">Revenue For Month</h2>
				                            <p class="text-xl font-bold text-gray-900">${{ number_format($tot_revenue, 2) }}</p>
				                        </div>
				                    </div>
				                </div>

				                <!-- Earnings Card -->
				                <div class="bg-white shadow-lg rounded-lg p-6">
				                    <div class="flex items-center">
				                        <!-- Icon -->
				                        <div class="bg-red-500 text-white p-3 rounded-full">
				                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
				            			  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
				            			</svg>
				                        </div>
				                        <!-- Content -->
				                        <div class="ml-4">
				                            <h2 class="text-base font-semibold text-gray-700">Expenses for Month</h2>
				                            <p class="text-xl font-bold text-gray-900">${{ number_format($tot_expense, 2) }}</p>
				                        </div>
				                    </div>
				                </div>

				                <!-- Earnings Card -->
				                <div class="bg-white shadow-lg rounded-lg p-6">
				                    <div class="flex items-center">
				                        <!-- Icon -->
				                        <div class="bg-green-500 text-white p-3 rounded-full">
				                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
				            			  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
				            			</svg>
				                        </div>
				                        <!-- Content -->
				                        <div class="ml-4">
				                            <h2 class="text-base font-semibold text-gray-700">Profit for Month</h2>
				                            <p class="text-xl font-bold text-gray-900">${{ number_format($profit, 2) }}</p>
				                        </div>
				                    </div>
				                </div>

				            </div>
				        </div>

				        	<div class="p-6 bg-white mt-10">
				            <!--Revenue Table -->
				            <div class=" mb-2">
				            	<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
				            		<div>
				            			<h2 class="text-base font-semibold">Revenue Table</h2>
				            		</div>
				            		<div class="flex items-center text-sm">
				            			<span class="mr-2 font-semibold">Filter Month</span>
				            			<select id="revenue-month" class="p-2 rounded-lg">
			                                <option value="">Select Month</option>
			                                @for ($i = 1; $i <= 12; $i++)
			                                    <option value="{{ $i }}">{{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>
			                                @endfor
			                            </select>
				            		</div>
				            		<div class="flex items-center text-sm">
				            			<span class="mr-2 font-semibold">Filter Year</span>
				            			<select id="revenue-year" class="p-2 rounded-lg">
			                                <option value="">Select Year</option>
			                                @for ($i = now()->year; $i >= 2022; $i--)
			                                    <option value="{{ $i }}">{{ $i }}</option>
			                                @endfor
			                            </select>
				            		</div>
				            	</div>
				            </div>
							<section class="mx-auto">
								<div class="overflow-x-auto">
							    <table class="min-w-full bg-white border border-gray-200">
							        <thead class="bg-green-600 text-white">
							            <tr>
							            	<th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Source</th>
							                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Checkin</th>
							                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Checkout</th>
							                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Days</th>
							                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Amount</th>
							            </tr>
							        </thead>
							        <tbody id="revenue-table-body">
							        	 @foreach ( $revenue as $row )
							            <tr class="">
							            	<td class="py-4 px-4 border-t border-gray-200 text-sm">{{ $row->source }}</td>
							                <td class="py-4 px-4 border-t border-gray-200 text-sm">{{ date('j F Y', strtotime($row->checkin)); }}</td>
							                <td class="py-4 px-4 border-t border-gray-200 text-sm">{{ date('j F Y', strtotime($row->checkout)); }}</td>
							                <td class="py-4 px-4 border-t border-gray-200 text-sm">{{ $row->days }}</td>
							                <td class="py-4 px-4 border-t border-gray-200 text-sm text-green-500 font-semibold">${{ number_format($row->amount, 2, '.', ',') }}</td>
							            </tr>
							            @endforeach
							        </tbody>
							    </table>
							</div>

							</section>
							<div class="mt-4">
								{!! $revenue->links() !!}
							</div>
						</div>

						<div class="p-6 bg-white mt-10">

				            <!--Expense Table -->
				            <div class="mb-2">
				            	<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
				            		<div>
				            			<h2 class="text-base font-semibold">Expense Table</h2>
				            		</div>
				            		<div class="flex items-center text-sm">
				            			<span class="mr-2 font-semibold">Filter Month</span>
				            			<select id="expense-month" class="p-2 rounded-lg">
			                                <option value="">Select Month</option>
			                                @for ($i = 1; $i <= 12; $i++)
			                                    <option value="{{ $i }}">{{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>
			                                @endfor
			                            </select>
				            		</div>
				            		<div class="flex items-center text-sm">
				            			<span class="mr-2 font-semibold">Filter Year</span>
				            			<select id="expense-year" class="p-2 rounded-lg">
			                                <option value="">Select Year</option>
			                                @for ($i = now()->year; $i >= 2022; $i--)
			                                    <option value="{{ $i }}">{{ $i }}</option>
			                                @endfor
			                            </select>
				            		</div>
				            	</div>
				            </div>
							<section class="mx-auto">
								<div class="overflow-x-auto">
							    <table class="min-w-full bg-white border border-gray-200">
							        <thead class="bg-red-600 text-white">
							            <tr>
							                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Expense</th>
							                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Cost</th>
							                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Date</th>
							                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">View</th>
							           
							            </tr>
							        </thead>
							        <tbody id="expense-table-body">
							        	 @foreach ( $expense as $row )
							            <tr class="">
							                <td class="py-4 px-4 border-t border-gray-200 text-sm">{{ $row->expense }}</td>
							                <td class="py-4 px-4 border-t border-gray-200 text-sm text-red-500 font-semibold">${{ number_format($row->cost, 2, '.', ',') }}</td>
							                <td class="py-4 px-4 border-t border-gray-200 text-sm">{{ date('j F Y', strtotime($row->date_expense)); }}</td>
							                <td class="py-4 px-4 border-t border-gray-200 text-sm"><a href="{{  asset('uploads/invoice/'.$row->invoice_file) }}" target="_blank">View Invoice</a></td>
							         
							            </tr>
							            @endforeach
							        </tbody>
							    </table>
							</div>

							</section>
							<div class="mt-4">
								{!! $expense->links() !!}
							</div>

				        </div>

				        <!--Upload Expense-->
				        <div class="p-6 bg-white mt-10">
				        	<div class="w-full pb-2 mb-4 border-b-2 border-gray-300">
				        		<h4>Upload Expense Made for Apartment</h4>
				        	</div>
				        	@if($myexpense->isEmpty())
				        		
				        	@else
				        		<section class="mx-auto mb-6">
								<div class="overflow-x-auto">
							    <table class="min-w-full bg-white border border-gray-200">
							        <thead class="bg-blue-600 text-white">
							            <tr>
							                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Expense</th>
							                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Cost</th>
							            
							                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">View</th>
							                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
							           
							            </tr>
							        </thead>
							        <tbody id="expense-table-body">
							        	 @foreach ( $myexpense as $row )
							            <tr class="">
							                <td class="py-4 px-4 border-t border-gray-200 text-sm">{{ $row->expense }}</td>
							                <td class="py-4 px-4 border-t border-gray-200 text-sm text-red-500 font-semibold">${{ number_format($row->cost, 2, '.', ',') }}</td>
							                
							                <td class="py-4 px-4 border-t border-gray-200 text-sm"><a href="{{  asset('uploads/invoice/'.$row->invoice_file) }}" target="_blank">View Invoice</a></td>
							         		<td class="py-4 px-4 border-t border-gray-200 text-sm">{{ $row->status }}</td>
							            </tr>
							            @endforeach
							        </tbody>
							    </table>
							</div>
							</section>
				        	@endif

				        	
				        	<form action="/landlord/upload-expense/{{ $list->list_id }}" method="POST" role="form" class="" enctype="multipart/form-data">
				        		@csrf
				        		<div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-6">
				        			<div class="mb-1 mt-1">
							            <label class="text-sm font-semibold">Expense Made *</label>
							            @if ($errors->has('expense'))
							                <span class="text-red-700 py-1">{{ $errors->first('expense') }}</span>
							            @endif
							            <input type="text" name="expense" placeholder="" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
							        </div>
							        <div class="mb-1 mt-1">
							            <label class="text-sm font-semibold">Cost Spent *</label>
							            @if ($errors->has('cost'))
							                <span class="text-red-700 py-1">{{ $errors->first('cost') }}</span>
							            @endif
							            <input type="text" name="cost" maxlength="11" pattern="[0-9]*" placeholder="" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
							        </div>
							        <div class="mb-1 mt-1">
							            <label class="text-sm font-semibold">Upload Invoice *</label>
							            @if ($errors->has('invoice_file'))
							                <span class="text-red-700 py-1">{{ $errors->first('invoice_file') }}</span>
							            @endif
							            <input type="file" name="invoice_file" accept=".pdf" placeholder="" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
							        </div>
							        <div class="mb-4 mt-1">
							            <button type="submit" class="btn2 btn-red w-full py-1 text-xl flex justify-center items-center">
							                <span>Submit</span>
							                <span class="ml-2">
							                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
							                      <path fill-rule="evenodd" d="M16.72 7.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H3a.75.75 0 0 1 0-1.5h16.19l-2.47-2.47a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
							                    </svg>
							                </span>
							            </button>
							        </div>
				        		</div>
				        	</form>
				        </div>
		            	</div>
		        </div>
		    </div>
        </main>

        @include('exam.landlord.layouts.footer-apartment')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const expenseMonthFilter = document.getElementById('expense-month');
        const expenseYearFilter = document.getElementById('expense-year');
        const expenseTableBody = document.getElementById('expense-table-body');

        expenseMonthFilter.addEventListener('change', filterExpenses);
        expenseYearFilter.addEventListener('change', filterExpenses);

        function filterExpenses() {
            const month = expenseMonthFilter.value;
            const year = expenseYearFilter.value;

            fetch(`/expenses?month=${month}&year=${year}&list_id={{ $list->list_id }}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                expenseTableBody.innerHTML = '';
                data.expenses.forEach(expense => {
                    const row = `<tr>
                        <td class="py-4 px-4 border-t border-gray-200 text-sm">${expense.expense}</td>
                        <td class="py-4 px-4 border-t border-gray-200 text-sm text-red-500 font-semibold">$${expense.cost}</td>
                        <td class="py-4 px-4 border-t border-gray-200 text-sm">${moment(expense.date_expense).format('Do MMMM YYYY')}</td>
                        <td class="py-4 px-4 border-t border-gray-200 text-sm"><a href="/uploads/invoice/${expense.invoice_file}" target="_blank">View </a></td>
                    
                    </tr>`;
                    expenseTableBody.innerHTML += row;
                });
            });
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const revenueMonthFilter = document.getElementById('revenue-month');
        const revenueYearFilter = document.getElementById('revenue-year');
        const revenueTableBody = document.getElementById('revenue-table-body');

        revenueMonthFilter.addEventListener('change', filterRevenue);
        revenueYearFilter.addEventListener('change', filterRevenue);

        function filterRevenue() {
            const month = revenueMonthFilter.value;
            const year = revenueYearFilter.value;

            fetch(`/revenue?month=${month}&year=${year}&list_id={{ $list->list_id }}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                revenueTableBody.innerHTML = '';
                data.revenues.forEach(revenue => {
                    const row = `<tr>
                    	<td class="py-4 px-4 border-t border-gray-200 text-sm">${revenue.source}</td>
                        <td class="py-4 px-4 border-t border-gray-200 text-sm">${moment(revenue.checkin).format('Do MMMM YYYY')}</td>
                        <td class="py-4 px-4 border-t border-gray-200 text-sm">${moment(revenue.checkou).format('Do MMMM YYYY')}</td>
                        <td class="py-4 px-4 border-t border-gray-200 text-sm">${revenue.days}</td>
                        <td class="py-4 px-4 border-t border-gray-200 text-sm text-green-500 font-semibold">$${revenue.amount}</td>
                    </tr>`;
                    revenueTableBody.innerHTML += row;
                });
            });
        }
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const bookedDates = @json($bookedDates);
    const icalDates = @json($bookedWebsite);
    const allDates = [...bookedDates, ...icalDates];

        // Format the dates into Litepicker's date format
        const formattedRanges = allDates.map(range => {
            return {
                start: new Date(range.checkin),
                end: new Date(range.checkout)
            };
        });

    const picker = new Litepicker({
        element: document.getElementById('datepicker'),
        singleMode: false,
        numberOfMonths: 2, // Display two months side by side
        numberOfColumns: 2,
        mobileFriendly: true, // Ensures responsiveness on mobile
        format: 'YYYY-MM-DD',
        minDate: new Date(),
        disallowLockDaysInRange: true,
        lockDays: formattedRanges.flatMap(range => {
            const lockedDays = [];
            let current = new Date(range.start);

            while (current <= range.end) {
                lockedDays.push(new Date(current));
                current.setDate(current.getDate() + 1);
            }
            
            return lockedDays;
        }),
        setup: (picker) => {
            picker.on('selected', (date1, date2) => {
                if (date1 && date2) {
                    let nights = (date2.getTime() - date1.getTime()) / (1000 * 60 * 60 * 24);

                    // Populate hidden form fields
                    document.getElementById('checkin').value = picker.getStartDate().format('YYYY-MM-DD');
                    document.getElementById('checkout').value = picker.getEndDate().format('YYYY-MM-DD');
                    document.getElementById('nights').value = nights;
                    document.getElementById('nights-display').textContent = nights;
                }
            });
        }
    });
});
</script>


