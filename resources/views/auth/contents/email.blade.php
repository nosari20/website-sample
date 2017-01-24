@extends('auth.master')
@section('title', 'Informations de connexion')
@section('content')

    <div class="mdl-color--white mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Généralités</h2>
        </div>
        <div class="mdl-card__supporting-text mdl-cell--12-col">
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                <tbody>
                    <tr>
                        <td>Adresse email / Identifiant</td>
                        <td>contact@fourrier-electricite.fr</td>
                    </tr>
                    <tr>
                        <td>Mot de passe</td>
                        <td>mipon2050!mipon</td>
                    </tr>  
                </tbody>
            </table>
        </div>
    </div>


    <div class="mdl-color--white mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Serveur entrant</h2>
        </div>
        <div class="mdl-card__supporting-text mdl-cell--12-col">
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                <thead>
                
                    <th></th>
                    <th>IMAP (mails sur le serveur)</th>
                    <th>POP (mails sur la machine)</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Serveur</td>
                        <td>imap.1and1.fr</td>
                        <td>pop.1and1.fr</td>
                    </tr>
                    <tr>
                        <td>Port</td>
                        <td>993</td>
                        <td>995</td>
                    </tr>
                    <tr>
                        <td>Type de chiffrage/sécurité</td>
                        <td>SSL ou TLS</td>
                        <td>SSL ou TLS</td>
                    </tr>  
                </tbody>
            </table>
        </div>
    </div>


    <div class="mdl-color--white mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Serveur entrant (SMTP)</h2>
        </div>
        <div class="mdl-card__supporting-text mdl-cell--12-col">
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                <tbody>
                    <tr>
                        <td>Serveur</td>
                        <td>auth.smtp.1and1.fr</td>
                    </tr>
                    <tr>
                        <td>Port</td>
                        <td>465</td>
                    </tr>
                    <tr>
                        <td>Type de chiffrage/sécurité</td>
                        <td>SSL ou TLS</td>
                    </tr>  
                </tbody>
            </table>
        </div>
    </div>

@endsection