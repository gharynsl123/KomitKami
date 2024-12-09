@extends('layouts.app')
@section('content')
<div class="card p-3 mb-4">
    <h5>Tambahkan Ruangan</h5>
    <form action="{{url('/store-nama-ruangan')}}" method="post">
        @csrf
        <input type="text" name="nama_ruangan" id="NamaRuangan" placeholder="Isi Nama Ruangan"
            class="form-control px-2 border mb-3">
        <button type="submit" id="SubmitButton" class="btn btn-primary m-0" disabled>Tambahkan</button>
    </form>
</div>

@foreach ($rooms as $room)
<div class="card p-3 mb-4 shadow-sm">
    <!-- Nama Ruangan -->
    <div class="d-flex justify-content-between align-items-center room-container">
        <h5 class="idruangan">{{$room->nama_ruangan}}</h5>
        <input type="text" name="nama_ruangan" value="{{$room->nama_ruangan}}"
            class="formUbahRuangan d-none border px-2">
        <div>
            <button class="btn btn-info btn-sm editButton" onclick="editItem(this)">Edit</button>
            <button class="btn btn-warning btn-sm d-none exitButton">Batal</button>
            <button class="btn btn-success btn-sm d-none saveButton" data-room-id="{{ $room->id }}"
                onclick="saveItem(this)">Simpan</button>
            <button class="btn btn-primary btn-sm" onclick="addItem({{ $room->id }})">Tambahkan Barang +</button>
        </div>
    </div>

    <!-- List Barang -->
    <div class="mt-3">
        @if ($room->items->isNotEmpty())
        <div class="d-grid gap-2" style="grid-template-columns: repeat(2, 1fr);">
            @foreach ($room->items as $item)
            <div class="p-2 bg-light d-flex align-items-center justify-content-between rounded border">
                <span>{{ $item->nama_bagian }}</span>
                <form action="{{ url('/delete-bagian', $item->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn m-0 btn-danger btn-sm" 
                            onclick="return confirm('Yakin ingin menghapus bagian {{ $item->nama_bagian }}?');">
                        <i class="material-icons opacity-10" style="font-size: 20px;">delete</i>
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-muted">Belum ada barang.</p>
        @endif
    </div>

</div>
@endforeach

<!-- Modal Tambah Barang -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('/store-bagian') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Tambahkan Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" hidden name="ruang_produksi_id" id="roomIdInput">
                    <input type="text" name="nama_bagian" class="form-control border px-2" placeholder="Nama Barang"
                        required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
const inputField = document.getElementById('NamaRuangan');
const submitButton = document.getElementById('SubmitButton');

inputField.addEventListener('input', function() {
    // Enable the button if the input has value, otherwise disable it
    submitButton.disabled = !this.value.trim();
});

function editItem(button) {
    const container = button.closest('.room-container');
    const h5Ruangan = container.querySelector('.idruangan');
    const inputRuangan = container.querySelector('.formUbahRuangan');
    const editButton = container.querySelector('.editButton');
    const saveButton = container.querySelector('.saveButton');
    const exitButton = container.querySelector('.exitButton');

    // Tampilkan input dan tombol terkait
    inputRuangan.classList.remove('d-none');
    saveButton.classList.remove('d-none');
    exitButton.classList.remove('d-none');
    h5Ruangan.classList.add('d-none');
    editButton.classList.add('d-none');

    // Tombol batal: kembalikan form ke tampilan awal
    exitButton.addEventListener('click', function() {
        inputRuangan.classList.add('d-none');
        saveButton.classList.add('d-none');
        exitButton.classList.add('d-none');
        h5Ruangan.classList.remove('d-none');
        editButton.classList.remove('d-none');
    });
}

function saveItem(button) {
    const roomId = button.getAttribute('data-room-id');
    const container = button.closest('.room-container');
    const h5Ruangan = container.querySelector('.idruangan');
    const inputRuangan = container.querySelector('.formUbahRuangan');
    const exitButton = container.querySelector('.exitButton');
    const editButton = container.querySelector('.editButton');
    const saveButton = container.querySelector('.saveButton');

    const updatedName = inputRuangan.value;

    if (!updatedName.trim()) {
        alert('Nama ruangan tidak boleh kosong!');
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/update-nama-ruangan/${roomId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                nama_ruangan: updatedName
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                h5Ruangan.textContent = updatedName;
                h5Ruangan.classList.remove('d-none');
                inputRuangan.classList.add('d-none');
                editButton.classList.remove('d-none');
                saveButton.classList.add('d-none');
                exitButton.classList.add('d-none');
            } else {
                alert('Gagal memperbarui nama ruangan.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan. Silakan coba lagi.');
        });
}



function addItem(roomId) {
    document.getElementById('roomIdInput').value = roomId;

    const addItemModal = new bootstrap.Modal(document.getElementById('addItemModal'));
    addItemModal.show();
}
</script>
@endsection