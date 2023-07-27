<?php

class View {

    public function render($tpl, $pageData) {

        require_once "components/header.tpl.php";

        include ROOT. $tpl;
        
        require_once "components/footer.tpl.php";
    }

}