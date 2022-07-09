@extends('template.primary')

@section('titre')
    {{ $fournisseur->code }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="tableShowContainer">
        <div>
            <h1>Infos</h1>
            <table class="table table-bordered">
                <tr>
                    <th>Code du fournisseur</th>
                    <td>{{ $fournisseur->code }}</td>
                </tr>
                <tr>
                    <th>Sigle du fournisseur</th>
                    <td>{{ $fournisseur->sigle }}</td>
                </tr>
                <tr>
                    <th>Siège</th>
                    <td>{{ $fournisseur->siege }}</td>
                </tr>
                <tr>
                    <th>Adresse</th>
                    <td>{{ $fournisseur->adresse }}</td>
                </tr>
                <tr>
                    <th>Téléphone du fournisseur</th>
                    <td>{{ $fournisseur->tel }}/{{ $fournisseur->fax }}</td>
                </tr>
                <tr>
                    <th>Email du fournisseur</th>
                    <td>{{ $fournisseur->email }}</td>
                </tr>
                <tr>
                    <th>Site Web</th>
                    <td>{{ $fournisseur->site_web }}</td>
                </tr>
                <tr>
                    <th>Compte Banque</th>
                    <td>N°{{ $fournisseur->compte }} | {{ $fournisseur->banque }}</td>
                </tr>
            </table>
        </div>
    @endsection
