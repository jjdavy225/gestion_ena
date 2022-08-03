@extends('template.primary')

@section('titre')
    Les demandes de véhicule
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" title="Nouvelle demande de véhicule" href="{{ route('demande_vehicule.create') }}"><i
                    class="fa-solid fa-plus"></i></a>
        </div>
    @endcanany
    <h1>Liste des demandes de véhicule</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Conducteur</th>
                <th>Date de sortie</th>
                <th>Statut</th>
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
            <script>
                let kilometrages = {}
            </script>
            @foreach ($demandeVehicules as $demandeVehicule)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $demandeVehicule->code }}</td>
                    <td>{{ $demandeVehicule->conducteur->agent_conducteur->nom . ' ' . explode(' ', $demandeVehicule->conducteur->agent_conducteur->prenom)[0] }}
                        <a href="{{ route('conducteur.show', $demandeVehicule->conducteur->id) }}">
                            <i class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i>
                        </a>
                    </td>
                    <td>{{ $demandeVehicule->date_sortie }}</td>
                    <td>
                        @if ($demandeVehicule->statut == 'D1S')
                            Non validée
                        @elseif ($demandeVehicule->statut == 'D1V')
                            Demande validée
                        @elseif ($demandeVehicule->statut == 'D1R')
                            Sortie éffectuée
                        @endif
                    </td>
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            @can('responsable')
                                @if ($demandeVehicule->statut == 'D1S')
                                    @php
                                        $check = true;
                                    @endphp
                                    <button type="button" value="{{ $demandeVehicule->id }}" title="Valider la demande"
                                        class="buttonVal buttonLinksTab btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#validation">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                @elseif ($demandeVehicule->statut == 'D1V')
                                    @php
                                        $check = true;
                                    @endphp
                                    <button type="button" value="{{ $demandeVehicule->id }}" title="Faire le retour"
                                        class="buttonRet buttonLinksTab btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#retour">
                                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                    </button>
                                    <script>
                                        kilometrages['{{ $demandeVehicule->id }}'] = '{{ $demandeVehicule->kilometrage_depart }}'
                                    </script>
                                @endif
                            @endcan
                            <a class="buttonLinksTab btn-primary"
                                href="{{ route('demande_vehicule.show', $demandeVehicule->id) }}"><i
                                    class="fa-solid fa-file-lines"></i></a>
                            <a class="buttonLinksTab btn-success"
                                href="{{ route('demande_vehicule.edit', $demandeVehicule->id) }}"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" action="{{ route('demande_vehicule.destroy', $demandeVehicule->id) }}"
                                method="post">
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
            <div class="modal fade" id="validation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="staticBackdropLabel">Choisissez un véhicule pour valider
                                cette demande</h5>
                            <button type="button" id="btn_close" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('demande_vehicule.validation') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <select id="vehicule" required class="form-select @error('vehicule') is-invalid @enderror"
                                        name="vehicule">
                                        <option value="">Choisissez le véhicule</option>
                                        @foreach (App\Models\Vehicule::where('dispo', 1)->get() as $vehicule)
                                            <option value="{{ $vehicule->id }}"
                                                @if ($vehicule->id == old('vehicule')) {{ 'selected' }} @endif>
                                                {{ $vehicule->modele->designation }}
                                                {{ $vehicule->marque_vehicule->designation }}
                                                N° {{ $vehicule->immatriculation }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('vehicule')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="demande" id="demande">

                                <div class="boutons">
                                    <input type="submit" value="Valider">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="retour" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="staticBackdropLabel">Renseigner le retour du véhicule</h5>
                            <button type="button" id="btn_close" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('demande_vehicule.retour') }}" method="post">
                                @csrf
                                <h3 class="text-center"></h3>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="kilometrage_retour">Kilométrage retour <span class="text-danger"> *</span></label>
                                    <input required class="form-control @error('kilometrage_retour') is-invalid @enderror" type="number"
                                        name="kilometrage_retour" id="kilometrage_retour" value="{{ old('kilometrage_retour') }}">
                                    <div class="invalid-feedback">
                                        @error('kilometrage_retour')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="demande" id="demande">

                                <div class="text-secondary text-center small mb-3">
                                    Les champs avec un (<span class="text-danger">*</span>) sont obligatoires
                                </div>

                                <div class="boutons">
                                    <input type="submit" value="Valider">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script src="{{ asset('js/app1.js') }}"></script>
        @endif
    @endcan
@endsection
