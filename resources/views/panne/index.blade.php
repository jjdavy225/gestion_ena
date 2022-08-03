@extends('template.primary')

@section('titre')
    Les pannes
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" title="Nouvelle panne" href="{{ route('panne.create') }}"><i class="fa-solid fa-plus"></i></a>
        </div>
    @endcanany
    <h1>Liste des pannes</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Véhicule</th>
                <th>Dégâts</th>
                <th>Réparé</th>
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
            @foreach ($pannes as $panne)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $panne->code }}</td>
                    <td>{{ $panne->vehicule->immatriculation }}
                        <a href="{{ route('vehicule.show', $panne->vehicule->id) }}">
                            <i class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i>
                        </a>
                    </td>
                    <td>{{ $panne->degats }}</td>
                    <td>
                        @if ($panne->repare)
                            <i class="fa-solid fa-check text-success"></i>
                        @else
                            <i class="fa-solid fa-xmark text-danger"></i>
                        @endif
                    </td>
                    <td>
                        @if ($panne->statut == 'P1S')
                            Non validée
                        @elseif ($panne->statut == 'P1V')
                            Enregistrée
                        @endif
                    </td>
                    @can('responsable')
                        @if ($panne->statut == 'P1S')
                            @php
                                $check = true;
                            @endphp
                            <td><input class="panne" type="checkbox" value="{{ $panne->id }}">
                            </td>
                        @else
                            <td>Panne validée</td>
                        @endif
                    @endcan
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-primary" href="{{ route('panne.show', $panne->id) }}"><i
                                    class="fa-solid fa-file-lines"></i></a>
                            <a class="buttonLinksTab btn-success" href="{{ route('panne.edit', $panne->id) }}"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" action="{{ route('panne.destroy', $panne->id) }}" method="post">
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
            <form action="{{ route('panne.validation') }}" method="post">
                @csrf
                <div class="container text-center">
                    <input type="hidden" name="pannes[]" id="pan">
                    <input class="btn btn-danger" id="submitVal" value="Valider">
                </div>
            </form>
            <script>
                document.getElementById('submitVal').addEventListener('click', (function() {
                    const pannes = document.getElementsByClassName('panne');
                    let pan = [];
                    for (let i = 0; i < pannes.length; i++) {
                        if (pannes[i].checked) {
                            pan.push(pannes[i].value);
                        }
                    }
                    document.getElementById('pan').value = pan;
                }))
            </script>
        @endif
    @endcan
@endsection
