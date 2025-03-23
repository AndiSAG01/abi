<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendar = document.getElementById('calendar');
    const startBooking = '2025-03-01';
        const endBooking = '2025-03-10';

        const months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        let currentMonth = 2; // Mulai dari Maret
        let currentYear = 2025; // Tahun yang ditampilkan

        function showMonth(month, year) {
            calendar.innerHTML = '';
            const monthContainer = document.createElement('div');
            monthContainer.classList.add('month-container');
            const monthTitle = document.createElement('h4');
            monthTitle.innerText = `${months[month]} ${year}`;
            monthContainer.appendChild(monthTitle);

            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const firstDay = new Date(year, month, 1).getDay();

            const daysGrid = document.createElement('div');
            daysGrid.classList.add('days-grid');

            for (let i = 0; i < firstDay; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.classList.add('day', 'empty');
                daysGrid.appendChild(emptyDay);
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const date = `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                const dayElement = document.createElement('div');
                dayElement.classList.add('day');
                dayElement.innerText = day;

                if (date >= startBooking && date <= endBooking) {
                    dayElement.classList.add('booked');
                } else {
                    dayElement.classList.add('available');
                }

                daysGrid.appendChild(dayElement);
            }

            monthContainer.appendChild(daysGrid);
            calendar.appendChild(monthContainer);
        }

        showMonth(currentMonth, currentYear);

        document.getElementById('prevMonth').addEventListener('click', function() {
            if (currentMonth > 0) {
                currentMonth--;
            } else {
                currentMonth = 11;
                currentYear--;
            }
            showMonth(currentMonth, currentYear);
        });

        document.getElementById('nextMonth').addEventListener('click', function() {
            if (currentMonth < 11) {
                currentMonth++;
            } else {
                currentMonth = 0;
                currentYear++;
            }
            showMonth(currentMonth, currentYear);
        });
    });
</script>

 
<script src="/admin/vendors/sweetalert/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".btn-delete").forEach(function(button) {
            button.addEventListener("click", function() {
                let categoryId = this.getAttribute("data-id");

                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "<?= base_url('/transactions/delete/') ?>" + categoryId;
                    }
                });
            });
        });
    });
</script>


<style>
    @media (max-width: 767.98px) {
        .carousel-item {
            width: 100% !important;
            margin-left: 0 !important;
        }

        .card-body {
            padding: 10px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .form-control {
            font-size: 14px;
        }

        .card-header {
            font-size: 18px;
        }

        .carousel-controls {
            display: none;
        }
    }

    #calendar {
        display: flex;
        justify-content: center;
    }

    .days-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }

    .day {
        padding: 10px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .available {
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }

    .booked {
        background-color: #ccc;
        color: #fff;
    }

    .empty {
        visibility: hidden;
    }

    .month-container {
        margin-bottom: 20px;
    }

    .month-container h4 {
        text-align: center;
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 10px;
    }

    .nav-buttons {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
</style>