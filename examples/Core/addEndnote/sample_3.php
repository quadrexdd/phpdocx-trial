<?php
// add multiple endnotes to a text

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

$endnote = new WordFragment($docx, 'document');

$endnote->addEndnote(
    array(
        'textDocument' => 'endnote',
        'textEndnotes' => array(
            array(
                'textEndnote' => ' The endnote we want to insert.',
            ),
            array(
                'textEndnote' => ' The 2nd endnote we want to insert.',
            )
        ),
    )
);

$text = array();
$text[] = array('text' => 'Here comes the ');
$text[] = $endnote;
$text[] = array('text' => ' and some other text.');

$docx->addText($text);

$docx->addText('Some other text.');

$docx->createDocx('example_addEndnote_3');