<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;


class UserImportExportController extends Controller
{
    public function index()
    {
        return view('users.import_export');
    }

    // EXPORT USERS TO CSV
    public function export()
    {
        $users = User::all();

        $headers = [
            "Content-Type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=users_export.csv",
        ];

        $callback = function () use ($users) {
            $file = fopen('php://output', 'w');

            // header row
            fputcsv($file, [
                'first_name', 'last_name', 'email', 'password_hash',
                'role_id', 'dept_id', 'is_active', 'created_at'
            ]);

            // data rows
            foreach ($users as $u) {
                fputcsv($file, [
                    $u->first_name,
                    $u->last_name,
                    $u->email,
                    $u->password_hash,
                    $u->role_id,
                    $u->dept_id,
                    $u->is_active,
                    $u->created_at
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // IMPORT USERS FROM CSV
    public function import(Request $request)
    {
        Log::info("IMPORT STARTED");

        try {
            if (!$request->hasFile('file')) {
                Log::error("No file uploaded");
                return back()->with('error', 'No file uploaded.');
            }

            $file = $request->file('file');
            Log::info("Uploaded file detected", [
                'original_name' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'size' => $file->getSize(),
            ]);

            // Validate CSV or Excel
            $ext = $file->getClientOriginalExtension();
            if (!in_array($ext, ['csv', 'xlsx', 'xls'])) {
                Log::error("Invalid file type", ['extension' => $ext]);
                return back()->with('error', 'Invalid file format. Must be CSV or Excel.');
            }

            // Maatwebsite reader
            Log::info("Beginning Excel Import Process");

            $import = new UserImport();

            Excel::import($import, $file);

            return back()->with('success', 'Users imported successfully.');

        } catch (\Exception $e) {
            Log::error("IMPORT FAILED", [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
}


