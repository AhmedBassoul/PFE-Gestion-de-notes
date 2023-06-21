<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class SaisirController extends Controller
{
    public function saisir_note(Request $request, $ids)
    {
        $module_name = $request->input('module_name');
        $user_name = $request->input('user_name');
        $SESSION = $request->input('SESSION');
        $id_prof = Auth::id();

        $responsabilites_table = User::findOrFail($id_prof)->responsabilites;

        $module_id = $responsabilites_table->pluck('module_id')->first();

        $session_id = $responsabilites_table->pluck('session_id')->first();

        $etudiant = Note::where('module_id', $module_id)
            ->where('session_id', $session_id)
            ->join('etudiants', 'notes.etudiant_id', '=', 'etudiants.id')
            ->leftjoin('users', 'notes.user_id', '=', 'users.id')
            ->select(
                'etudiants.id',
                'etudiants.code',
                'etudiants.nom',
                'etudiants.prenom',
                'users.name',
                'users.id as profId',
                'notes.CF_N',
                'notes.TP_N',
                'notes.MG_N',
                'notes.CF_R',
                'notes.MG_R'
            )
            ->when($SESSION == 'Rattrapage', function ($query) {
                return $query->where('MG_N', '<', 10);
            })
            ->get();

        $module_coef_tp = Module::where('id', $module_id)->value('coef_tp');
        $module_coef_cf = Module::where('id', $module_id)->value('coef_cf');

        $module_coef_tp = Module::where('id', $module_id)->value('coef_tp');
        $module_coef_cf = Module::where('id', $module_id)->value('coef_cf');
        $responsable_module = Module::where('id',$module_id)->value('user_id');
        $prof_saisit = DB::table('notes')
        ->join('users', 'notes.user_id', '=', 'users.id')
        ->select('users.id as user_id', 'users.name as prof_name_saisit')
        ->distinct()
        ->where('notes.module_id', '=', $module_id)
        ->get();

        return view('Principale.Saisir', [
            'prof_saisit' => $prof_saisit,
            'responsable_module'=> $responsable_module,
            'SESSION' => $SESSION,
            'module_id' => $module_id,
            'module_name' => $module_name,
            'user_name' => $user_name,
            'etudiant' => $etudiant,
            'module_coef_tp' => $module_coef_tp,
            'module_coef_cf' => $module_coef_cf,
            'user_id' => $id_prof,
        ]);
    }
}

