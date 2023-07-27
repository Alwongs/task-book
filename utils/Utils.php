<?php

class Utils 
{
    public function drawPager($totalItems, $perPage) 
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
        $pager = '<nav class="pagination">';
        for ($i=1; $i<=$pages; $i++) {

            $pager .= '<a ' . ($currentPage == $i ? 'class="active"' : '') . ' href="/task?orderby=' . $orderBy . '&page=' . $i . '">' . $i . '</a>';
        }
        $pager .= '</nav>';

        return $pages > 1 ? $pager : '';
    }
}