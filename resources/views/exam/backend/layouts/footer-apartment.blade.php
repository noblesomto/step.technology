@include('exam.frontend.components.footer')

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const menuButton = document.getElementById('menu-button');

    menuButton.addEventListener('click', function () {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', function () {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>
    <script>
  const calendarDays = document.getElementById('calendarDays');
  const currentMonthEl = document.getElementById('currentMonth');
  let currentDate = new Date();

  // Mock data for booked date ranges from the database (use actual DB data here)
  const bookedRanges = @json($bookedDates);
  const pendingRanges = @json($pendingDates);
  const websiteRanges = @json($bookedWebsite );
  const usedDates = [...bookedRanges, ...websiteRanges];

  function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    calendarDays.innerHTML = '';
    currentMonthEl.textContent = date.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });

    // Fill in the days
    for (let i = 0; i < firstDay; i++) {
      calendarDays.insertAdjacentHTML('beforeend', `<div></div>`);
    }

    for (let day = 1; day <= daysInMonth; day++) {
      const fullDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
      const isBooked = bookedRanges.some(range => new Date(range.checkin) <= new Date(fullDate) && new Date(range.checkout) >= new Date(fullDate));
      const isFree = pendingRanges.some(range => new Date(range.checkin) <= new Date(fullDate) && new Date(range.checkout) >= new Date(fullDate));
      const isBook = usedDates.some(range => new Date(range.checkin) <= new Date(fullDate) && new Date(range.checkout) >= new Date(fullDate));
      
      calendarDays.insertAdjacentHTML('beforeend', `
        <div class="p-2 ${isBook ? 'booked' : ''} ${isFree ? 'available' : ''} flex justify-center">
          ${day}
        </div>
      `);
    }
  }

  function changeMonth(delta) {
    currentDate.setMonth(currentDate.getMonth() + delta);
    renderCalendar(currentDate);
  }

  document.getElementById('prevMonth').addEventListener('click', () => changeMonth(-1));
  document.getElementById('nextMonth').addEventListener('click', () => changeMonth(1));

  // Initial render
  renderCalendar(currentDate);
</script>
</body>
</html>
