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
            font-size: 11pt
        }

        .watermark {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: url('{{ asset('front/images/dgc_wb.png') }}') no-repeat center;
            background-size: contain;
            opacity: 0.1;
            /* Adjust the opacity as needed */
        }

        .content {
            position: relative;
            z-index: 1;
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
    <div class="watermark"></div>
    <div class="content">
        <div class="en-tete" style="width: 100%; display:inline-block;">
            <div class="name"
                style="width: 39%; text-align:right;  position:absolute; display:inline-block;  z-index:-1;">
                <p style="text-align: center; font-size:10px;line-height:10px">
                    MINISTERE DU COMMERCE, DES PETITES ET MOYENNES <br>
                    ENTREPRISES, PETITES ET MOYENNES INDUSTRIES,<br>
                    CHARGE DES ACTIVITES GENERATRICES DE REVENUS <br>
                    -------------------<br>
                    SECRETARIAT GENERAL<br>
                    -------------------<br>
                    DIRECTION GENERALE DU COMMERCE<br>
                    -------------------<br>
                    DIRECTION DU COMMERCE INTERIEUR<br>
                    --------------------<br>
                    <strong>SERVICE PRODUCTION COMMERCIALE <br>
                        ET RELATIONS AVEC LES ENTREPRISES</strong>
                </p>
            </div>
            <div class="blason" style="width: 60%; display:inline-block;">
                <span style="height:0pt; text-align:left; display:block; position:absolute; z-index:-1"><img
                        src="{{ asset('admin/images/image001.jpg') }}" width="118" height="75" alt="RG"
                        style="margin-top:3.7pt; margin-left:427.15pt; position:absolute" /></span>
            </div>
        </div>
        <div class="title" style="width: 100%; text-align:center; margin-top:120px;">
            <div style="">
                <h1
                    style="width: 60%; margin: auto; font-size:20px; border: 1px solid #FFB42B; background-color: #002153; color:white; padding:15px; border-radius:10px">
                    DECLARATION DE STOCK</h1>
            </div>
            <br>
            <p style="font-family:'Bookman Old Style'; font-size:12px;">N°…………………………./20</p>
            <p style="font-family:'Bookman Old Style'; font-size:13px;">(Loi 1/77 du 04 juin 1977 règlementant les
                stocks en
                République Gabonaise)</p>
        </div>
        <br>
        <div class="stock-info" style="font-family:'Bookman Old Style'; font-size:13px;">
            <p style="margin-bottom:4px"><strong>NOM DU REFERENT STOCKS :</strong> {{ $stock->referent }}</p>
            <p><strong>Téléphone :</strong> {{ $stock->referent_contact }}</p>
        </div>

        <div class="entreprise-info" style="font-family:'Bookman Old Style'; margin-top:5px;">
            <h2 style="font-family:'Bookman Old Style'; font-size:16px; text-align:center;">IDENTIFICATION DE
                L’OPERATEUR ECONOMIQUE</h2>
            <br>
            <p> <strong>RAISON SOCIALE :</strong>{{ $stock->entreprise->company_name }} </p>
            <p> <strong>NATURE DE L’ACTIVITE :</strong>
                {{ $stock->entreprise->activity == null ? $stock->entreprise->activity_ent->name : $stock->activity }}
            </p>
            <p> <strong>COMMUNE/ARRONDISSEMENT :</strong> {{ $stock->entreprise->commune }} <strong>QUARTIER :</strong>
                {{ $stock->entreprise->hood }}
            </p>
            <p> <strong>BP :</strong> {{ $stock->entreprise->postal_code }} <strong>TELEPHONE :</strong>
                {{ $stock->entreprise->phone }}
            </p>
            <p> <strong>FICHE CIRCUIT :</strong> {{ $stock->entreprise->business_circuit }}
                <strong>CARTE DE COMMERÇANT :</strong>
                {{ $stock->entreprise->number_commercant }}
            </p>
            <p> <strong>AGREMENT DE COMMERCE :</strong> {{ $stock->entreprise->number_agrement }}
            </p>
            <p> <strong>RCCM :</strong> {{ $stock->entreprise->rccm }} <strong>NIF :</strong>
                {{ $stock->entreprise->nif }}
                <strong>DATE DE CRÉATION :</strong> {{ $stock->entreprise->date_create }}
            </p>
            <p> <strong>FORME JURIDIQUE :</strong> {{ $stock->entreprise->legal_status }} </p>
        </div>

        <div class="stock-info-2" style="font-family:'Bookman Old Style'; margin-top:25px;">
            <h3 style="font-family:'Bookman Old Style'; font-size:16px; text-align: center;">NATURE DE L’ACTIVITE
                :
            </h3>
            <br>
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                @foreach ($activities_st as $activity)
                    <li style="display: inline-block; margin-right: 10px;">{{ $activity->name }} @if ($activity->id == $stock->activity_st->id)
                            <img src="{{ asset('admin/images/image2.png') }}" alt="">
                        @else
                            <img src="{{ asset('admin/images/image1.png') }}" alt="">
                        @endif
                    </li>
                @endforeach
            </ul>

            <br><br>
            <h3 style="font-family:'Bookman Old Style'; font-size:16px; text-align: center;">TYPE DE DECLARATION
                :
            </h3>
            <br>
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                @foreach ($declarations as $declaration)
                    <li style="display: inline-block; margin-right: 10px;">{{ $declaration->name }} @if ($declaration->id == $stock->type_declaration_st->id)
                            <img src="{{ asset('admin/images/image2.png') }}" alt="">
                        @else
                            <img src="{{ asset('admin/images/image1.png') }}" alt="">
                        @endif
                    </li>
                @endforeach

            </ul>

            <br><br>
            <h3 style="font-family:'Bookman Old Style'; font-size:16px; text-align: center;">TYPE DE PRODUITS :
            </h3>
            <br>
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                @foreach ($products as $product)
                    <li style="display: inline-block; margin-right: 10px;">{{ $product->name }} @if ($product->id == $stock->type_product_st->id)
                            <img src="{{ asset('admin/images/image2.png') }}" alt="">
                        @else
                            <img src="{{ asset('admin/images/image1.png') }}" alt="">
                        @endif
                    </li>
                @endforeach
                @if ($stock->type_product != null)
                    <li style="display: inline-block; margin-right: 10px; text-align: center;"> Autres (Précisez) :
                        ({{ $stock->type_product }})
                    </li>
                @else
                    <li style="display: inline-block; margin-right: 10px; text-align: center;"> Autres (Précisez)
                        :…………………………………………………….
                    </li>
                @endif
            </ul>

            <h3 style="font-family:'Bookman Old Style'; font-size:16px; text-align: center;">REGIONS
                APPROVISIONNEES
                :</h3>
            <br>
            <p style="text-align:center;">Province(s) : <strong>{{ $stock->province }}</strong>
                &#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;Ville(s)
                :
                <strong>{{ $stock->ville }}</strong>
            </p>
            <p style="text-align:center;">Commune : <strong>{{ $stock->commune }}</strong>
                &#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;
                Département :
                <strong>{{ $stock->departement }}</strong>
            </p>

            <h3 style="font-family:'Bookman Old Style'; font-size:16px; text-align: center;">MOYENS LOGISTIQUES
                UTILISES :</h3>
            <br>
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                @foreach ($logistics as $logistic)
                    <li style="display: inline-block; margin-right: 10px;">{{ $logistic->name }} @if ($logistic->id == $stock->logistic_st->id)
                            <img src="{{ asset('admin/images/image2.png') }}" alt="">
                        @else
                            <img src="{{ asset('admin/images/image1.png') }}" alt="">
                        @endif
                    </li>
                @endforeach
            </ul>

            <br><br>
            <h3 style="font-family:'Bookman Old Style'; font-size:16px; text-align: center;">DONNEES SUR LES
                STOCKS :
            </h3>
            <p style="font-family:'Bookman Old Style'; font-size:12px; text-align: center;"><strong>CF. page 2.
                    Annexe.</strong>
            </p>
            <p style="text-align:center;">Utiliser 1 ligne par produit. Si nécessaire joindre un feuillet
                complémentaire.</p>
        </div>
        <div class="pied" style="font-family:'Bookman Old Style'; margin-top:35px;">
            <div class="administration" style="margin-bottom:25px;">
                <p style="text-align: center; font-size:15px; font-weight:800">L’intéressé certifie, sous peine de
                    sanctions prévues par
                    la réglementation en vigueur, que toutes
                    les informations figurant ci-dessus sont exactes.</p>
            </div>
            <div class="visa" style="width: 100%; display:inline-block; margin-top:25px;">
                <div class="dci" style="float:right; width: 50%; text-align:right; display:inline-block;">
                    <h4>Date et Siganture de l'opérateur économique</h4>
                    <div style="border: 3px solid #002153; height:150px;"></div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
