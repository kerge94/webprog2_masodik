<?php

namespace Controllers;

use Models\View;
use Models\Inventory as InventoryModel;

class Inventory extends BaseController
{
    public function index(): void
    {
        $this->checkAccessLevel(1);

        $viewData = [
            'software_categories' => InventoryModel::getSoftwareCategories(),
            'start_date' => InventoryModel::getFirstInstallDate(),
            'end_date' => InventoryModel::getLastInstallDate(),
        ];

        View::renderPage('inventory/index', 'Leltár', $viewData);
    }

    public function get_list(): void
    {
        $startDate = $this->formatDate(
            $this->request->getParam('start_date')
        );
        $endDate = $this->formatDate(
            $this->request->getParam('end_date')
        );
        $category = $this->request->getParam('category');
        $pdfResponse = $this->request->getParam('pdf');

        $result = InventoryModel::getList(
            $startDate,
            $endDate,
            $category
        );

        if ($pdfResponse === null) {
            $this->sendJSON($result);
        }
        else {
            InventoryModel::generatePDF(
                $result,
                "$startDate - $endDate\n$category"
            );
        }
    }

    protected function formatDate(string $date): string
    {
        $dateObject = date_create($date);
        return date_format($dateObject, 'Y.m.d');
    }
}
