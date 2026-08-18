<div class="bg-white p-3 sticky top-20">
  <div class="text-xl font-semibold mt-1 mb-2 p-2">
    {{ $list->list_title }}
  </div>
<div class="bg-gray-100 p-2 ">
                    <div class="flex justify-between  ">
                    <div class="flex flex-col ">
                        <div class="flex items-center">
                        <span class="mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                        </span>
                        <span class="text-sm">Checkin</span>
                    </div>
                    <span class="font-semibold"> {{ date('j F Y', strtotime($list->checkin)); }}</span>
                    </div>

                    <div class="flex flex-col ">
                        <div class="flex items-center">
                        <span class="mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                        </span>
                        <span class="text-sm">Checkout</span>
                    </div>
                    <span class="font-semibold"> {{ date('j F Y', strtotime($list->checkout)); }}</span>
                    </div>
                </div>

                <div class="flex flex-col mt-4 ">
                        <div class="flex items-center">
                        <span class="mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        </span>
                        <span class="text-sm">Guests</span>
                    </div>
                    <span class="font-semibold">{{ $list->guests }}</span>
                    </div>
                </div>

                


                <!-- Booking  Breakdown -->
                  
                  <div class="flex justify-between my-3 mt-8">
                    <span >{{ $list->days }} nights (with {{ $list->weekends }} weekend)</span>
                    <div class="flex">
                      <span>£</span>
                      <span >{{ $list->main_price }}</span>
                      <span>.00</span>
                    </div>
                  </div>
                  <div class="flex justify-between my-3">
                    <span id="message">{{ $list->moreguests }} Additional guest </span>
                    <div class="flex">
                      <span>£</span>
                      <span id="guestprice">{{ $list->price_guest }}</span>
                      <span>.00</span>
                    </div>
                  </div>
                  <div class="flex justify-between my-3">
                    <span>Cleaning fee  </span>
                    <span>£{{ $list->cleaning_fee }}.00</span>
                  </div>
                  <div class="flex justify-between my-3">
                    <span>Add on Cost  </span>
                    <span>£{{ $list->service_fee }}.00</span>
                  </div>
                  <div class="flex justify-between my-3">
                    <span>Linen ({{ $list->bedrooms }} Bedrooms)  </span>
                    <span>£{{ getSetting('linen_cost') * $list->bedrooms }}.00</span>
                  </div>
                  
                  <div class="flex justify-between my-3">
                    <span>Taxes ({{ getSetting('tax') }}%)  </span>
                    <div class="flex">
                      <span>£</span>
                      <span id="tax">{{ $list->tax }}</span>
                      <span>.00</span>
                    </div>
                  </div>

                  <!-- Total Price -->
                <div class="mt-8 ">
                  <div class="flex justify-between font-semibold">
                    <span><h4>Total</h4></span>
                    <div class="flex font-bold">
                      <span>£</span>
                      <span id="totalprice">{{ $list->amount }}</span>
                      <span>.00</span>
                    </div>
                  </div>
   
                </div>
        </div>
