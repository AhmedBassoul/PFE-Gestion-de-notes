<?php

namespace App\Http\Controllers;

use App\Exports\NotesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportingDataController extends Controller
{

    public function exporter_note(Request $r,$module_name)
    {
        $idS = $r->input('idS');
        $session = ($idS == 1) ? 'Normal' : 'Rattrapage';
        $file_name = 'notes_module_' . $module_name . '_Session_' . $session . '.csv';
        return Excel::download(new NotesExport($idS), $file_name);
    }
}
