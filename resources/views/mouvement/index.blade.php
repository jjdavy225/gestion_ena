@extends('template.primary')

@section('titre')
    Liste des mouvements
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" href="{{ route('mouvement.create') }}"><i class="fa-solid fa-plus"></i></a>
        </div>
    @endcanany
    <h1>Liste des mouvements</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Observation</th>
                <th>Date du mouvement</th>
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
            @foreach ($mouvements as $mouvement)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $mouvement->code }}</td>
                    <td>{{ $mouvement->observation }}</td>
                    <td>{{ $mouvement->date }}</td>
                    <td>
                        @if ($mouvement->statut == 'M1S')
                            Mouvement non validé
                        @elseif ($mouvement->statut == 'M1V')
                            Mouvement effectué
                        @endif
                    </td>
                    @can('responsable')
                        @if ($mouvement->statut == 'M1S')
                            @php
                                $check = true;
                            @endphp
                            <td><input class="mouvement" type="checkbox" value="{{ $mouvement->id }}"></td>
                        @else
                            <td>Mouvement validé</td>
                        @endif
                    @endcan
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-primary" href="{{ route('mouvement.show', $mouvement->id) }}"><i
                                    class="fa-solid fa-file-lines"></i></a>
                            <a class="buttonLinksTab btn-success" href="{{ route('mouvement.edit', $mouvement->id) }}"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" action="{{ route('mouvement.destroy', $mouvement->id) }}" method="post">
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
            <form action="{{ route('mouvement.validation') }}" method="post">
                @csrf
                <div class="container text-center">
                    <input type="hidden" name="mouvements[]" id="mou">
                    <input class="btn btn-danger" id="submitVal" value="Valider">
                </div>
            </form>
            <script>
                document.getElementById('submitVal').addEventListener('click', (function() {
                    const mouvements = document.getElementsByClassName('mouvement');
                    let mou = [];
                    for (let i = 0; i < mouvements.length; i++) {
                        if (mouvements[i].checked) {
                            mou.push(mouvements[i].value);
                        }
                    }
                    document.getElementById('mou').value = mou;
                }))
            </script>
        @endif
    @endcan
@endsection
