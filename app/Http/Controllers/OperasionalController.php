<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\LogOperasional;
use App\Models\Notifikasi;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperasionalController extends Controller
{
    /**
     * Tampilan Halaman Approval Admin.
     */
    public function approval(Request $request)
    {
        $kategori = $request->query('kategori', 'semua');
        $urutan = $request->query('urutan', 'waktu');

        $query = Reservasi::with(['user', 'fasilitas', 'jadwalSlot'])
            ->where('status', 'pending');

        // Filter Fasilitas / Kategori
        if ($kategori && $kategori !== 'semua') {
            if ($kategori === 'ps') {
                $query->where(function ($q) {
                    $q->whereHas('fasilitas', function ($f) {
                        $f->where('kategori', 'ps');
                    })->orWhere('unit_kode', 'like', 'PS%');
                });
            } elseif ($kategori === 'xbox') {
                $query->where('unit_kode', 'like', 'XBOX%');
            } else {
                $query->whereHas('fasilitas', function ($f) use ($kategori) {
                    $f->where('kategori', $kategori);
                });
            }
        }

        // Pengurutan
        if ($urutan === 'terbaru') {
            $query->orderBy('created_at', 'desc');
        } elseif ($urutan === 'nama') {
            $query->join('users', 'reservasis.user_id', '=', 'users.id')
                ->orderBy('users.name', 'asc')
                ->select('reservasis.*');
        } else {
            // Default: Urutkan Waktu (tanggal reservasi dan jam slot)
            $query->join('jadwal_slots', 'reservasis.jadwal_slot_id', '=', 'jadwal_slots.id')
                ->orderBy('reservasis.tanggal_reservasi', 'asc')
                ->orderBy('jadwal_slots.jam_mulai', 'asc')
                ->select('reservasis.*');
        }

        $reservasis = $query->get();

        return view('admin.approval', compact('reservasis', 'kategori', 'urutan'));
    }

    /**
     * Menyetujui Reservasi.
     */
    public function approve($id)
    {
        $reservasi = Reservasi::with(['user', 'fasilitas'])->findOrFail($id);
        $reservasi->update(['status' => 'disetujui']);

        // Log Operasional
        LogOperasional::create([
            'admin_id' => Auth::id(),
            'aktivitas' => 'Approval Reservasi',
            'detail' => 'Menyetujui reservasi ' . $reservasi->kode_booking . ' untuk unit ' . $reservasi->unit_kode . ' oleh ' . ($reservasi->user->name ?? 'Mahasiswa'),
        ]);

        // Notifikasi ke Mahasiswa
        Notifikasi::create([
            'user_id' => $reservasi->user_id,
            'judul' => 'Reservasi Disetujui',
            'pesan' => 'Reservasi Anda dengan kode booking ' . $reservasi->kode_booking . ' (' . $reservasi->unit_nama . ') telah disetujui.',
            'is_read' => false,
        ]);

        return redirect()->route('admin.approval')->with('success', 'Pengajuan reservasi ' . $reservasi->kode_booking . ' berhasil disetujui.');
    }

    /**
     * Menolak Reservasi.
     */
    public function reject($id)
    {
        $reservasi = Reservasi::with(['user', 'fasilitas'])->findOrFail($id);
        $reservasi->update(['status' => 'ditolak']);

        // Log Operasional
        LogOperasional::create([
            'admin_id' => Auth::id(),
            'aktivitas' => 'Penolakan Reservasi',
            'detail' => 'Menolak reservasi ' . $reservasi->kode_booking . ' untuk unit ' . $reservasi->unit_kode . ' oleh ' . ($reservasi->user->name ?? 'Mahasiswa'),
        ]);

        // Notifikasi ke Mahasiswa
        Notifikasi::create([
            'user_id' => $reservasi->user_id,
            'judul' => 'Reservasi Ditolak',
            'pesan' => 'Mohon maaf, reservasi Anda dengan kode booking ' . $reservasi->kode_booking . ' (' . $reservasi->unit_nama . ') ditolak.',
            'is_read' => false,
        ]);

        return redirect()->route('admin.approval')->with('success', 'Pengajuan reservasi ' . $reservasi->kode_booking . ' berhasil ditolak.');
    }

    /**
     * Tampilan Halaman History Peminjaman & Rekapitulasi (Admin).
     */
    public function history(Request $request)
    {
        $bulan = (int) $request->query('bulan', now()->month);
        $tahun = (int) $request->query('tahun', now()->year);
        $unit = $request->query('unit', 'semua');

        $query = Reservasi::with(['user', 'fasilitas', 'jadwalSlot'])
            ->whereYear('tanggal_reservasi', $tahun)
            ->whereMonth('tanggal_reservasi', $bulan);

        if ($unit && $unit !== 'semua') {
            $query->where('unit_kode', $unit);
        }

        $reservasis = $query->orderBy('tanggal_reservasi', 'asc')
            ->orderBy('jadwal_slot_id', 'asc')
            ->get();

        // Kelompokkan data reservasi berdasarkan tanggal_reservasi (YYYY-MM-DD)
        $reservasiByDate = [];
        foreach ($reservasis as $res) {
            $dateKey = Carbon::parse($res->tanggal_reservasi)->format('Y-m-d');
            $reservasiByDate[$dateKey][] = [
                'id' => $res->id,
                'kode_booking' => $res->kode_booking,
                'unit_kode' => $res->unit_kode,
                'unit_nama' => $res->unit_nama,
                'fasilitas_nama' => $res->fasilitas->nama_fasilitas ?? '-',
                'jam' => $res->jadwalSlot
                    ? substr($res->jadwalSlot->jam_mulai, 0, 5) . ' - ' . substr($res->jadwalSlot->jam_selesai, 0, 5)
                    : '-',
                'nama' => $res->user->name ?? '-',
                'nim' => $res->user->nim ?? '-',
                'no_whatsapp' => $res->no_whatsapp ?? '-',
                'status' => $res->status,
                'created_at' => $res->created_at ? $res->created_at->format('Y-m-d H:i') : '-',
            ];
        }

        // Ambil daftar seluruh unit yang ada
        $allUnits = [];
        $fasilitasList = Fasilitas::all();
        foreach ($fasilitasList as $f) {
            if (is_array($f->units)) {
                foreach ($f->units as $u) {
                    if (!empty($u['kode']) && !in_array($u['kode'], $allUnits)) {
                        $allUnits[] = $u['kode'];
                    }
                }
            }
        }

        $carbonDate = Carbon::createFromDate($tahun, $bulan, 1);
        $daysInMonth = $carbonDate->daysInMonth;
        $monthName = $carbonDate->locale('id')->isoFormat('MMMM');

        $prevDate = $carbonDate->copy()->subMonth();
        $nextDate = $carbonDate->copy()->addMonth();

        return view('admin.history', compact(
            'bulan',
            'tahun',
            'unit',
            'monthName',
            'daysInMonth',
            'prevDate',
            'nextDate',
            'reservasiByDate',
            'allUnits'
        ));
    }

    /**
     * Unduh Rekapitulasi Harian Format .xlsx Sungguhan (OOXML via ZipArchive)
     */
    public function exportHistory(Request $request)
    {
        $tanggal = $request->query('tanggal', now()->toDateString());
        $unit = $request->query('unit');

        $query = Reservasi::with(['user', 'fasilitas', 'jadwalSlot'])
            ->whereDate('tanggal_reservasi', $tanggal);

        if ($unit && $unit !== 'semua') {
            $query->where('unit_kode', $unit);
        }

        $reservasis = $query->orderBy('jadwal_slot_id', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();

        $headers = [
            'No',
            'Kode Booking',
            'Tanggal Reservasi',
            'Sesi Jam',
            'Fasilitas',
            'Unit',
            'Nama Mahasiswa',
            'NIM',
            'No. WhatsApp',
            'Status',
            'Waktu Dibuat',
        ];

        $rows = [];
        $no = 1;
        foreach ($reservasis as $res) {
            $jam = $res->jadwalSlot
                ? substr($res->jadwalSlot->jam_mulai, 0, 5) . ' - ' . substr($res->jadwalSlot->jam_selesai, 0, 5)
                : '-';

            $rows[] = [
                $no++,
                $res->kode_booking,
                Carbon::parse($res->tanggal_reservasi)->format('Y-m-d'),
                $jam,
                $res->fasilitas->nama_fasilitas ?? '-',
                $res->unit_kode . ' (' . $res->unit_nama . ')',
                $res->user->name ?? '-',
                $res->user->nim ?? '-',
                $res->no_whatsapp ?? '-',
                ucfirst($res->status),
                $res->created_at ? $res->created_at->format('Y-m-d H:i:s') : '-',
            ];
        }

        $tempPath = $this->createXlsxFile($headers, $rows);
        $filename = "Rekap_Reservasi_{$tanggal}.xlsx";

        return response()->download($tempPath, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Alias method untuk kompatibilitas
     */
    public function exportXlsx(Request $request)
    {
        return $this->exportHistory($request);
    }

    /**
     * Buat file .xlsx valid berbasis ZipArchive (OOXML standard) dan simpan di direktori temp
     */
    protected function createXlsxFile(array $headers, array $rows): string
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'xlsx_');
        $zip = new \ZipArchive();
        $zip->open($tempFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // [Content_Types].xml
        $zip->addFromString('[Content_Types].xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
            '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">' .
            '<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>' .
            '<Default Extension="xml" ContentType="application/xml"/>' .
            '<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>' .
            '<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>' .
            '<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>' .
            '</Types>');

        // _rels/.rels
        $zip->addFromString('_rels/.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
            '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">' .
            '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>' .
            '</Relationships>');

        // xl/_rels/workbook.xml.rels
        $zip->addFromString('xl/_rels/workbook.xml.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
            '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">' .
            '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>' .
            '<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>' .
            '</Relationships>');

        // xl/workbook.xml
        $zip->addFromString('xl/workbook.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
            '<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">' .
            '<sheets><sheet name="Rekap Reservasi" sheetId="1" r:id="rId1"/></sheets>' .
            '</workbook>');

        // xl/styles.xml
        $zip->addFromString('xl/styles.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
            '<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">' .
            '<fonts count="2"><font><sz val="11"/><name val="Calibri"/></font><font><b/><sz val="11"/><name val="Calibri"/></font></fonts>' .
            '<fills count="2"><fill><patternFill patternType="none"/></fill><fill><patternFill patternType="gray125"/></fill></fills>' .
            '<borders count="1"><border><left/><right/><top/><bottom/></border></borders>' .
            '<cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>' .
            '<cellXfs count="2"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/><xf numFmtId="0" fontId="1" fillId="0" borderId="0" xfId="0"/></cellXfs>' .
            '</styleSheet>');

        // xl/worksheets/sheet1.xml
        $colLetter = function (int $colIdx): string {
            $letter = '';
            while ($colIdx >= 0) {
                $letter = chr($colIdx % 26 + 65) . $letter;
                $colIdx = intdiv($colIdx, 26) - 1;
            }
            return $letter;
        };

        $sheetData = '<sheetData>';
        // Header row
        $sheetData .= '<row r="1">';
        foreach ($headers as $colIdx => $h) {
            $ref = $colLetter($colIdx) . '1';
            $safeH = htmlspecialchars((string) $h, ENT_XML1, 'UTF-8');
            $sheetData .= '<c r="' . $ref . '" t="inlineStr" s="1"><is><t>' . $safeH . '</t></is></c>';
        }
        $sheetData .= '</row>';

        // Data rows
        $rowNum = 2;
        foreach ($rows as $row) {
            $sheetData .= '<row r="' . $rowNum . '">';
            foreach (array_values($row) as $colIdx => $val) {
                $ref = $colLetter($colIdx) . $rowNum;
                if (is_int($val) || (is_numeric($val) && !str_starts_with((string)$val, '0'))) {
                    $sheetData .= '<c r="' . $ref . '"><v>' . $val . '</v></c>';
                } else {
                    $safeVal = htmlspecialchars((string) $val, ENT_XML1, 'UTF-8');
                    $sheetData .= '<c r="' . $ref . '" t="inlineStr"><is><t>' . $safeVal . '</t></is></c>';
                }
            }
            $sheetData .= '</row>';
            $rowNum++;
        }
        $sheetData .= '</sheetData>';

        $zip->addFromString('xl/worksheets/sheet1.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
            '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">' . $sheetData . '</worksheet>');

        $zip->close();
        return $tempFile;
    }

    /**
     * Generator konten string .xlsx untuk backwards-compatibility
     */
    protected function generateXlsx(array $headers, array $rows): string
    {
        $file = $this->createXlsxFile($headers, $rows);
        $content = file_get_contents($file);
        @unlink($file);
        return $content;
    }
}
