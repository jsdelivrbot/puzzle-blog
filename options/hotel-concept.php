<?php

$htl_concept = array();
printarr($response -> $value -> Concepts);
foreach ($response -> $value -> Concepts as $key => $value1) {
    $htl_concept[$key] = array(
       'ConceptCode'  => $value1 -> HotelConceptCode,
       'ConceptTitle' => $value1 -> HotelConceptTitle,
       'items'        => array()
    );

    foreach ($value1 -> items  as $key2 => $value2) {
        $htl_concept[$key]['items'][] = array(
            'title'   => $value2 -> SectionTitle,
            'status'  => $value2 -> HotelFactSheetValue1,
        );
    }
}

printarr($htl_concept);
