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
        ];

        View::renderPage('inventory/index', 'Leltár', $viewData);
    }

    public function get_list(): void
    {
        $startDate = $this->request->getParam('start_date');
        $this->sendJSON($this->request->getParams());
    }
}
