<div id="sidebar" class="fixed md:sticky top-0 h-screen z-30 inset-y-0 left-0 w-64  bg-dark text-white font-normal transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out">
  <div class="">
      
    <div class="p-6">
        
        <nav class="mt-1">
            <a href="/admin/index" class="block py-2.5 px-4 rounded hover:bg-text_red">Dashboard</a>
            <!-- Dropdown 1 -->
            <div class="relative">
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-text_red dropdown-toggle">
                    Questions
                </a>
                <div class="dropdown-menu hidden absolute top-full left-0 z-10 mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-200">
                    <a href="/admin/new-question" class="block px-4 py-2 text-gray-700 hover:bg-red-100">New Question</a>
                    <a href="/admin/questions" class="block px-4 py-2 text-gray-700 hover:bg-red-100">List Questions</a>
                </div>
            </div>
            <a href="/admin/enrollments" class="block py-2.5 px-4 rounded hover:bg-text_red">Exam Enrollment</a>

            <a href="/admin/logout" class="block py-2.5 px-4 rounded hover:bg-text_red">Logout</a>
        </nav>

    </div>
  </div>
</div>
