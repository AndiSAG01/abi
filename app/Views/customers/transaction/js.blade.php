<!-- kalender -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendar = document.getElementById('calendar');
        const monthYearElement = document.getElementById('monthYear');
        const months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        let today = new Date();
        let currentMonth = today.getMonth();
        let currentYear = today.getFullYear();
        let bookings = []; // Menyimpan daftar tanggal booking

        // **Ambil data booking dari server**
        function fetchBookings() {
            fetch('/getBookingDates') // Sesuaikan dengan endpoint CodeIgniter
                .then(response => response.json())
                .then(data => {
                    bookings = data.map(booking => ({
                        start: booking.start_date,
                        end: booking.end_date
                    }));
                    showMonth(currentMonth,
                        currentYear); // **Tampilkan kalender setelah data booking didapat**
                })
                .catch(error => console.error('Error fetching booking data:', error));
        }

        function showMonth(month, year) {
            calendar.innerHTML = '';

            const monthContainer = document.createElement('div');
            monthContainer.classList.add('month-container');

            monthYearElement.innerText = `${months[month]} ${year}`;

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
                const date =
                    `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                const dayElement = document.createElement('div');
                dayElement.classList.add('day');
                dayElement.innerText = day;

                let isBooked = false;
                bookings.forEach(booking => {
                    if (date >= booking.start && date <= booking.end) {
                        isBooked = true;
                    }
                });

                if (isBooked) {
                    dayElement.classList.add('booked'); // Tambahkan kelas 'booked' jika tanggal terbooking
                } else {
                    dayElement.classList.add('available');
                }

                daysGrid.appendChild(dayElement);
            }

            monthContainer.appendChild(daysGrid);
            calendar.appendChild(monthContainer);
        }

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

        fetchBookings(); // **Ambil data booking saat halaman dimuat**
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
<!-- end-kalender -->



<!-- sweetaleert -->
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
                        window.location.href =
                            "<?= base_url('/transactions/delete/') ?>" + categoryId;
                    }
                });
            });
        });
    });
</script>
<!-- end-sweetalert -->


<!-- subtotal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tourCheckboxes = document.querySelectorAll('input[name="cart_id[]"]');
        const itemCheckboxes = document.querySelectorAll('.item-checkbox');
        const itemQtyInputs = document.querySelectorAll('.item-qty');
        const totalPeopleInput = document.querySelector('input[name="total_people"]');
        const subtotalDisplay = document.getElementById('subtotal');

        function getTotalPeople() {
            return parseInt(totalPeopleInput.value) || 0;
        }

        function calculateSubtotal() {
            let total = 0;

            // Hitung total dari tour (jika dipilih)
            tourCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const row = checkbox.closest('tr');
                    const priceText = row.querySelector('td:nth-child(3)').textContent;
                    const price = parseInt(priceText.replace(/[^\d]/g, '')) || 0;
                    const jumlahPeserta = getTotalPeople();
                    total += price * jumlahPeserta;
                }
            });

            // Hitung total dari item tambahan
            itemCheckboxes.forEach((checkbox, index) => {
                if (checkbox.checked) {
                    const price = parseInt(checkbox.dataset.price);
                    const qtyInput = checkbox.closest('.form-check').querySelector('.item-qty');
                    const qty = parseInt(qtyInput.value) || 1;
                    total += price * qty;
                }
            });

            subtotalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Aktifkan qty input hanya jika checkbox dipilih
        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const qtyInput = this.closest('.form-check').querySelector('.item-qty');
                qtyInput.disabled = !this.checked;
                if (!this.checked) qtyInput.value = 1;
                calculateSubtotal();
            });
        });

        // Perubahan jumlah peserta
        totalPeopleInput.addEventListener('input', calculateSubtotal);

        // Perubahan qty item
        itemQtyInputs.forEach(input => {
            input.addEventListener('input', calculateSubtotal);
        });

        // Perubahan pilihan tour
        tourCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', calculateSubtotal);
        });

        // Hitung saat load jika ada yang dipilih
        calculateSubtotal();
    });
</script>

<!-- end-subtotal -->

<!-- atur-tanggal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date().toISOString().split('T')[0]; // Ambil tanggal hari ini dalam format YYYY-MM-DD

        // Atur tanggal minimal pada input date
        document.getElementById("start_date").setAttribute("min", today);
        document.getElementById("end_date").setAttribute("min", today);

        // Pastikan tanggal end_date tidak lebih kecil dari start_date
        document.getElementById("start_date").addEventListener("change", function() {
            document.getElementById("end_date").setAttribute("min", this.value);
        });
    });
</script>
<!-- end-atur-tanggal -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.item-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                let qtyInput = this.closest('.form-check').querySelector('.item-qty');
                if (this.checked) {
                    qtyInput.removeAttribute('disabled');
                } else {
                    qtyInput.setAttribute('disabled', 'disabled');
                    qtyInput.value = 1; // Reset qty ke 1 jika tidak dipilih
                }
            });
        });
    });
</script>

