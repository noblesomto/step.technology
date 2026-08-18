<style>
        /* Set slider container to have overflow-hidden to hide non-active slides */
        .slider-container {
            overflow: hidden;
        }
        /* Animate the sliding effect */
        .slider {
            transition: transform 1s ease-in-out;
        }
    </style>
<!-- Image Slider Container -->
<div class="relative slider-container w-full  mx-auto">

        <!-- Slides (Slider Items) -->
        <div id="slider" class="slider flex w-full">

            <!-- Slide 1 -->
            <div class="w-full flex-shrink-0 relative">
                <img src="{{ asset('frontend/images/slide1.jpg') }}" alt="Slide 1" class="w-full h-auto lg:h-screen object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-0  flex justify-start items-center text-white p-4">
                    <div class="ml-5 hidden lg:block bg-black bg-opacity-50 p-4 w-2/4 text-white">
                      <h2 class="text-4xl font-bold mb-4 ">Built on Trust</h2>
                    <p class="text-lg  mb-6">Our team is dedicated to ensuring that your best interests are always served, through the provision of our highly professional services. </p>
                    <a href="#" class="btn btn-red py-2">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="w-full flex-shrink-0 relative">
                <img src="{{ asset('frontend/images/slide2.jpg') }}" alt="Slide 1" class="w-full h-auto lg:h-screen object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-0  flex justify-start items-center text-white p-4">
                    <div class="ml-5 hidden lg:block bg-black bg-opacity-50 p-4 w-2/4">
                      <h2 class="text-4xl font-bold mb-4">No Hidden Costs </h2>
                    <p class="text-lg mb-6">Fixed monthly costs cover everything you need; from utility charges to maintenance services, everything is included with no surprises round the corner.</p>
                    <a href="#" class="btn btn-red py-2">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="w-full flex-shrink-0 relative">
                <img src="{{ asset('frontend/images/slide3.jpg') }}" alt="Slide 1" class="w-full h-auto lg:h-screen object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-0  flex justify-start items-center text-white p-4">
                    <div class="ml-5 hidden lg:block bg-black bg-opacity-50 p-4 w-2/4">
                      <h2 class="text-4xl font-bold mb-4">Fully Furnished</h2>
                    <p class="text-lg mb-6">Your future home will be fully equipped with all the furniture and supplies necessary to ensure your comfort, without missing a thing.</p>
                    <a href="#" class="btn btn-red py-2">Learn More</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Slider Buttons (Navigation) -->
        <button id="prevBtn" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full">
            &#10094;
        </button>
        <button id="nextBtn" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full">
            &#10095;
        </button>
    </div>