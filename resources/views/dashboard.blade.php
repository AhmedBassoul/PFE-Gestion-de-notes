@extends('layouts.master')

@section('title')
Espace Enseignant
@endsection

@section('css')
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row align-items-center">
        <div class="col-md-2 col-md-offset-2"></div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading m-0 font-weight-bold text-primary">Bienvenue {{ Auth::user()->name }}</div>
                    <div class="panel-body">
                        <br/>
                        <h4><b style="color: black">Plateforme Gestion-Notes de la FSDM </b></h4>
                        <br/>
                        <div class="row">
                            <div class="col-md-10">
                                <p>
                                    La plateforme offre une interface intuitive et conviviale qui permet aux professeurs de
                                    saisir, de consulter et de modifier les notes des étudiants à tout moment et depuis n'importe
                                    quel appareil connecté à Internet. Le présent projet a pour objectif de concevoir et de
                                    développer une plateforme en ligne permettant aux professeurs de saisir les notes des
                                    étudiants de manière rapide, fiable et sécurisée.
                                </p>
                                <pre>
                                </pre>
                        </div>
                    </div>   
                </div>       
            </div>
        </div>
    </div>          
    <div class="col-md-2 col-md-offset-2"></div>
</div>


@endsection


@section('scripts')
@endsection
