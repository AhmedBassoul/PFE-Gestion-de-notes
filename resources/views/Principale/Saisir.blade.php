@extends('layouts.master')

@section('title')
    Notes {{ $SESSION }}
@endsection

@section('css')
    <link href="{{ url('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <form method="POST" action="{{ route('noteEx', ['module_name' => $module_name]) }}" id="exportf">
        @csrf
        <input type="hidden" name="idS" value="{{ $SESSION == 'Normal' ? 1 : 2 }}">
    </form>
    <form method="post" action="{{ route('save') }}" id="notes" name="notes">
        @csrf
        <input type="hidden" name="module_id" value="{{ $module_id }}">
        <input type="hidden" name="Session" value="{{ $SESSION }}">
        <input type="hidden" name="user" value="{{ $user_id }}">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-md-8">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Module {{ $module_name }} Session {{ $SESSION }}</h1>
                    </div>
                </div>
                <div class="col-md-1">
                <div class="badge badge-info ">coef TP : {{ $module_coef_tp *100 }}  %</div>
                <div class="badge badge-info "> coef CF : {{ $module_coef_cf *100 }} %</div>
                </div>
                
                <div class="col-md-3">
                    <div class="text-right">
                        <button class="btn btn-primary mb-1" id="export-button" type="button">Exporter</button>
                        <button type="submit" class="btn btn-primary mb-1" id="save"
                            name="save">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="card ">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Statistiques</h6>
                        </div>
                        <div class="card-content">
                            <div class="d-flex px-4 py-3">
                                <div class="name ms-4">
                                    <div class="mb-1 badge badge-success col-md-10">Validé : <span id="valide">0</span>
                                    </div>
                                    @if ($SESSION == 'Normal' || $SESSION == 'Normal')
                                        <div class="mb-1 badge badge-info col-md-10">Rattrapage : <span
                                                id="ratt">0</span></div>
                                    @endif
                                    <div class="mb-1 badge badge-warning col-md-10">Non Validé : <span
                                            id="noValide">0</span></div>
                                    <div class="mb-1 badge badge-danger col-md-10"> Erreur : <span id="erreur">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Inséré par</h6>
                        </div>
                        <div class="card-content">
                            <div class="d-flex px-4 py-3">
                                <div class="name ms-4">
                                    @foreach ($prof_saisit as $prof)
                                        <div class="mb-1 badge badge-light col-md-12">{{ $prof->prof_name_saisit }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Code</th>
                                            <th>Nom et Prénom</th>
                                            <th>CF</th>
                                            @if ($module_coef_cf != 1)
                                                <th>TP</th>
                                            @else
                                                <th></th>
                                            @endif
                                            <th>MG</th>
                                            <th>État</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        @foreach ($etudiant as $e)
                                            <tr>
                                                <td>{{ $e['code'] }} </td>
                                                <td> {{ $e['nom'] }} {{ $e['prenom'] }}</td>
                                                @php
                                                    $cfValue = $SESSION === 'Rattrapage' ? $e['CF_R'] ?? null : $e['CF_N'] ?? null;
                                                    $mgValue = $SESSION === 'Rattrapage' ? $e['MG_R'] ?? null : $e['MG_N'] ?? null;
                                                @endphp
                                                @if ($e['profId'] == $user_id || $user_id == $responsable_module || $cfValue == null || $cfValue == '')
                                                    <td><input type="text" class="form-control form-control-sm mb-3"
                                                            name="noteCf[{{ $e['id'] }}]"
                                                            id="noteCf[{{ $e['id'] }}]" value="{{ $cfValue }}"
                                                            oninput="fmoyen(this)" onblur="getErreur(this)" /></td>
                                                @else
                                                    <td><input type="text" class="form-control form-control-sm mb-3"
                                                            name="noteCf[{{ $e['id'] }}]"
                                                            id="noteCf[{{ $e['id'] }}]" value="{{ $cfValue }}"
                                                            oninput="fmoyen(this)" disabled onblur="getErreur(this)" /></td>
                                                @endif
                                                @if ($module_coef_cf != 1)
                                                    @if ($e['profId'] == $user_id || $user_id == $responsable_module || $cfValue == null || $cfValue == '')
                                                        <td><input type="text" class="form-control form-control-sm  mb-3"
                                                                name="noteTp[{{ $e['id'] }}]"
                                                                value="{{ $e['TP_N'] }}" oninput="fmoyen(this)"
                                                                onblur="getErreur(this)" /> </td>
                                                    @else
                                                        <td><input type="text" class="form-control form-control-sm  mb-3"
                                                                name="noteTp[{{ $e['id'] }}]"
                                                                value="{{ $e['TP_N'] }}" oninput="fmoyen(this)" disabled
                                                                onblur="getErreur(this)" /> </td>
                                                    @endif
                                                @else
                                                    <td><input type="number" value="0" hidden
                                                            name="noteTp[{{ $e['id'] }}]" /> </td>
                                                @endif
                                                <td id="moyen_{{ $e['id'] }}" name="moyen[{{ $e['id'] }}]">
                                                    {{ $mgValue }}</td>
                                                <input type="hidden" name="moyen[{{ $e['id'] }}]"
                                                    id="moyen_input_{{ $e['id'] }}" data-id="{{ $e['id'] }}">
                                                <td id="etat_{{ $e['id'] }}"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('scripts')
    <!-- Page level plugins -->



    <script src="{{ url('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#dataTableHover').DataTable({
                @if ($module_coef_cf == 1)
                    columnDefs: [{
                        targets: [3],
                        sortable: false,
                        searchable: false
                    }]
                @endif
            });

            $('#export-button').click(function() {
                $('#exportf').submit();
            });

            $('#save').click(function() {
                $('#notes').submit();
            });
        });
    </script>

    <script>
        function replaceCommaWithDot(str) {

            return str.replace(',', '.');
        }

        function fmoyen(input) {
            const row = input.parentNode.parentNode;
            valueNoteCf = row.querySelector('[name^="noteCf"]').value;
            if ({{ $module_coef_cf }} != 1) {
                valueNoteTp = row.querySelector('[name^="noteTp"]').value;
                if (valueNoteTp == '')
                    noteTp = 0;
                else
                    noteTp = parseFloat(valueNoteTp);
                if (valueNoteCf == '')
                    noteCf = 0;
                else
                    noteCf = parseFloat(valueNoteCf);
                if (valueNoteTp == '' || valueNoteCf == '' || valueNoteTp == 0 || valueNoteCf == 0)
                    moyen = 99.99;
                else
                    moyen = (noteCf * {{ $module_coef_cf }}) + (noteTp * {{ $module_coef_tp }});
            } else {
                if (valueNoteCf == '')
                    noteCf = 0;
                else
                    noteCf = parseFloat(valueNoteCf);
                if (valueNoteCf == '' || valueNoteCf == 0)
                    moyen = 99.99;
                else
                    moyen = noteCf;
            }
            console.log(row.querySelectorAll('input')[2]);
            row.querySelectorAll('td')[row.querySelectorAll('td').length - 2].textContent = moyen.toFixed(2);
            row.querySelectorAll('input')[2].setAttribute("value", moyen.toFixed(2));

            if (moyen >= 10 && moyen <= 20) {
                row.querySelectorAll('td')[row.querySelectorAll('td').length - 1].textContent = "Validé";
            } else {
                if (moyen < 10 && '{{ $SESSION }}' === 'Normal')
                    row.querySelectorAll('td')[row.querySelectorAll('td').length - 1].textContent = "Rattrapage";
                else
                    row.querySelectorAll('td')[row.querySelectorAll('td').length - 1].textContent = "Non Validé";
            }

        }




        function getEtat() {
            const thElements = document.getElementsByTagName("tr");
            nb = thElements[1].children.length - 1;
            //console.log(nb);
            for (let i = 1; i < thElements.length; i++) {
                mg = thElements[i].children[4].innerText;
                //console.log(mg);
                if (mg != '') {
                    if (mg >= 10 && mg <= 20)
                        thElements[i].children[nb].textContent = "Validé";
                    else {
                        if (mg < 10 && ('{{ $SESSION }}' === 'Normal' || '{{ $SESSION }}' === 'Normal'))
                            thElements[i].children[nb].textContent = "Rattrapage";
                        else
                            thElements[i].children[nb].textContent = "Non Validé";
                    }
                }
            }
        }




        function getErreur(input) {
            input.removeAttribute("class");
            input.setAttribute("class", "form-control form-control-sm mb-3");
            document.getElementById('save').disabled = false;
            if (input.value.includes(',')) {
                newvalue = replaceCommaWithDot(input.value);
                input.value = newvalue;
            } else
                newvalue = input.value;
            if (newvalue > 20 || newvalue < 0 || isNaN(newvalue)) {
                document.getElementById('erreur').innerText = parseInt(document.getElementById('erreur').innerText) + 1;
                input.removeAttribute("class");
                input.setAttribute("class", "form-control form-control-sm mb-3 is-invalid");
                document.getElementById('save').disabled = true;
            }

        }


        function getValid() {
            let nb = 0;
            let moyen;
            @foreach ($etudiant as $e)
                moyen = document.getElementById(`moyen_{{ $e['id'] }}`);
                if (moyen !== null && parseFloat(moyen.innerText) >= 10 && parseFloat(moyen.innerText) <= 20) {
                    nb++;
                }
            @endforeach
            return nb;
        }



        function getNoValid() {
            let nb = 0;
            let moyen;
            @foreach ($etudiant as $e)
                moyen = document.getElementById(`moyen_{{ $e['id'] }}`);
                if ((moyen !== null && parseFloat(moyen.innerText) > 20) || ('{{ $SESSION }}' === 'Rattrapage' && parseFloat(moyen.innerText) < 10)) {
                    nb++;
                }
            @endforeach
            return nb;
        }


        function getRatt() {
            let nb = 0;
            let moyen;
            @foreach ($etudiant as $e)
                moyen = document.getElementById(`moyen_{{ $e['id'] }}`);
                if (moyen !== null && parseFloat(moyen.innerText) < 10) {
                    nb++;
                }
            @endforeach
            return nb;
        }





        document.addEventListener('DOMContentLoaded', function() {
            nbValide = getValid();
            document.getElementById('valide').innerText = nbValide;
            nbNoValide = getNoValid();
            document.getElementById('noValide').innerText = nbNoValide;
            if ('{{ $SESSION }}' === 'Normal' || '{{ $SESSION }}' === 'Normal') {
                nbRatt = getRatt();
                document.getElementById('ratt').innerText = nbRatt;
            }
            getEtat();

        });
    </script>
@endsection
