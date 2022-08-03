@extends('template.primary')

@section('titre')
    Les réparations
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" title="Nouvelle réparation" href="{{ route('reparation.create') }}"><i class="fa-solid fa-plus"></i></a>
        </div>
    @endcanany
    <h1>Liste des réparations</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Panne</th>
                <th>Montant</th>
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
            @foreach ($reparations as $reparation)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $reparation->code }}</td>
                    <td>{{ $reparation->panne->code }}
                        <a href="{{ route('panne.show', $reparation->panne_id) }}">
                            <i class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i>
                        </a>
                    </td>
                    <td>{{ $reparation->montant }}</td>
                    <td>
                        @if ($reparation->statut == 'R1S')
                            Non validée
                        @elseif ($reparation->statut == 'R1V')
                            Effectuée
                        @endif
                    </td>
                    @can('responsable')
                        @if ($reparation->statut == 'R1S')
                            @php
                                $check = true;
                            @endphp
                            <td><input class="reparation" type="checkbox" value="{{ $reparation->id }}">
                            </td>
                        @else
                            <td>Réparation validée</td>
                        @endif
                    @endcan
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-primary" href="{{ route('reparation.show', $reparation->id) }}"><i
                                    class="fa-solid fa-file-lines"></i></a>
                            <a class="buttonLinksTab btn-success" href="{{ route('reparation.edit', $reparation->id) }}"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" action="{{ route('reparation.destroy', $reparation->id) }}" method="post">
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
            <form action="{{ route('reparation.validation') }}" method="post">
                @csrf
                <div class="container text-center">
                    <input type="hidden" name="reparations[]" id="rep">
                    <input class="btn btn-danger" id="submitVal" value="Valider">
                </div>
            </form>
            <script>
                document.getElementById('submitVal').addEventListener('click', (function() {
                    const reparations = document.getElementsByClassName('reparation');
                    let rep = [];
                    for (let i = 0; i < reparations.length; i++) {
                        if (reparations[i].checked) {
                            rep.push(reparations[i].value);
                        }
                    }
                    document.getElementById('rep').value = rep;
                }))
            </script>
        @endif
    @endcan
@endsection
