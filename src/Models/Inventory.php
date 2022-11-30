<?php

namespace Models;

use App;
use TCPDF;

class Inventory
{
    public static function getSoftwareCategories(): array
    {
        return App::DB()->query(
            "select distinct kategoria from szoftver order by kategoria;"
        );
    }

    public static function getFirstInstallDate(): string
    {
        return App::DB()->query(
            "select date_format(min(datum), '%Y-%m-%d') as datum from telepites;"
        )[0]['datum'];
    }

    public static function getLastInstallDate(): string
    {
        return App::DB()->query(
            "select date_format(max(datum), '%Y-%m-%d') as datum from telepites;"
        )[0]['datum'];
    }

    public static function getList(string $startDate, string $endDate, string $category): array
    {
        $queryString = <<<QUERY
        select nev, count(telepites.szoftverid) as telepitesek from telepites
        inner join szoftver on telepites.szoftverid = szoftver.id
        inner join gep on telepites.gepid = gep.id
        where telepites.datum between ? and ? and szoftver.kategoria = ?
        group by nev
        order by nev;
        QUERY;
        return App::DB()->query(
            $queryString,
            "sss",
            [$startDate, $endDate, $category]
        );
    }

    public static function generatePDF(array $list, string $title = "")
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetHeaderData(null, null, APP_NAME, $title);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->AddPage();

        $tableRows = '';
        foreach ($list as $row) {
            $name = $row['nev'];
            $installs = $row['telepitesek'];
            $tableRows .= <<<ROW
            <tr>
                <td>$name</td>
                <td>$installs</td>
            </tr>
            ROW;
        }

        $html = <<<HTML
        <table border="1" cellpadding="4">
            <thead>
                <tr>
                    <th bgcolor="#5f5f5">Szoftver</th>
                    <th bgcolor="#5f5f5">Telepítések száma</th>
                </tr>
            </thead>
            <tbody style="border-top: 1px solid #000;">
                $tableRows
            </tbody>
        </table>
        HTML;

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output(APP_NAME . '.pdf', 'I');
    }
}
