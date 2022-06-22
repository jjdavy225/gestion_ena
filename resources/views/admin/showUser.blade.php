@extends('template.dashboard')

@section('titre')
    Utilisateur {{ $user->agent->nom }}
@endsection

@section('contenu')
    <h1>Informations utilisateur</h1>
    <div class="infoUserContainer">
        <table class="table table-bordered">
            <tr>
                <th>Nom</th>
                <td>{{ $user->agent->nom }}</td>
            </tr>
            <tr>
                <th>Prénoms</th>
                <td>{{ $user->agent->prenom }}</td>
            </tr>
            <tr>
                <th>Matricule</th>
                <td>{{ $user->agent->matricule }}</td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td>{{ $user->agent->tel }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Rôle</th>
                <td>
                    @if ($user->role_id == null)
                        Aucun
                    @else
                        {{ $user->role->designation }}
                    @endif
                </td>
            </tr>
        </table>
    </div>
@endsection
