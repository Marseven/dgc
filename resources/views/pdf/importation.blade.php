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
                <p style="text-align: center; font-size:10px; line-height:10px">
                    MINISTERE DU COMMERCE, DES PETITES ET MOYENNES <br>
                    ENTREPRISES, PETITES ET MOYENNES INDUSTRIES,<br>
                    ACTIVITES GENERATRICES DE REVENUS CHARGE DES <br>
                    -------------------<br>
                    SECRETARIAT GENERAL<br>
                    -------------------<br>
                    DIRECTION GENERALE DU COMMERCE<br>
                    -------------------<br>
                    DIRECTION DU COMMERCE EXTERIEUR<br>
                    --------------------<br>
                    <strong>SERVICE REGLEMENTATION <br>
                        ET ENQUETES COMMERCIALES</strong>
                </p>
            </div>
            <div class="blason" style="width: 60%; display:inline-block;">
                <span style="height:0pt; text-align:left; display:block; position:absolute; z-index:-1"><img
                        src="{{ asset('admin/images/image001.jpg') }}" width="118" height="75" alt="RG"
                        style="margin-top:3.7pt; margin-left:427.15pt; position:absolute" /></span>
            </div>
        </div>
        <div class="title" style="width: 100%; text-align:center; margin-top:120px;">
            <p style="font-family:'Bookman Old Style'; font-size:9px;">N° _____________DU…………../…………/……………</p>
            <div style="">
                <h1
                    style="width: 90%; margin: auto; font-size:14px; border: 1px solid #00A44F; background-color: #00A44F; color:white; padding-top:10px;  padding-bottom:10px; border-radius:10px">
                    DECLARATION PREVISIONNELLE D’IMPORTATION/EXPORTATION</h1>
            </div>
            <h2 style="font-family:'Bookman Old Style'; font-size:14px; font-weight:bold; text-decoration:underline">Le
                Directeur Général du
                Commerce,
                soussigné :</h2>
            <p style="font-family:'Bookman Old Style'; font-size:10px; font-weight:bold; text-align:left;">- Vu l’Accord
                de
                Marrakech de l’Organisation Mondiale du Commerce (OMC) de 1995 sur les Licences d’Importations ; <br>
                - Vu l’Ordonnance N°10/89 du 28 septembre 1989 portant réglementation des activités de commerçant,
                d’industriel ou d’artisan en République Gabonaise ; <br>
                - Vu le Décret N°772/PR/MCIRS/MFBP du 23 août 1994 modifiant le Décret N°766/PR/MICOIN du 1er juin 1983
                portant réglementation du commerce extérieur en République Gabonaise.
            </p>
        </div>

        <h2 style="font-family:'Bookman Old Style'; font-size:10px; text-align:center;">INFORMATIONS CONCERNANT
            L’ENTREPRISE
        </h2>

        <div class="entreprise-info"
            style="font-family:'Bookman Old Style'; margin-top:5px; border: 1.5px solid #000; padding:10px;">
            <p style="margin:4px">Raison sociale : <strong>{{ $importation->entreprise->company_name }}</strong> </p>
            <p style="margin:4px">Nom du Gérant ou du Représentant :
                <strong>{{ $importation->entreprise->gerant }}</strong>
            </p>
            <p style="margin:4px">Commune : <strong>{{ $importation->entreprise->commune }}</strong> Arrondissement :
                <strong>{{ $importation->entreprise->arrond }}</strong> Quartier :
                <strong>{{ $importation->entreprise->hood }}</strong> BP :
                <strong>{{ $importation->entreprise->postal_code }}</strong>
                Téléphone :
                <strong>{{ $importation->entreprise->phone }}</strong> Email:
                <strong>{{ $importation->entreprise->email }}</strong>
            </p>
            <p style="margin:4px">Activité(s) :
                <strong>{{ $importation->entreprise->activity == null ? $importation->entreprise->activity_ent->name : $importation->entreprise->activity }}</strong>
            </p style="margin:4px">
            <p style="margin:4px">N° Fiche Circuit : <strong>{{ $importation->entreprise->business_circuit }}</strong>
                N°
                Carte de Commerçant
                :
                <strong>{{ $importation->entreprise->number_commercant }}</strong> N° Agrément de Commerce :
                <strong>{{ $importation->entreprise->number_agrement }}</strong>
            </p>
            <p style="margin:4px"> N° Statistique : <strong>{{ $importation->entreprise->number_statistic }}</strong>
                N°
                RCCM :
                <strong>{{ $importation->entreprise->rccm }}</strong>
            </p>
            <p style="margin:4px">Noms et adresse du forunisseur : <strong>{{ $importation->entreprise->provider }},
                    <strong>{{ $importation->adress_provider }}</strong> </p>
            <p style="margin:4px">Transitaire : <strong>{{ $importation->entreprise->transitaire }}</strong> Tél :
                <strong>{{ $importation->entreprise->phone_transitaire }}</strong> Adresse :
                <strong>{{ $importation->entreprise->adress_transitaire }}</strong>
            </p>
        </div><br>

        <h2 style="font-family:'Bookman Old Style'; font-size:10px; text-align:center;">INFORMATIONS CONCERNANT LA
            MARCHANDISE</h2>

        <div class="importation-info-2"
            style="font-family:'Bookman Old Style'; margin-top:5px; border: 1px solid #000; padding:10px;">
            <p style="margin:4px"style="margin:4px">Nature de la marchandise :
                <strong>{{ $importation->type_product }}</strong>
            </p>
            <p style="margin:4px">Pays d'origine : <strong>{{ $importation->country_origin }}</strong> Pays de
                provenance :
                <strong>{{ $importation->country_from }}</strong> Destination Finale :
                <strong>{{ $importation->destination }}</strong>
            </p>
            <p style="display: inline-block;">Zone Géographique :
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                <li style="display: inline-block; margin-right: 10px;">CEMAC @if ($importation->zone == 'CEMAC')
                        <img src="{{ asset('admin/images/image2.png') }}" alt="">
                    @else
                        <img src="{{ asset('admin/images/image1.png') }}" alt="">
                    @endif
                </li>
                <li style="display: inline-block; margin-right: 10px;">CEEAC @if ($importation->zone == 'CEEAC')
                        <img src="{{ asset('admin/images/image2.png') }}" alt="">
                    @else
                        <img src="{{ asset('admin/images/image1.png') }}" alt="">
                    @endif
                </li>
                <li style="display: inline-block; margin-right: 10px;">UE @if ($importation->zone == 'UE')
                        <img src="{{ asset('admin/images/image2.png') }}" alt="">
                    @else
                        <img src="{{ asset('admin/images/image1.png') }}" alt="">
                    @endif
                </li>
                <li style="display: inline-block; margin-right: 10px;">Amérique @if ($importation->zone == 'Amérique')
                        <img src="{{ asset('admin/images/image2.png') }}" alt="">
                    @else
                        <img src="{{ asset('admin/images/image1.png') }}" alt="">
                    @endif
                </li>
                <li style="display: inline-block; margin-right: 10px;">Asie @if ($importation->zone == 'Asie')
                        <img src="{{ asset('admin/images/image2.png') }}" alt="">
                    @else
                        <img src="{{ asset('admin/images/image1.png') }}" alt="">
                    @endif
                </li>
                <li style="display: inline-block; margin-right: 10px;">Autres @if ($importation->zone == 'Autres')
                        <img src="{{ asset('admin/images/image2.png') }}" alt="">
                    @else
                        <img src="{{ asset('admin/images/image1.png') }}" alt="">
                    @endif
                </li>
            </ul>
            </p>
            <p style="margin:4px">Lieu d'embarquement : <strong>{{ $importation->dock_loading }}</strong> Lieu de
                débarquement :
                <strong>{{ $importation->dock_unloading }}</strong>
            </p>
            <p style="margin:4px">Valeur de la marchandise (FCFA) : <strong>{{ $importation->value }}</strong> </p>
            <p style="margin:4px">Moyen de Transport : <strong>{{ $importation->type_transaport }}</strong> </p>
            <p style="margin:4px">N° Facture pro-forma : <strong>{{ $importation->facture_number }}</strong> </p>
            <p style="margin:4px">Tonnage / Volume : <strong>{{ $importation->weight }}</strong> Quantité :
                <strong>{{ $importation->quantity }}</strong>
            </p>
            <p style="margin:4px">Transitaire : <strong>{{ $importation->transitaire }}</strong> Tél :
                <strong>{{ $importation->phone_transitaire }}</strong>
            </p>
            <p style="margin:4px">Date de départ : <strong>{{ $importation->date_start }}</strong> Date d'arrivée :
                <strong>{{ $importation->date_end }}</strong>
            </p>
        </div>


        <div class="pied" style="font-family:'Bookman Old Style'; margin-top:5px;">
            <p style="font-weight: bold;  font-size:9pt; margin:2px">Le Déclarant certifie, sous peine de sanctions
                prévues
                par la
                réglementation en
                vigueur, que toutes les
                informations figurant ci-dessus sont exactes.</p>
            <p style="font-size:9pt;"> <span style="text-decoration: underline"> N.B :</span> La présente déclaration
                n’est
                valable que pour cette
                opération et expire après le dédouanement de la
                marchandise susmentionnée.<br>
                - Les Déclarations doivent être faites auprès des Services compétents de la Direction Générale du
                Commerce
                <strong>au moins un (1) mois avant la date d’arrivée de la marchandise,</strong> conformément aux
                dispositions de l’article
                10 du Décret 766/PR/MICOIN du 1er juin 1983.
            </p>
            <p style="margin-left:350pt; text-align:left; line-height:115%; font-size:11pt">
                <br><br><br>
                <span style="font-family:'Bookman Old Style'; font-size:10pt; font-weight:700; margin-top:25px;">
                    Zéphirine ETOTOWA NTUTUME
                </span>
            </p>
            <p style="text-align:center; line-height:108%; border-top:1.5pt solid black; font-size:6pt">
                <strong><em><span style="font-family:Arial; color:#1f4e79">Rue François de Paul VANE UBISSANI, montée
                            de Montagne sainte après le complexe Michel DIRAT</span></em></strong><strong><span
                        style="font-family:Wingdings; color:#1f4e79"></span></strong><strong><span
                        style="font-family:Arial; color:#1f4e79"> :</span></strong><strong><em><span
                            style="font-family:Arial; color:#1f4e79"> 561/ </span></em></strong><strong><span
                        style="font-family:Wingdings; color:#1f4e79"></span></strong><strong><span
                        style="font-family:Arial; color:#1f4e79"> :</span></strong><strong><em><span
                            style="font-family:Arial; color:#1f4e79">00 (241)01-76-61-67 /
                            email</span></em></strong><strong><em><span
                            style="font-family:Arial; color:#1f4e79">&#xa0;</span></em></strong><strong><em><span
                            style="font-family:Arial; color:#1f4e79">: dgclibreville@gmail.com / LBV-Gabon
                        </span></em></strong>
            </p>
        </div>
    </div>


</body>

</html>
