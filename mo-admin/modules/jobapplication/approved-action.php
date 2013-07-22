<?php
require_once "../config.php";
switch ($do) {
    case 4:
        $cn->query("DELETE FROM postulante WHERE id = '" . $cn->scape($_POST['id']) . "'");
        break;
    case 6:
        $aColumns = array('id', 'nombre', 'apellido', 'dni', 'email', 'fecha_creacion', 'profesion', 'especializacion', 'intervencion');
        $sIndexColumn = "id";
        $sTable = "postulante";
        /*
         * Paging
         */
        $sLimit = "";
        if (isset($_POST['iDisplayStart']) && $_POST['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . intval($_POST['iDisplayStart']) . ", " . intval($_POST['iDisplayLength']);
        }
        /*
         * Ordering
         */
        $sOrder = "";
        if (isset($_POST['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_POST['iSortingCols']); $i++) {
                if ($_POST['bSortable_' . intval($_POST['iSortCol_' . $i])] == "true") {
                    $sOrder .= "`" . $aColumns[intval($_POST['iSortCol_' . $i])] . "` " .
                            ($_POST['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }
        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "";
        if (isset($_POST['sSearch']) && $_POST['sSearch'] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_POST['sSearch']) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }
        /* Individual column filtering */
        for ($i = 0; $i < count($aColumns); $i++) {
            if (isset($_POST['bSearchable_' . $i]) && $_POST['bSearchable_' . $i] == "true" && $_POST['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                if ($i == 6) { //CUSTOMIZE FOR REMURPE
                    $values_search = mysql_real_escape_string($_POST['sSearch_6']);
                    $column_count = $row_count = 0;
                    $mo_columns = explode("***", $values_search);
                    foreach ($mo_columns as $column_i => $values_column) {
                        if ($values_column != "") {
                            if (0 === $column_count++) $sWhere .= "( ";
                            $mo_rows = explode("|||", $values_column);
                            if ($i == 7) {
                                if ($row_count++ > 0) $sWhere .= " OR ";
                                if (count($mo_rows) > 1) {
                                    if (count($especializaciones[array_search($mo_rows[0], $areas)]) >= $mo_rows[1])
                                        $value_search = $especializaciones[array_search($mo_rows[0], $areas)][$mo_rows[1] - 1];
                                    else
                                        $value_search = 'masterojitos'; //By values not found
                                } else {
                                    $value_search = array_search($mo_rows[0], $areas);
                                }
                                $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . $value_search . "%' ";
                            } else {
                                foreach ($mo_rows as $value_search) {
                                    if ($row_count++ > 0) $sWhere .= " OR ";
                                    $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . $value_search . "%' ";
                                }
                            }
                        }
                        $i++;
                    }
                    if ($column_count > 0) $sWhere .= ") ";
                    else $sWhere .= " 1=1";
                } else {
                    $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_POST['sSearch_' . $i]) . "%' ";
                }
            }
        }
        /*
         * SQL queries
         * Get data to display
         */
        if ($sWhere == "") {
            $sWhere = "WHERE aprobado = 1";
        } else {
            $sWhere .= " AND aprobado = 1";
        }
        $sQuery = "SELECT SQL_CALC_FOUND_ROWS `" . str_replace(" , ", " ", implode("`, `", $aColumns)) . "` 
		FROM $sTable $sWhere $sOrder $sLimit";
//        var_dump($sQuery);exit;
        $rResult = $cn->query($sQuery);

        /* Data set length after filtering */
        $sQuery = "SELECT FOUND_ROWS()";
//        var_dump($sQuery);
        $rResultFilterTotal = $cn->query($sQuery);
        $aResultFilterTotal = $cn->fetch($rResultFilterTotal);
        $iFilteredTotal = $aResultFilterTotal[0];

        /* Total data set length */
        $sQuery = "SELECT COUNT(`" . $sIndexColumn . "`) FROM $sTable";
//        var_dump($sQuery);
        $rResultTotal = $cn->query($sQuery);
        $aResultTotal = $cn->fetch($rResultTotal);
        $iTotal = $aResultTotal[0];

        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($_POST['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        while ($aRow = mysql_fetch_array($rResult)) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "version") {
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow[$aColumns[$i]] == "0") ? '-' : $aRow[$aColumns[$i]];
                } else if ($aColumns[$i] != ' ') {
                    /* General output */
                    $row[] = substr($aRow[$aColumns[$i]], 0, 100);
                }
            }
            $output['aaData'][] = $row;
        }

        echo json_encode($output);

        break;
}
exit;