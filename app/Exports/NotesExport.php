<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class NotesExport implements FromCollection, WithStrictNullComparison, WithHeadings, WithMapping
{

    private $idS;

    public function __construct($idS)
    {
        $this->idS = $idS;
    }

    public function collection()
    {
        $id = Auth::id();
        $responsabilites_table = DB::table('responsabilites')
            ->where('user_id', '=', $id)
            ->first();

        if ($this->idS == 1) {
            return DB::table('notes')
                ->join('etudiants', 'notes.etudiant_id', '=', 'etudiants.id')
                ->where('notes.module_id', '=', $responsabilites_table->module_id)
                ->where('notes.session_id', '=', $responsabilites_table->session_id)
                ->select(
                    'etudiants.Code',
                    'etudiants.nom',
                    'etudiants.prenom',
                    'etudiants.CNE',
                    'etudiants.CNI',
                    'notes.CF_N',
                    'notes.TP_N',
                    'notes.MG_N',
                    'notes.id as note_id'
                )
                ->get();
        }
        return DB::table('notes')
                ->join('etudiants', 'notes.etudiant_id', '=', 'etudiants.id')
                ->where('notes.module_id', '=', $responsabilites_table->module_id)
                ->where('notes.session_id', '=', $responsabilites_table->session_id)
                ->where('notes.MG_N', '<', 10)
                ->select(
                    'etudiants.Code',
                    'etudiants.nom',
                    'etudiants.prenom',
                    'etudiants.CNE',
                    'etudiants.CNI',
                    'notes.CF_N',
                    'notes.TP_N',
                    'notes.MG_N',
                    'notes.CF_R',
                    'notes.MG_R',
                    'notes.id as note_id'
                )
                ->get();
    }

    public function headings(): array
    {
        if($this->idS == 1){

        return [
            'Code Etudiant',
            'Nom Etudiant',
            'Prenom Etudiant',
            'CNE Etudiant',
            'CNI Etudiant',
            'Controle Finale Normal',
            'Controle Tp Normal',
            'Moyen Generale Normal',
            'etat'
        ];
        }

        return [
            'Code Etudiant',
            'Nom Etudiant',
            'Prenom Etudiant',
            'CNE Etudiant',
            'CNI Etudiant',
            'Controle Finale Normal',
            'Controle Tp Normal',
            'Moyen Generale Normal',
            'Controle Finale Rattrapage',
            'Moyen Generale Rattrapage',
            'etat'
        ];
    }
    public function map($row): array
    {
        $note_id = $row->note_id;
        $MG_N = DB::table('notes')->where('id', '=', $note_id)->value('MG_N');
        $MG_R = DB::table('notes')->where('id', '=', $note_id)->value('MG_R');
    
        if ($this->idS == 1) {
            $MG_N = $row->MG_N;
    
            if ($MG_N !== null && $MG_N >= 10 && $MG_N != 99.99) {
                $etat = 'Valide';
            } elseif ($MG_N !== null && $MG_N < 10) {
                $etat = 'Rattrapage';
            } else {
                $etat = 'Absence';
            }
    
            // si $this->idS vaut 1, on retourne les colonnes suivantes
            return [
                $row->Code,
                $row->nom,
                $row->prenom,
                $row->CNE,
                $row->CNI,
                $row->CF_N,
                $row->TP_N,
                $row->MG_N,
                $etat
            ];
        } elseif ($this->idS == 2) {
            $MG_R = $row->MG_R;
    
            if ($MG_R !== null && $MG_R >= 10) {
                $etat = 'Valider après rattrapage';
            } elseif ($MG_R !== null && $MG_R < 10) {
                $etat = 'Non valide';
            } else {
                $etat = 'Absence';
            }
    
            // si $this->idS vaut 2, on retourne les colonnes suivantes
            return [
                $row->Code,
                $row->nom,
                $row->prenom,
                $row->CNE,
                $row->CNI,
                $row->CF_N,
                $row->TP_N,
                $row->MG_N,
                $row->CF_R,
                $row->MG_R,
                $etat
            ];
        } else {
            // si $this->idS n'est ni 1 ni 2, on retourne un tableau vide
            return [];
        }
    }
    
}