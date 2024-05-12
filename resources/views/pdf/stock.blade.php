<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <title>
    </title>
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/vendors/bootstrap.css') }}">
    <style>
        body {
            line-height: 108%;
            font-family: Calibri;
            font-size: 11pt
        }

        p {
            margin: 0pt 0pt 8pt
        }

        li {
            margin-top: 0pt;
            margin-bottom: 8pt
        }

        .BalloonText {
            margin-bottom: 0pt;
            line-height: normal;
            font-family: 'Segoe UI';
            font-size: 9pt
        }

        .Footer {
            margin-bottom: 0pt;
            line-height: normal;
            font-size: 11pt
        }

        .Header {
            margin-bottom: 0pt;
            line-height: normal;
            font-size: 11pt
        }

        .NoSpacing {
            margin-bottom: 0pt;
            line-height: normal;
            font-family: Calibri;
            font-size: 11pt
        }

        span.TextedebullesCar {
            font-family: 'Segoe UI';
            font-size: 9pt
        }

        .en-tete {
            width: 100%;
            display: inline-block;
        }

        .name,
        .blason {
            width: 50%;
        }
    </style>
</head>

<body>
    <div class="en-tete" style="width: 100%; display:inline-block;">
        <div class="name" style="width: 35%; text-align:right;  position:absolute; display:inline-block;  z-index:-1;">
            <p style="text-align: center; font-size:12px;">
                MINISTERE DU COMMERCE, DES PETITES <br>
                ET MOYENNES ENTREPRISES<br>
                -------------------<br>
                SECRETARIAT GENERAL<br>
                -------------------<br>
                DIRECTION GENERALE DU COMMERCE<br>
                -------------------<br>
                DIRECTION DU COMMERCE INTERIEUR<br>
                --------------------<br>
                <strong>SERVICE DE LA PRODUCTION COMMERCIALE<br>
                    ET RELATIONS AVEC LES ENTREPRISES</strong>
            </p>
        </div>
        <div class="blason" style="width: 60%; display:inline-block;">
            <span style="height:0pt; text-align:left; display:block; position:absolute; z-index:-1"><img
                    src="{{ asset('admin/images/image001.jpg') }}" width="118" height="75" alt="RG"
                    style="margin-top:3.7pt; margin-left:427.15pt; position:absolute" /></span>
        </div>
    </div>
    <div class="title" style="width: 100%; text-align:center; margin-top:200px;">
        <div style="">
            <h1
                style="width: 40%; margin: auto; font-size:18px; border: 1px solid #0169b4; background-color: #0070c0; color:white; padding:15px; border-radius:10px">
                DECLARATION DE STOCK</h1>
        </div>
        <p style="font-family:'Bookman Old Style'; font-size:10px;">(Loi 1/77 du 04 juin 1977 règlementant les stocks en
            République Gabonaise)</p>
    </div>

    <div class="stock-info" style="font-family:'Bookman Old Style';">
        <p>Entreprise : <strong>{{ $stock->entreprise->company_name }}</strong></p>
        <p>Service/Département : <strong>{{ $stock->service }}</strong></p>
        <p>Nom du Référent Stocks : <strong>{{ $stock->referent }}</strong> Contact :
            <strong>{{ $stock->referent_contact }}</strong>
        </p>
    </div>

    <div class="entreprise-info" style="font-family:'Bookman Old Style'; margin-top:15px;">
        <h2 style="font-family:'Bookman Old Style'; font-size:16px; text-align:center;">IDENTIFICATION DE L’OPERATEUR
            ECONOMIQUE</h2>
        <br>
        <p>RAISON SOCIALE : <strong>{{ $stock->entreprise->company_name }}</strong> </p>
        <p>NATURE DE L’ACTIVITE : <strong>{{ $stock->activity ?? $stock->entreprise->activity->name }}</strong> </p>
        <p>COMMUNE/ARRONDISSEMENT : <strong>{{ $stock->entreprise->commune }}</strong> QUARTIER :
            <strong>{{ $stock->entreprise->hood }}</strong>
        </p>
        <p>BP : <strong>{{ $stock->entreprise->postal_code }}</strong> TELEPHONE :
            <strong>{{ $stock->entreprise->phone }}</strong>
        </p>
        <p>FICHE CIRCUIT : <strong>{{ $stock->entreprise->business_circuit }}</strong> CARTE DE COMMERÇANT :
            <strong>{{ $stock->entreprise->number_commercant }}</strong>
        </p>
        <p>RCCM : <strong>{{ $stock->entreprise->rccm }}</strong> NIF : <strong>{{ $stock->entreprise->nif }}</strong>
            DATE DE CRÉATION : <strong>{{ $stock->entreprise->date_create }}</strong></p>
        <p>FORME JURIDIQUE : <strong>{{ $stock->entreprise->legal_status }}</strong> </p>
    </div>

    <div class="stock-info-2" style="font-family:'Bookman Old Style'; margin-top:35px;">
        <h3 style="font-family:'Bookman Old Style'; font-size:14px; text-decoration:underline;">NATURE DE L’ACTIVITE :
        </h3>
        <br>
        <ul style="list-style-type: none; padding: 0; margin: 0;">
            @foreach ($activities_st as $activity)
                <li style="display: inline-block; margin-right: 10px;">{{ $activity->name }} @if ($activity->id == $stock->activity->id)
                        <img src="{{ asset('admin/images/image2.png') }}" alt="">
                    @else
                        <img src="{{ asset('admin/images/image1.png') }}" alt="">
                    @endif
                </li>
            @endforeach
        </ul>

        <br><br>
        <h3 style="font-family:'Bookman Old Style'; font-size:14px; text-decoration:underline;">TYPE DE DECLARATION :
        </h3>
        <br>
        <ul style="list-style-type: none; padding: 0; margin: 0;">
            @foreach ($declarations as $declaration)
                <li style="display: inline-block; margin-right: 10px;">{{ $declaration->name }} @if ($declaration->id == $stock->type_declaration->id)
                        <img src="{{ asset('admin/images/image2.png') }}" alt="">
                    @else
                        <img src="{{ asset('admin/images/image1.png') }}" alt="">
                    @endif
                </li>
            @endforeach
        </ul>

        <br><br>
        <h3 style="font-family:'Bookman Old Style'; font-size:14px; text-decoration:underline;">TYPE DE PRODUITS :</h3>
        <br>
        <ul style="list-style-type: none; padding: 0; margin: 0;">
            @foreach ($products as $product)
                <li style="display: inline-block; margin-right: 10px;">{{ $product->name }} @if ($product->id == $stock->type_product->id)
                        <img src="{{ asset('admin/images/image2.png') }}" alt="">
                    @else
                        <img src="{{ asset('admin/images/image1.png') }}" alt="">
                    @endif
                </li>
            @endforeach
        </ul>

        <br><br><br><br>
        <h3 style="font-family:'Bookman Old Style'; font-size:14px; text-decoration:underline;">REGIONS APPROVISIONNEES
            :</h3>
        <br>
        <p>Province : <strong>{{ $stock->province }}</strong> Ville(s) : <strong>{{ $stock->ville }}</strong> </p>

        <br><br><br>
        <h3 style="font-family:'Bookman Old Style'; font-size:14px; text-decoration:underline;">MOYENS LOGISTIQUES
            UTILISES :</h3>
        <br>
        <ul style="list-style-type: none; padding: 0; margin: 0;">
            @foreach ($logistics as $logistic)
                <li style="display: inline-block; margin-right: 10px;">{{ $logistic->name }} @if ($logistic->id == $stock->logistic->id)
                        <img src="{{ asset('admin/images/image2.png') }}" alt="">
                    @else
                        <img src="{{ asset('admin/images/image1.png') }}" alt="">
                    @endif
                </li>
            @endforeach
        </ul>

        <br><br>
        <h3 style="font-family:'Bookman Old Style'; font-size:14px; text-decoration:underline;">DONNEES SUR LES STOCKS :
        </h3>
        <br>
        <p style="font-family:'Bookman Old Style'; text-decoration:underline;"><strong>CF. page 2. Annexe.</strong></p>
        <br>
        <p>Utiliser 1 ligne par produit. Si nécessaire joindre un feuillet complémentaire.</p>
    </div>
    <div class="pied" style="font-family:'Bookman Old Style'; margin-top:35px;">
        <div class="administration" style="margin-bottom:25px;">
            <p>Date et Signature de l’opérateur économique </p>
            <br><br><br><br>
            <h3 style="font-family:'Bookman Old Style'; font-size:15px; text-align:center;">CADRE RESERVE A
                L’ADMINISTRATION</h3>
            <div style="height:150px; border: 2px solid black; margin-top:15px;">

            </div>
        </div>
        <div class="visa" style="width: 100%; display:inline-block; margin-top:25px;">
            <div class="cspre" style="width: 45%; text-align:left; display:inline-block;">
                <h4>Visa CSPCRE</h4>
                <br><br><br>
                <p>BMB</p>
            </div>
            <div class="dci" style="width: 50%; text-align:right; display:inline-block;">
                <h4>Visa DCI</h4>
                <br><br><br>
                <p>DCI</p>
            </div>
        </div>
    </div>
</body>

</html>
