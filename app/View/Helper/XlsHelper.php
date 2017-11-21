<?php
class XlsHelper extends AppHelper
{
var $delimiter = "\t";
var $filename = 'Export.xls';
var $line = array();
var $buffer;
var $quitar = array('á', 'é', 'í', 'ó', 'ú', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ');
var $poner = array('a', 'e', 'i', 'o', 'u', 'n', 'A', 'E', 'I', 'O', 'U', 'N');

function XlsHelper()
{
    $this->clear();
}
function clear() 
{
    $this->line = array();
    $this->buffer = fopen('php://temp/maxmemory:'. (5*1024*1024), 'r+');
}

function addField($value) 
{
    $this->line[] = $value;
}

function endRow() 
{
    $this->addRow($this->line);
    $this->line = array();
}

function addRow($row) 
{
    foreach ($row as $key => $value)
        echo str_replace($this->quitar, $this->poner, $value)."\t";

    echo "\n";
}

function renderHeaders() 
{
    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-disposition: attachment; filename=".$this->filename);
}

function setFilename($filename)
{
    $this->filename = $filename;
    if (strtolower(substr($this->filename, -4)) != '.xls') 
    {
        $this->filename .= '.xls';
    }
}

function render($outputHeaders = true) 
{
    if ($outputHeaders) 
    {
        if (is_string($outputHeaders))
            $this->setFilename($outputHeaders);
        
        $this->renderHeaders();
    }

    rewind($this->buffer);
    $output = stream_get_contents($this->buffer);

    return $this->output($output);
}
}
?>