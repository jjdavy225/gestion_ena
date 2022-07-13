@extends('template.primary')

@section('titre')
    Liste des retours
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" href="{{ route('retour.create') }}"><i class="fa-solid fa-plus"></i></a></a>
        </div>
    @endcanany
    <h1>Liste des retours</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Observation</th>
                <th>Date de retour</th>
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
            @foreach ($retours as $retour)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $retour->code }}</td>
                    <td>{{ $retour->observation }}</td>
                    <td>{{ $retour->date }}</td>
                    <td>
                        @if ($retour->statut == 'R1S')
                            Retour non validé
                        @elseif ($retour->statut == 'R1V')
                            Retour effectué
                        @endif
                    </td>
                    @can('responsable')
                        @if ($retour->statut == 'R1S')
                            @php
                                $check = true;
                            @endphp
                            <td><input class="retour" type="checkbox" value="{{ $retour->id }}"></td>
                        @else
                            <td>Retour validé</td>
                        @endif
                    @endcan
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-primary" href="{{ route('retour.show', $retour->id) }}"><i
                                    class="fa-solid fa-file-lines"></i></a>
                            <a class="buttonLinksTab btn-success" href="{{ route('retour.edit', $retour->id) }}"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" action="{{ route('retour.destroy', $retour->id) }}" method="post">
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
            <form action="{{ route('retour.validation') }}" method="post">
                @csrf
                <div class="container text-center">
                    <input type="hidden" name="retours[]" id="ret">
                    <input class="btn btn-danger" id="submitVal" type="submit" value="Valider">
                </div>
            </form>
            <script>
                document.getElementById('submitVal').addEventListener('click', (function() {
                    const retours = document.getElementsByClassName('retour');
                    let ret = [];
                    for (let i = 0; i < retours.length; i++) {
                        if (retours[i].checked) {
                            ret.push(retours[i].value);
                        }
                    }
                    document.getElementById('ret').value = ret;
                }))
            </script>
        @endif
    @endcan
@endsection
