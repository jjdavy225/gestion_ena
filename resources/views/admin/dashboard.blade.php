@extends('template.dashboard')

@section('titre')
    Tableau de bord
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @elseif(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    <h1>La liste des utilisateurs</h1>
    <div class="container">
        <table class="table table-success table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th></th>
                </tr>
            </thead>
            <script>
                let user = {}
            </script>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->agent->matricule }}</td>
                        <td>{{ $user->agent->nom }}</td>
                        <td>{{ $user->agent->prenom }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->role_id == null)
                                Aucun
                                <script>
                                    user['{{ $user->id }}'] = ['{{ $user->agent->nom }} {{ $user->agent->prenom }}',
                                        '{{ $user->agent->matricule }}', '{{ $user->email }}'
                                    ]
                                </script>
                            @else
                                {{ $user->role->designation }}
                                <script>
                                    user['{{ $user->id }}'] = ['{{ $user->agent->nom }} {{ $user->agent->prenom }}',
                                        '{{ $user->agent->matricule }}', '{{ $user->email }}',
                                        '{{ $user->role->designation }}'
                                    ]
                                </script>
                            @endif
                        </td>
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab" href="{{ route('user.show', $user->id) }}">Voir</a>
                            @if ($user->role_id == null)
                                <button type="button" class="user_id_att buttonLinksTab" value="{{ $user->id }}"
                                    data-bs-toggle="modal" data-bs-target="#formAttribution">
                                    Attribuer un rôle
                                </button>
                            @else
                                <button type="button" class="user_id_mod buttonLinksTab" value="{{ $user->id }}"
                                    data-bs-toggle="modal" data-bs-target="#formModification">
                                    Modifier un rôle
                                </button>
                            @endif
                            {{-- <a class="buttonLinksTab" href="{{ route('user.edit', $user->id) }}">Modifier</a>
                                <a class="buttonLinksTab" href="{{ route('user.destroy', $user->id) }}">Supprimer</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Formulaire attribution d'un rôle -->
        <div class="modal fade" id="formAttribution" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Attribution de rôle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.role_att') }}" method="post">
                            @csrf
                            <div>
                                <table class="table table-bordered" id="tabAttribution">
                                    <tr>
                                        <th>Nom et prénoms</th>
                                        <td id="nomUser_att"></td>
                                    </tr>
                                    <tr>
                                        <th>Matricule</th>
                                        <td id="matriculeUser_att"></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td id="emailUser_att"></td>
                                    </tr>
                                </table>
                            </div>
                            <input type="hidden" name="user" id="userHidden_att">
                            <div class="form-group mb-3">
                                <label class="form-label">Rôle</label>
                                <select class="form-select" name="role" required>
                                    <option disabled selected>Choisissez un rôle</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->designation }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="tabButtonContainer_c">
                                <input class="buttonLinksTab" type="submit" value="Attribuer">
                            </div>
                        </form>
                        <script>
                            let buttons = document.getElementsByClassName('user_id_att');
                            let user_id_att = 0
                            for (var i = 0; i < buttons.length; i++) {
                                buttons[i].addEventListener('click', (function() {
                                    var user_id_att = this.value;
                                    document.getElementById('nomUser_att').innerHTML = user[user_id_att][0];
                                    document.getElementById('matriculeUser_att').innerHTML = user[user_id_att][1];
                                    document.getElementById('emailUser_att').innerHTML = user[user_id_att][2];
                                    document.getElementById('userHidden_att').value = user_id_att;
                                }));
                            }
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="buttonLinksTab" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin formulaire attribution d'un rôle -->

        <!-- Formulaire modification d'un rôle -->
        <div class="modal fade" id="formModification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modification du rôle</h5>
                        <button type="button" id="btn_close" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.role_modif') }}" method="post">
                            @csrf
                            <div>
                                <table class="table table-bordered" id="tabAttribution">
                                    <tr>
                                        <th>Nom et prénoms</th>
                                        <td id="nomUser"></td>
                                    </tr>
                                    <tr>
                                        <th>Matricule</th>
                                        <td id="matriculeUser"></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td id="emailUser"></td>
                                    </tr>
                                    <tr>
                                        <th>Rôle</th>
                                        <td id="roleUser"></td>
                                    </tr>
                                </table>
                            </div>
                            <input type="hidden" name="user" id="userHidden">
                            <div class="form-group mb-3">
                                <label class="form-label">Rôle</label>
                                <select class="form-select" name="role" required>
                                    <option disabled selected>Choisissez un rôle</option>
                                    @foreach ($roles as $role)
                                        <option id="{{ $role->designation }}" value="{{ $role->id }}">
                                            {{ $role->designation }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="tabButtonContainer_c">
                                <input class="buttonLinksTab" type="submit" value="Attribuer">
                            </div>
                        </form>
                        <script>
                            let buttons_mod = document.getElementsByClassName('user_id_mod');
                            let user_id_mod = 0
                            for (var i = 0; i < buttons_mod.length; i++) {
                                buttons_mod[i].addEventListener('click', (function() {
                                    var user_id_mod = this.value;
                                    document.getElementById('nomUser').innerHTML = user[user_id_mod][0];
                                    document.getElementById('matriculeUser').innerHTML = user[user_id_mod][1];
                                    document.getElementById('emailUser').innerHTML = user[user_id_mod][2];
                                    document.getElementById('roleUser').innerHTML = user[user_id_mod][3];
                                    document.getElementById('userHidden').value = user_id_mod;
                                    document.getElementById(user[user_id_mod][3]).disabled = true
                                    document.getElementById('btn_close').addEventListener('click', (function() {
                                        document.getElementById(user[user_id_mod][3]).disabled = false
                                    }))
                                }));
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin formulaire modification d'un rôle -->


    </div>
@endsection
