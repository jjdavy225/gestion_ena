@extends('template.primary')

@section('titre')
    Les affectations
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" title="Nouvelle affectation" href="{{ route('affectation.create') }}"><i class="fa-solid fa-plus"></i></a>
        </div>
    @endcanany
    <h1>Liste des affectations</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Véhicule</th>
                <th>Conducteur principal</th>
                <th>Statut</th>
                @can('responsable')
                    <th>Choix pour validation</th>
                @endcan
                @canany(['agent', 'responsable'])
                    <th></th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @php
                $check = false;
                $i = 1;
            @endphp
            @foreach ($affectations as $affectation)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $affectation->code }}</td>
                    <td>{{ $affectation->vehicule->immatriculation }}
                        <a href="{{ route('vehicule.show', $affectation->vehicule->id) }}">
                            <i class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i>
                        </a>
                    </td>
                    <td>{{ $affectation->conducteur_principal->agent_conducteur->nom.' '.explode(' ',$affectation->conducteur_principal->agent_conducteur->prenom)[0] }}
                        <a href="{{ route('conducteur.show', $affectation->conducteur_principal->id) }}">
                            <i class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i>
                        </a>
                    </td>
                    <td>
                        @if ($affectation->statut == 'A1S')
                            Non validée
                        @elseif ($affectation->statut == 'A1V')
                            Enregistrée
                        @endif
                    </td>
                    @can('responsable')
                        @if ($affectation->statut == 'A1S')
                            @php
                                $check = true;
                            @endphp
                            <td><input class="affectation" type="checkbox" value="{{ $affectation->id }}">
                            </td>
                        @else
                            <td>Affectation validée</td>
                        @endif
                    @endcan
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-primary" href="{{ route('affectation.show', $affectation->id) }}"><i
                                    class="fa-solid fa-file-lines"></i></a>
                            <a class="buttonLinksTab btn-success" href="{{ route('affectation.edit', $affectation->id) }}"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" action="{{ route('affectation.destroy', $affectation->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="buttonLinksTab btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    @endcanany
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('responsable')
        @if ($check)
            <form action="{{ route('affectation.validation') }}" method="post">
                @csrf
                <div class="container text-center">
                    <input type="hidden" name="affectations[]" id="aff">
                    <input class="btn btn-danger" id="submitVal" value="Valider">
                </div>
            </form>
            <script>
                document.getElementById('submitVal').addEventListener('click', (function() {
                    const affectations = document.getElementsByClassName('affectation');
                    let aff = [];
                    for (let i = 0; i < affectations.length; i++) {
                        if (affectations[i].checked) {
                            aff.push(affectations[i].value);
                        }
                    }
                    document.getElementById('aff').value = aff;
                }))
            </script>
        @endif
    @endcan
@endsection
