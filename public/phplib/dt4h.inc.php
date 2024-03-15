<?php
function getSitesInfo($type="", $refresh=False) {
    $query = [];
    if ($type) {
        $query = ["type"=> $type];
    }
    return iterator_to_array($GLOBALS['sitesCol']->find(
        $query,
        $options=[
            "sort"=>["_id"=>1]
        ]
    ));
}

function getToolsInfo($refresh=False) {
    $query = ['external' => True];
    $tools = [];
    $tool_cursor = $GLOBALS['toolsCol']->find($query, $options=["sort"=>["_id"=>1]]);
    foreach ($tool_cursor as $tool) {
        $tool['inputs'] = [];
        $tool['outputs'] = [];

        foreach ($tool['input_files'] as $inputf) {
            $tool['inputs'][] = formatToolInputDesc($inputf);
        }
        foreach ($tool['output_files'] as $outputf) {
            $tool['outputs'][] = formatToolOutputDesc($outputf);
        }
        foreach ($tool['input_files_combinations'] as $op) {
            $tool['ops'][] = $op['description'];
        }
        $tools[$tool['_id']] = $tool;
    }
    return $tools;
}

function formatToolInputDesc($inputf) {
    $inptxt = $inputf['name'];
    $inptxt .= " (".join(',', $inputf['data_type']).":".join(',', $inputf['file_type']).")";
    if ($inputf['required']) {
        $inptxt .= "*";
    }
//    if ($inputf['allow_multiple']) {
//        $inptxt .= " xN";
//    }
    return $inptxt;
}

function formatToolOutputDesc($outputf) {
    $outtxt = $outputf['name'];
    //$outtxt .= " (".join(',', $outputf['file'][0]['data_type']).":".join(',', $outputf['file'][0]['file_type']).")";
    return $outtxt;
}