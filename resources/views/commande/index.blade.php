@extends('template.primary')

@section('titre')
    Liste des commandes
@endsection

{{-- @section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection --}}

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    <div class="linksContainer">
        @canany(['agent', 'responsable'])
            <a class="buttonLinks" href="{{ route('commande.create') }}"><i class="fa-solid fa-plus"></i></a>
            <a class="buttonLinks" href="{{ route('livraison.create') }}"><i class="fa-solid fa-cart-plus"></i></a>
        @endcanany
    </div>
    <h1>Liste des commandes</h1>
    <div class="container">
        <table class="table table-success table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Objet</th>
                    <th>Statut de livraison</th>
                    @can('responsable')
                        <th>Choix pour validation</th>
                    @endcan
                    @canany(['agent', 'responsable'])
                        <th></th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @php
                    $check = false;
                @endphp
                @foreach ($commandes as $commande)
                    <tr>
                        <td>{{ $commande->id }}</td>
                        <td>{{ $commande->num }}</td>
                        <td>{{ $commande->objet }}</td>
                        <td>
                            @if ($commande->statut_liv == 'C1S')
                                Commande non validée
                            @elseif ($commande->statut_liv == 'C1V')
                                Non livrée
                            @elseif ($commande->statut_liv == 'C1P')
                                Partielle
                            @elseif ($commande->statut_liv == 'C1T')
                                Totale
                            @endif
                        </td>
                        @can('responsable')
                            @if ($commande->statut_liv == 'C1S')
                                @php
                                    $check = true;
                                @endphp
                                <td><input class="commande" type="checkbox" value="{{ $commande->id }}">
                                </td>
                            @else
                                <td>Commande validée</td>
                            @endif
                        @endcan
                        @canany(['agent', 'responsable'])
                            <td class="tabButtonContainer">
                                <a class="buttonLinksTab" href="{{ route('commande.show', $commande->id) }}"><i
                                        class="fa-solid fa-file-lines"></i></a>
                                <a class="buttonLinksTab" href="{{ route('commande.edit', $commande->id) }}"><i
                                        class="fa-solid fa-file-pen"></i></a>
                                <form class="delete" onsubmit="return confirm('Do you really want to submit the form ?');"
                                    action="{{ route('commande.destroy', $commande->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="buttonLinksTab"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
        @can('responsable')
            @if ($check)
                <form action="{{ route('commande.validation') }}" method="post">
                    @csrf
                    <div class="container text-center">
                        <input type="hidden" name="commandes[]" id="com">
                        <input class="btn btn-dark" id="submit" type="submit" value="Valider">
                    </div>
                </form>
                <script>
                    document.getElementById('submit').addEventListener('click', (function() {
                        const commandes = document.getElementsByClassName('commande');
                        let com = [];
                        for (let i = 0; i < commandes.length; i++) {
                            if (commandes[i].checked) {
                                com.push(commandes[i].value);
                            }
                        }
                        document.getElementById('com').value = com;
                    }))
                </script>
            @endif
        @endcan
    </div>
@endsection
