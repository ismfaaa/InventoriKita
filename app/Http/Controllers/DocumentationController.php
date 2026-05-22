<?php

namespace App\Http\Controllers;

use App\Models\Documentation;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index()
    {
        $documentations = Documentation::all();
        return view('pages.documentation.index', compact('documentations'));
    }

    public function show(Documentation $documentation)
    {
        return view('pages.documentation.show', compact('documentation'));
    }

    public function download(Documentation $documentation)
    {
        if (!$documentation->file_name) {
            return redirect()->back()->with('error', 'File tidak tersedia untuk diunduh');
        }

        $filePath = public_path('files/' . $documentation->file_name);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return response()->download($filePath);
    }
}
