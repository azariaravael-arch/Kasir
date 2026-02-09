<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Held Orders</h1>

        <div class="bg-white rounded shadow p-4">
            <div id="heldContainer">
                <div class="text-gray-500">Loading...</div>
            </div>
        </div>
    </div>

    <script>
        function loadHeld() {
            fetch('{{ route('pos.held') }}')
                .then(r => r.json())
                .then(data => {
                    const c = document.getElementById('heldContainer');
                    if (!data || data.length === 0) {
                        c.innerHTML = '<div class="text-gray-500">No held orders</div>';
                        return;
                    }
                    let html = '<div class="space-y-2">';
                    data.forEach(s => {
                        html += `
                            <div class="p-3 border rounded flex items-center justify-between">
                                <div>
                                    <div class="font-semibold">${s.invoice}</div>
                                    <div class="text-sm text-gray-500">Rp ${new Intl.NumberFormat('id-ID').format(s.total)} • ${new Date(s.created_at).toLocaleString()}</div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button onclick="resumeHeld(${s.id})" class="px-3 py-1 bg-emerald-500 text-white rounded">Resume</button>
                                    <a href="/pos/${s.id}/receipt" class="px-3 py-1 border rounded text-sm">Receipt</a>
                                </div>
                            </div>
                        `;
                    });
                    html += '</div>';
                    c.innerHTML = html;
                })
                .catch(err => {
                    document.getElementById('heldContainer').innerHTML = '<div class="text-red-500">Failed to load</div>';
                    console.error(err);
                });
        }

        function resumeHeld(id) {
            if (!confirm('Ambil order ini ke keranjang?')) return;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(`/pos/${id}/resume`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token }
            })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        // store items in localStorage and redirect to POS page
                        localStorage.setItem('pos_items', JSON.stringify(data.items));
                        window.location.href = '/pos';
                    } else {
                        alert('Gagal: ' + data.message);
                    }
                })
                .catch(err => {
                    alert('Gagal memproses resume');
                    console.error(err);
                });
        }

        document.addEventListener('DOMContentLoaded', loadHeld);
    </script>
</x-app-layout>
