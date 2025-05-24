<x-admin.layout :title="$title">
    <div class="flex justify-center items-center min-h-screen bg-orange-50">
        <div class="bg-orange-100 p-10 rounded-2xl shadow-md w-full max-w-4xl">
            <h2 class="text-2xl font-bold text-center mb-10">Bukti Pembayaran Customer</h2>

            <div
                class="bg-white p-6 mx-auto w-full max-w-md rounded-md shadow border border-gray-200 text-sm text-gray-800">
                <div class="flex justify-start items-center mb-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/3e/Bank_Negara_Indonesia.svg"
                        alt="BNI Logo" class="h-6">
                    <span class="ml-4 font-semibold">Transaksi Berhasil</span>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Nomor Jurnal</span>
                        <span>135</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tanggal Transaksi</span>
                        <span>25-04-2025</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Waktu Transaksi</span>
                        <span>11:54:38 WIB</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Nama Rekening DEBIT</span>
                        <span>DHANI KRISNAMURTI</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Nomor Rekening DEBIT</span>
                        <span>********900</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Nama Rekening Tujuan</span>
                        <span>DA*** JATI****</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Nomor Rekening Tujuan</span>
                        <span>********754</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Nominal</span>
                        <span>Rp10.000.000,00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Fee</span>
                        <span>Rp0,00</span>
                    </div>
                    <div class="flex justify-between font-semibold">
                        <span>Total</span>
                        <span>Rp10.000.000,00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
