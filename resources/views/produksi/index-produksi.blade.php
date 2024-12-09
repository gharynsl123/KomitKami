@extends('layouts.app')
@section('content')
<style>
#calendar {
    max-height: 32rem;
}
</style>
@if(Auth::user()->level == 'production manager')
<div class="pb-0">
    <div class="d-flex justify-content-end align-items-center ">
        <a href="{{url('/buat-tikect-produksi')}}" class="btn m-0 btn-primary">Buat tikect</a>
    </div>
</div>
@endif
<div class="mt-4 card p-3">
    <div id='calendar'></div>
</div>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            @foreach($tikets as $tiket)
            {
                title: '{{ $tiket->batch_number }}',
                start: '{{ $tiket->tanggal_produksi }}',
                description: '{{ $tiket->product->name }}',
                batch_size: '{{ $tiket->batch_size }}'
            },
            @endforeach
        ],
        dateClick: function(info) {
            var selectedDate = info.dateStr; 
            window.location.href = `/detail-tiket/${selectedDate}`;
        },
        eventClick: function(info) {
            alert('Nomor Batch: ' + info.event.title + '\nnama Porduk: ' + info.event.extendedProps.description + '\nbatch size: ' + info.event.extendedProps.batch_size);
        }
    });
    calendar.render();

    const produksi = @json($tikets);
    setInterval(() => {
        produksi.forEach(item => {
            const DueDate = new Date(item.tanggal_produksi).toISOString().split('T')[0]; // Ubah ke format 'Y-m-d'
            const currentDay = new Date().toISOString().split('T')[0]; // Tanggal hari ini di format 'Y-m-d'

            if (item.status === 'pending'){
                if (DueDate <= currentDay || DueDate === currentDay) {
                    item.status = 'open'; 

                    // Update status di server
                    fetch(`/update-status-produksi/${item.id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Jika menggunakan Laravel
                        },
                        body: JSON.stringify({ status: 'open' }), // Update status di server
                    })
                    .then(response => response.json())
                    .then(data => console.log('Update Successful:', data))
                    .catch(error => console.error('Error:', error));
                }
            } else {
                console.log(`produksi ${item.batch_number} sudah di buka`)
            }
        });
    }, 1 * 60 * 5) // Panggil setiap 5 menit/
});
</script>
@endsection