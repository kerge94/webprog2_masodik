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
        $startDate = $this->request->getParam('start_date');
        $endDate = $this->request->getParam('end_date');
        $category = $this->request->getParam('category');
        $result = InventoryModel::getList(
            $this->formatDate($startDate),
            $this->formatDate($endDate),
            $category
        );
        $this->sendJSON($result);
    }

    protected function formatDate(string $date): string
    {
        $dateObject = date_create($date);
        return date_format($dateObject, 'Y.m.d');
    }
}
