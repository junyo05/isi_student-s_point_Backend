<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 9px; color: #000; }

        /* HEADER */
        .header { display: table; width: 100%; border: 1px solid #000; border-collapse: collapse; }
        .header-left { display: table-cell; width: 20%; border-right: 1px solid #000; padding: 5px; text-align: center; vertical-align: middle; }
        .header-left .groupe { font-size: 14px; font-weight: bold; }
        .header-left .isi { font-size: 28px; font-weight: bold; color: #1a1a8c; }
        .header-left .sciences { font-size: 7px; margin-top: 5px; }
        .header-center { display: table-cell; width: 55%; border-right: 1px solid #000; padding: 4px; vertical-align: top; }
        .header-center table { width: 100%; border-collapse: collapse; }
        .header-center td { padding: 2px 4px; font-size: 8.5px; }
        .header-center td:first-child { font-weight: bold; width: 45%; }
        .header-right { display: table-cell; width: 25%; padding: 4px; text-align: center; vertical-align: middle; background: #1a1a8c; color: white; }
        .header-right .bulletin-title { font-size: 13px; font-weight: bold; }
        .header-right .semestre { font-size: 11px; font-weight: bold; }

        /* DOMAINE */
        .domaine-bar { display: table; width: 100%; border: 1px solid #000; border-top: none; border-collapse: collapse; }
        .domaine-cell { display: table-cell; padding: 3px 6px; border-right: 1px solid #000; font-size: 8px; }
        .domaine-cell:last-child { border-right: none; }
        .domaine-cell span { font-weight: bold; display: block; }

        /* TABLE NOTES */
        .notes-table { width: 100%; border-collapse: collapse; margin-top: 4px; }
        .notes-table th, .notes-table td { border: 1px solid #000; padding: 2px 3px; text-align: center; font-size: 7.5px; }
        .notes-table th { background: #d0d0d0; font-weight: bold; }
        .ue-header td { background: #a0a0a0; font-weight: bold; font-size: 8px; text-align: left; padding-left: 4px; }
        .matiere-row td:first-child { text-align: left; padding-left: 8px; }
        .ue-total td { background: #e0e0e0; font-weight: bold; }

        /* BILAN */
        .bilan-table { width: 100%; border-collapse: collapse; margin-top: 4px; }
        .bilan-table td { border: 1px solid #000; padding: 3px 5px; font-size: 8px; text-align: center; }
        .bilan-label { font-weight: bold; background: #d0d0d0; }

        /* RECAP */
        .recap-section { margin-top: 4px; border: 1px solid #000; }
        .recap-title { background: #a0a0a0; font-weight: bold; font-size: 8px; padding: 2px 4px; text-align: center; }
        .recap-table { width: 100%; border-collapse: collapse; }
        .recap-table td { border: 1px solid #000; padding: 2px 4px; font-size: 7.5px; text-align: center; }
        .recap-label { font-weight: bold; text-align: left; background: #e0e0e0; }

        /* LEGENDE */
        .legende { margin-top: 4px; border: 1px solid #000; padding: 3px; font-size: 7px; }
        .legende-title { font-weight: bold; margin-bottom: 2px; }
        .legende-items { display: table; width: 100%; }
        .legende-item { display: table-cell; padding-right: 10px; }

        /* FOOTER */
        .footer { display: table; width: 100%; margin-top: 6px; }
        .footer-left { display: table-cell; width: 70%; font-size: 7px; vertical-align: bottom; }
        .footer-right { display: table-cell; width: 30%; text-align: center; vertical-align: top; }
        .signature-title { font-size: 8px; font-weight: bold; margin-bottom: 4px; }
        .signature-name { font-size: 8px; font-weight: bold; }

        .decision { margin-top: 4px; border: 1px solid #000; padding: 3px 6px; font-size: 8px; font-weight: bold; }

        .validated { background: #c8e6c9; }
        .invalidated { background: #ffcdd2; }
        .rattrap { background: #fff9c4; }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <div class="header-left">
            <div class="groupe">GROUPE</div>
            <div class="isi">ISI</div>
            <div class="sciences">Sciences et Technologies</div>
        </div>
        <div class="header-center">
            <table>
                <tr>
                    <td>Année académique :</td>
                    <td>{{ $inscription->annee->libelle ?? '' }}</td>
                </tr>
                <tr>
                    <td>Identifiant :</td>
                    <td>{{ $inscription->etudiant->matricule ?? '' }}</td>
                </tr>
                <tr>
                    <td>Prénom et nom :</td>
                    <td>{{ $inscription->etudiant->prenom ?? '' }} {{ $inscription->etudiant->nom ?? '' }}</td>
                </tr>
                <tr>
                    <td>Sexe :</td>
                    <td>{{ $inscription->etudiant->sexe ?? '' }}</td>
                </tr>
                <tr>
                    <td>Date et lieu de naissance :</td>
                    <td>{{ $inscription->etudiant->date_naissance ?? '' }} à {{ $inscription->etudiant->lieu_naissance ?? '' }}</td>
                </tr>
            </table>
        </div>
        <div class="header-right">
            <div class="bulletin-title">Bulletin de notes</div>
            <div class="semestre">Semestre {{ $semestre }}</div>
        </div>
    </div>

    {{-- DOMAINE --}}
    <div class="domaine-bar">
        <div class="domaine-cell">
            <span>Domaine</span>
            {{ $inscription->classe->filiere->domaine ?? 'Sciences et Technologies' }}
        </div>
        <div class="domaine-cell">
            <span>Mention</span>
            {{ $inscription->classe->filiere->mention ?? 'Informatique' }}
        </div>
        <div class="domaine-cell">
            <span>Spécialité</span>
            {{ $inscription->classe->filiere->specialite ?? 'Génie Logiciel' }}
        </div>
        <div class="domaine-cell">
            <span>Grade</span>
            {{ $inscription->classe->grade ?? 'Licence' }}
        </div>
    </div>

    {{-- TABLE NOTES --}}
    <table class="notes-table">
        <thead>
            <tr>
                <th style="width:28%; text-align:left">UE / Éléments constitutifs</th>
                <th>MCC 40%</th>
                <th>Examen 60%</th>
                <th>Rattrap 60%</th>
                <th>Moy EC</th>
                <th>Coef EC</th>
                <th>Moyenne Coef</th>
                <th>Crédit UE</th>
                <th>Moyenne UE</th>
                <th>Appréciation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ues as $ue)
                {{-- Ligne UE --}}
                <tr class="ue-header">
                    <td colspan="10">{{ $ue['code'] }} {{ $ue['nom'] }}</td>
                </tr>
                {{-- Lignes matières --}}
                @foreach($ue['matieres'] as $matiere)
                <tr class="matiere-row">
                    <td>{{ $matiere['nom'] }}</td>
                    <td>{{ $matiere['mcc'] ?? '' }}</td>
                    <td>{{ $matiere['examen'] ?? '' }}</td>
                    <td>{{ $matiere['rattrap'] ?? '' }}</td>
                    <td>{{ $matiere['moy_ec'] ?? '' }}</td>
                    <td>{{ $matiere['coef'] ?? '' }}</td>
                    <td>{{ $matiere['moy_coef'] ?? '' }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $matiere['appreciation'] ?? '' }}</td>
                </tr>
                @endforeach
                {{-- Total UE --}}
                <tr class="ue-total">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $ue['total_coef'] ?? '' }}</td>
                    <td>{{ $ue['total_moy_coef'] ?? '' }}</td>
                    <td>{{ $ue['credit'] ?? '' }}</td>
                    <td>{{ $ue['moyenne_ue'] ?? '' }}</td>
                    <td>{{ $ue['validation'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- BILAN SEMESTRES --}}
    <table class="bilan-table" style="margin-top:4px">
        <tr>
            <td class="bilan-label">Semestre {{ $semestre_precedent ?? ($semestre - 1) }}</td>
            <td>Crédits <strong>{{ $credits_precedent ?? '' }} / 30</strong></td>
            <td>Moyenne <strong>{{ $moyenne_precedent ?? '' }} / 20</strong></td>
            <td class="bilan-label">Semestre {{ $semestre }}</td>
            <td>Crédits <strong>{{ $credits_actuel ?? '' }} / 30</strong></td>
            <td>Moyenne <strong>{{ $moyenne ?? '' }} / 20</strong></td>
            <td class="bilan-label">Total crédits</td>
            <td><strong>{{ $total_credits ?? '' }} / 60</strong></td>
            <td class="bilan-label">Moy Générale</td>
            <td><strong>{{ $moy_generale ?? '' }} / 20</strong></td>
        </tr>
    </table>

    {{-- DECISION --}}
    <div class="decision">
        Décision du jury : <span>{{ $decision ?? 'Bon Travail / Résultat: Admis(e) en classe supérieure' }}</span>
    </div>

    {{-- RECAP SEMESTRES --}}
    <div class="recap-section" style="margin-top:4px">
        <div style="display:table; width:100%">
            <div style="display:table-cell; width:50%; border-right:1px solid #000;">
                <div class="recap-title">Récap du 1er semestre</div>
                <table class="recap-table">
                    <tr>
                        <td class="recap-label">UE</td>
                        <td>UE 1</td><td>UE 2</td><td>UE 3</td><td>UE 4</td><td>UE 5</td>
                    </tr>
                    <tr>
                        <td class="recap-label">Moyennes</td>
                        @foreach($recap_s1['moyennes'] ?? ['-','-','-','-','-'] as $m)
                            <td>{{ $m }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="recap-label">Validations</td>
                        @foreach($recap_s1['validations'] ?? ['','','','',''] as $v)
                            <td>{{ $v }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="recap-label">Crédits obtenus</td>
                        @foreach($recap_s1['credits'] ?? ['-','-','-','-','-'] as $c)
                            <td>{{ $c }}</td>
                        @endforeach
                    </tr>
                </table>
            </div>
            <div style="display:table-cell; width:50%;">
                <div class="recap-title">Récap du 2ème semestre</div>
                <table class="recap-table">
                    <tr>
                        <td class="recap-label">UE</td>
                        <td>UE 1</td><td>UE 2</td><td>UE 3</td><td>UE 4</td><td>UE 5</td>
                    </tr>
                    <tr>
                        <td class="recap-label">Moyennes</td>
                        @foreach($recap_s2['moyennes'] ?? ['-','-','-','-','-'] as $m)
                            <td>{{ $m }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="recap-label">Validations</td>
                        @foreach($recap_s2['validations'] ?? ['','','','',''] as $v)
                            <td>{{ $v }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="recap-label">Crédits obtenus</td>
                        @foreach($recap_s2['credits'] ?? ['-','-','-','-','-'] as $c)
                            <td>{{ $c }}</td>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- LEGENDE + SIGNATURE --}}
    <div class="footer">
        <div class="footer-left">
            <div class="legende">
                <div class="legende-title">Légende</div>
                <div>MCC = Moyenne Contrôle Continu &nbsp;|&nbsp; EC = Élément constitutif &nbsp;|&nbsp; Rattrap = note de rattrapage &nbsp;|&nbsp; Moy = moyenne EC</div>
                <div style="margin-top:3px">
                    <span style="background:#ffcdd2; padding:1px 6px;">Examen(s) à faire</span> &nbsp;
                    <span style="background:#a0a0a0; padding:1px 6px;">UE Invalidée</span> &nbsp;
                    <span style="background:#c8e6c9; padding:1px 6px;">UE validée</span> &nbsp;
                    <span style="background:#fff9c4; padding:1px 6px;">UE validée en rattrapage</span>
                </div>
            </div>
            <div style="margin-top:6px; font-size:7px;">
                Km1, avenue Cheikh Anta DIOP Tél : +221 33 822 19 81 E-mail: contact@groupeisi.com Web site: www.groupeisi.com
            </div>
        </div>
        <div class="footer-right">
            <div class="signature-title">Directrice des études</div>
            <div class="signature-name">Aissatou Diaby GASSAMA</div>
            {{-- Signature image --}}
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/signature.png'))) }}"
                 style="width:100px; margin-top:4px;">
            {{-- Cachet --}}
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/cachet.png'))) }}"
                 style="width:80px; margin-top:4px;">
        </div>
    </div>

    {{-- CODE BARRE --}}
    <div style="text-align:center; margin-top:6px;">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/barcode.png'))) }}"
             style="height:40px;">
    </div>

</body>
</html> -->