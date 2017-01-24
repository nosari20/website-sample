@extends('master')
@section('title', 'Informations légales')
@section('content')
<section class="content">
    <div class="container">

        <h1>Informations légales</h1>

        <div class="row">

            <div class="col-md-12">
                <table class="table table-striped" style="text-align: left;">
                    <tbody>
                        <tr>
                            <td>Dénomination</td>
                            <td>SARL FOURRIER ELECTRICITE</td>
                        </tr>
                        <tr>
                            <td>Forme juridique</td>
                            <td>Société à responsabilité limitée</td>
                        </tr>
                        <tr>
                            <td>Adresse</td>
                            <td>{{$info->address}}</td>
                        </tr>
                        <tr>
                            <td>Capital social</td>
                            <td>1 500,00 €</td>
                        </tr>
                        <tr>
                            <td>Adresse de courrier électronique</td>
                            <td>{{$info->email}}</td>
                        </tr>
                        <tr>
                            <td>Téléphone</td>
                            <td>{{$info->phone}}</td>
                        </tr>
                        <tr>
                            <td>SIREN</td>
                            <td>485 056 956</td>
                        </tr>
                        <tr>
                            <td>SIRET (siege)</td>
                            <td>48505695600017</td>
                        </tr>
                        <tr>
                            <td>Activité (Code NAF ou APE)</td>
                            <td>Conception d'ensemble et assemblage sur site industriel d'équipements de contrôle des processus industriels (3320C)</td>
                        </tr>                        
                        <tr>
                            <td>Date immatriculation RCS</td>
                            <td>29-11-2005</td>
                        </tr>
                        <tr>
                            <td>Responsable de publication</td>
                            <td>Fabrice FOURRIER</td>
                        </tr>
                        <tr>
                            <td>Hébergeur</td>
                            <td>
                                1&amp;1 Internet SARL FRANCE<br>
                                7, place de la Gare<br>
                                57200 SARREGUEMINES
                            </td>
                        </tr>  


                    </tbody>
                </table>

            </div>

        </div>
       

    </div>
</section>
@endsection