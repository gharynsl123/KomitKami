@extends('layouts.app')
@section('content')
<style>
#calendar {
    max-height: 32rem;
}

.external-event {
    margin: 10px 0;
    padding: 5px;
    background-color: #007bff;
    color: white;
    border-radius: 8px;
    cursor: pointer;
}
</style>
@if(Auth::user()->level == 'Production Manager')
<div class="pb-0">
    <div class="d-flex justify-content-end align-items-center">
        <a href="{{ url('/buat-tikect-produksi') }}" class="btn m-0 btn-primary">Buat Tiket</a>
    </div>
</div>
@endif
<div id="external-events" class="card mt-4 p-3 @if(Auth::user()->level != 'Production Manager') d-none @endif">
    <div class="row">
        @forelse($tiketsjadwal as $tiket)
        <div class="col-md-6">
            <div class="external-event" data-id="{{ $tiket->id }}">
                {{ $tiket->batch_number }} - {{ $tiket->product->name }}
            </div>
        </div>
        @empty
        <p class="text-muted m-0">Semua tiket sudah dijadwalkan.</p>
        @endforelse
    </div>
</div>

<div class="mt-4 card p-3">
    <div id="calendar"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enable dragging for external events
    var containerEl = document.getElementById('external-events');
    new FullCalendar.Draggable(containerEl, {
        itemSelector: '.external-event',
        eventData: function(eventEl) {
            return {
                title: eventEl.innerText,
                id: eventEl.dataset.id,
            };
        },
    });

    // Initialize FullCalendar
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        timeZone: 'Asia/Jakarta',
        editable: true,
        droppable: true,
        events: [
            @foreach($tikets as $tiket) {
                id: '{{ $tiket->id }}',
                title: '{{ $tiket->batch_number }}',
                start: '{{ $tiket->tanggal_produksi }}',
                description: '{{ $tiket->product->name }}',
                batch_size: '{{ $tiket->batch_size }}',
            },
            @endforeach
        ],
        dateClick: function(info) {
            var selectedDate = info.dateStr;
            window.location.href = `/detail-tiket/${selectedDate}`;
        },
        eventClick: function(info) {
            alert(
                'Nomor Batch: ' + info.event.title +
                '\nNama Produk: ' + info.event.description +
                '\nBatch Size: ' + info.event.batch_size
            );
        },
        drop: function(info) {
            var eventId = info.draggedEl.dataset.id;
            var newStart = new Date(info.dateStr).toISOString().split('T')[
            0]; // Pastikan dalam format ISO

            fetch(`/update-event/${eventId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        tanggal_produksi: newStart
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Update Successful:', data);
                    info.draggedEl.remove();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        },
        eventDrop: function(info) {
            var eventId = info.event.id;
            var newStart = info.event.start.toISOString().split('T')[0];

            // Update the event in the database
            fetch(`/update-event/${eventId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        tanggal_produksi: newStart
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Event Moved Successfully:', data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        },
    });

    calendar.render();
});
</script>
@endsection