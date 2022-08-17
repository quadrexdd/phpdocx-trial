<?php
// replace list variables (placeholders) using sub-arrays

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateList.docx');

$items = array('First item', 'Second item', array('Subitem A', 'Subitem B', 'Subitem C', array('Subitem C.1', 'Subitem C.2'), 'Subitem D'), 'Third item');

$docx->replaceListVariable('LISTVAR', $items);

$docx->createDocx('example_replaceListVariable_6');