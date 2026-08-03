<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    // Tampilkan daftar meja & QR Code yang sudah tersimpan
    public function index()
    {
        $tables = Table::orderBy('number', 'asc')->get();
        return view('admin.tables.index', compact('tables'));
    }

    // Simpan Meja Baru + Generate File SVG/PNG QR Code
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string|unique:tables,number',
        ]);

        $tableNumber = $request->input('number');
        $url = url('/menu?meja=' . $tableNumber);

        // Path folder penyimpanan
        $fileName = 'qrcode-meja-' . $tableNumber . '.svg';
        $path = 'qrcodes/' . $fileName;

        // Generate QR Code SVG & simpan ke Storage
        $qrCodeImage = QrCode::format('svg')->size(300)->generate($url);
        Storage::disk('public')->put($path, $qrCodeImage);

        // Simpan ke Database
        Table::create([
            'number' => $tableNumber,
            'qr_code_path' => $path,
        ]);

        return redirect()->back()->with('success', 'QR Code Meja ' . $tableNumber . ' berhasil dibuat & disimpan!');
    }

    // Halaman Cetak/Print khusus (Auto Print via browser)
    public function print($id)
    {
        $table = Table::findOrFail($id);
        $url = url('/menu?meja=' . $table->number);
        $qrCode = QrCode::size(300)->generate($url);

        return view('admin.tables.print', compact('table', 'qrCode'));
    }

    // Hapus QR Code & data meja
    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        
        // Hapus file dari storage
        if ($table->qr_code_path && Storage::disk('public')->exists($table->qr_code_path)) {
            Storage::disk('public')->delete($table->qr_code_path);
        }

        $table->delete();

        return redirect()->back()->with('success', 'Data Meja & QR Code berhasil dihapus.');
    }
}