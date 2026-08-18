@include('exam.backend.layouts.head-section')


<main class="bg-grey-100 px-6 pb-20 flex-grow">
    <div class="container mx-auto p-1">
        <h1 class="text-3xl font-bold my-3">New Question</h1>
        @include('exam.backend.layouts.flash-message')

        <!-- Cards Container -->
        <div class="">
            
        	<div class="max-w-5xl mx-auto bg-white p-3 md:p-10 mt-4 md:mt-10 mb-20 rounded-lg">
		        <form method="POST" action="/admin/new-question" enctype="multipart/form-data">
		            @csrf

                <div class="grid grid-cols-1 gap-4 border border-green-500 p-4">
    		        <div class="">
    		            <label class="text-sm font-semibold">Question*</label>
    		            @if ($errors->has('question'))
    		                <span class="text-red-700 py-1">{{ $errors->first('question') }}</span>
    		            @endif
    		            <input type="text"  name="question" placeholder="Question" value="" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
    		        </div>


    		 
                </div>

                <div class="flex flex-col space-y-4 border border-green-500 p-4 mt-4">
    		        <div class="">
    		            <label class="text-sm font-semibold">Answer One *</label>
    		            @if ($errors->has('answer1'))
    		                <span class="text-red-700 py-1">{{ $errors->first('answer1') }}</span>
    		            @endif
    		            <input type="text" name="answer1" placeholder="Answer One" value="" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
    		        </div>

    		        <div class="">
    		            <label class="text-sm font-semibold">Answer Two *</label>
    		            @if ($errors->has('answer2'))
    		                <span class="text-red-900 my-1">{{ $errors->first('answer2') }}</span>
    		            @endif
    		            <input type="text" name="answer2" placeholder="Answer Two" value="" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
    		        </div>
    		        <div class="">
    		            <label class="text-sm font-semibold">Answer Three *</label>
    		            @if ($errors->has('answer3'))
    		                <span class="text-red-900 my-1">{{ $errors->first('answer3') }}</span>
    		            @endif
    		            <input type="text" name="answer3" placeholder="Answer Three" value="" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
    		        </div>
                </div>

                <div class="grid grid-cols-1 gap-4 border border-green-500 p-4 mt-4">
    		        <div class="">
    		            <label class="text-sm font-semibold">Correct Answer *</label>
    		            @if ($errors->has('correct_answer'))
    		                <span class="text-red-700 py-1">{{ $errors->first('correct_answer') }}</span>
    		            @endif
    		            <input type="text" name="correct_answer" placeholder="Correct Answer" value="" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
    		        </div>


                </div>

                
		          <div class="mt-8">
		            <button type="submit" class="btn btn-red w-full py-2 text-xl flex justify-center items-center">
		                <span>Submit</span>
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
</main>


		@include('exam.backend.layouts.footer')
    </div>
</div>
