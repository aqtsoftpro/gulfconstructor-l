<?php

namespace App\Controllers;

use App\Models\BusinessCategoryModel;
use App\Models\UploadModel;

class BusinessCategoryController extends BaseAdminController
{

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $panelSettings = getPanelSettings();
    }

    /**
     * Business Categories
     */
    public function business_categories()
    {
        checkPermission('business_categories');
        $data['title'] = trans("business_categories");
        $data['lang'] = inputGet('lang');
        if (empty($data['lang'])) {
            $data["lang"] = selectedLangId();
        }
        if (!checkLanguageExist($data['lang'])) {
            $data['lang'] = selectedLangId();
            redirectToUrl(adminUrl('business-categories?lang=' . selectedLangId()));
        }
        $data['parentCategories'] = $this->businesscategoryModel->getParentCategories(true);
        $q = cleanStr(inputGet('q'));
        if (!empty($q)) {
            $numRows = $this->businesscategoryModel->getBusinessCategoriesSearchCount();
            $data['pager'] = paginate($this->perPage, $numRows);
            $data['searchBusinessCategories'] = $this->businesscategoryModel->getBusinessCategoriesSearchPaginated($this->perPage, $data['pager']->offset);
        }
        echo view('admin/includes/_header', $data);
        echo view('admin/business_category/business_categories', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Add Business Category
     */
    public function addBusinessCategory()
    {
        checkPermission('business_categories');
        $data['title'] = trans("add_business_category");
       
        echo view('admin/includes/_header', $data);
        echo view('admin/business_category/add_category', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Add Business Category Post
     */
    public function addBusinessCategoryPost()
    {
        checkPermission('business_categories');
        if ($this->businesscategoryModel->addBusinessCategory()) {
            setSuccessMessage(trans("msg_added"));
            resetCacheDataOnChange();
        } else {
            setErrorMessage(trans("msg_error"));
        }
        redirectToBackUrl();
    }

    /**
     * Edit Business Category
     */
    public function editBusinessCategory($id)
    {
        checkPermission('business_categories');
        $data['title'] = trans("update_business_category");
        $data['category'] = $this->businesscategoryModel->getBusinessCategory($id);
        if (empty($data['category'])) {
            return redirect()->to(adminUrl('business-categories'));
        }

        echo view('admin/includes/_header', $data);
        echo view('admin/business_category/edit_category', $data);
        echo view('admin/includes/_footer');
    }

    /**
     * Update Business Category Post
     */
    public function editBusinessCategoryPost()
    {
        checkPermission('business_categories');
        $id = inputPost('id');
        if ($this->businesscategoryModel->editBusinessCategory($id)) {
            setSuccessMessage(trans("msg_updated"));
            resetCacheDataOnChange();
        } else {
            setErrorMessage(trans("msg_error"));
        }
        redirectToBackUrl();
    }

    /**
     * Business Category Settings Post
     */
    public function categorySettingsPost()
    {
        checkPermission('business_categories');
        if ($this->businesscategoryModel->updateSettings()) {
            setSuccessMessage(trans("msg_updated"));
        } else {
            setErrorMessage(trans("msg_error"));
        }
        return redirect()->back();
    }

    /**
     * Delete Business Category Post
     */
    public function deleteCategoryPost()
    {
        checkPermission('business_categories');
        $id = inputPost('id');
            if ($this->businesscategoryModel->deleteBusinessCategory($id)) {
                setSuccessMessage(trans("msg_deleted"));
                resetCacheDataOnChange();
            } else {
                setErrorMessage(trans("msg_error"));
            }
    }

    /**
     * Edit index categories order
     */
    public function editIndexCategoriesOrderPost()
    {
        checkPermission('business_categories');
        $this->businesscategoryModel->editIndexCategoriesOrder();
        resetCacheDataOnChange();
    }

    /**
     * Load Business categories
     */
    public function loadCategories()
    {
        checkPermission('business_categories');
        $data = [
            'result' => 0
        ];

        $BCategories = $this->businesscategoryModel->getCategoriesByParentId(0);
        if (!empty($BCategories)) {
            $data = [
                'result' => 1,
                'htmlContent' => view('admin/business_category/_business_categories_print', ['categories' => $BCategories, 'padding' => true])
            ];
        }
        echo json_encode($data);
    }

    /**
     * Delete Business category image
     */
    public function deleteCategoryImagePost()
    {
        checkPermission('business_categories');
        $categoryId = inputPost('category_id');
        $this->businesscategoryModel->deleteCategoryImage($categoryId);
        resetCacheDataOnChange();
    }

}