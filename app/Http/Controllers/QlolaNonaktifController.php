<?php

namespace App\Http\Controllers;

use App\Models\QlolaNonaktif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QlolaNonaktifController extends Controller
{
    public function index(Request $request)
    {
        $query = QlolaNonaktif::query();

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_debitur', 'like', "%{$search}%")
                  ->orWhere('cifno', 'like', "%{$search}%")
                  ->orWhere('norek_pinjaman', 'like', "%{$search}%")
                  ->orWhere('norek_simpanan', 'like', "%{$search}%")
                  ->orWhere('kanca', 'like', "%{$search}%")
                  ->orWhere('uker', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan tahun
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        // Filter berdasarkan bulan
        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        $qlolaNonaktifs = $query->orderBy('id', 'desc')->paginate(20);

        return view('qlola-nonaktif.index', compact('qlolaNonaktifs'));
    }

    public function create()
    {
        return view('qlola-nonaktif.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kanca' => 'required',
            'kanca' => 'required',
            'kode_uker' => 'required',
            'uker' => 'required',
            'cifno' => 'required',
            'norek_pinjaman' => 'nullable',
            'norek_simpanan' => 'nullable',
            'nama_debitur' => 'required',
            'plafon' => 'nullable',
            'pn_pengelola' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        QlolaNonaktif::create($validated);

        return redirect()->route('qlola-nonaktif.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function show(QlolaNonaktif $qlolaNonaktif)
    {
        return view('qlola-nonaktif.show', compact('qlolaNonaktif'));
    }

    public function edit(QlolaNonaktif $qlolaNonaktif)
    {
        return view('qlola-nonaktif.edit', compact('qlolaNonaktif'));
    }

    public function update(Request $request, QlolaNonaktif $qlolaNonaktif)
    {
        $validated = $request->validate([
            'kode_kanca' => 'required',
            'kanca' => 'required',
            'kode_uker' => 'required',
            'uker' => 'required',
            'cifno' => 'required',
            'norek_pinjaman' => 'nullable',
            'norek_simpanan' => 'nullable',
            'nama_debitur' => 'required',
            'plafon' => 'nullable',
            'pn_pengelola' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        $qlolaNonaktif->update($validated);

        return redirect()->route('qlola-nonaktif.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(QlolaNonaktif $qlolaNonaktif)
    {
        $qlolaNonaktif->delete();

        return redirect()->route('qlola-nonaktif.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function importForm()
    {
        return view('qlola-nonaktif.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:10240',
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();
        
        DB::beginTransaction();
        try {
            $handle = fopen($path, 'r');
            $header = fgetcsv($handle, 0, ';'); // Skip header
            
            $batchData = [];
            $batchSize = 1000;
            
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                if (count($row) < 11) continue;
                
                $batchData[] = [
                    'kode_kanca' => trim($row[0]),
                    'kanca' => trim($row[1]),
                    'kode_uker' => trim($row[2]),
                    'uker' => trim($row[3]),
                    'cifno' => trim($row[4]),
                    'norek_pinjaman' => trim($row[5]),
                    'norek_simpanan' => trim($row[6]),
                    'nama_debitur' => trim($row[7]),
                    'plafon' => trim($row[8]),
                    'pn_pengelola' => trim($row[9]),
                    'keterangan' => trim($row[10]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                if (count($batchData) >= $batchSize) {
                    QlolaNonaktif::insert($batchData);
                    $batchData = [];
                }
            }
            
            if (!empty($batchData)) {
                QlolaNonaktif::insert($batchData);
            }
            
            fclose($handle);
            DB::commit();
            
            return redirect()->route('qlola-nonaktif.index')
                ->with('success', 'Data berhasil diimport');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function deleteAll()
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            QlolaNonaktif::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            
            return redirect()->route('qlola-nonaktif.index')
                ->with('success', 'Semua data berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
