<?php

class Utils 
{
    public function getLimits($allTasks, $totalPages, $tasksPerPage)
    {
        if (!isset($_GET['page']) || intval($_GET['page']) == 0 || intval($_GET['page']) == 1 || intval($_GET['page']) < 0) {
            $pageNumber = 1;
            $leftLimit = 0;
            $rightLimit = $tasksPerPage;
        } elseif (intval($_GET['page']) > $totalPages || intval($_GET['page']) == $totalPages) {
            $pageNumber = $totalPages;
            $leftLimit = $tasksPerPage * ($pageNumber - 1);
            $rightLimit = $allTasks;
        } else {
            $pageNumber = intval($_GET['page']);
            $leftLimit = $tasksPerPage * ($pageNumber - 1);   
            $rightLimit = $tasksPerPage;      
        }  
        return [ $leftLimit, $rightLimit ];
    }

    public function drawPagerButtons($totalItems, $perPage) 
    {
        $pages = ceil($totalItems / $perPage);

        if (!isset($_GET['page']) || intval($_GET['page']) == 0) {
            $currentPage = 1;
        } else if (intval($_GET['page']) > $totalItems) {
            $currentPage = $pages;
        } else {
            $currentPage = intval($_GET['page']);
        }

        $orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : 'created_at';
        $sortDirect = isset($_GET['sortDirect']) ? $_GET['sortDirect'] : 'DESC';

        $pager = '<nav class="pagination">';
        for ($i=1; $i<=$pages; $i++) {
            $pager .= '<a ' . ($currentPage == $i ? 'class="active"' : '') . ' href="/task?orderby=' . $orderBy . '&sortDirect=' . $sortDirect . '&page=' . $i . '">' . $i . '</a>';
        }
        $pager .= '</nav>';

        return $pages > 1 ? $pager : '';
    }

    public function checkParamToSort($param) 
    {
        $sortGetParams = [
            'full_name' => 1,
            'email' => 1,
            'status' => 1
        ];
        return isset($sortGetParams[$param]);
    }    

    public function getSortParams() 
    {
        if (isset($_GET['orderby']) && $this->checkParamToSort($_GET['orderby'])) {
            $sortBy = $_GET['orderby'];            
        } else {
            $sortBy = 'created_at';             
        }
        $sortDirect = isset($_GET['sortDirect']) ? $_GET['sortDirect'] : 'DESC'; 

        return [ $sortBy, $sortDirect ];
    }
}