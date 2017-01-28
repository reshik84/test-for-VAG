<?php

class quine
{
    
    private $file;
    
    private $tag = 'pre';

    private $isTagOpened = 0;
    
    private $text;

    public function __construct() {
        $this->file = __FILE__;
    }

    public function showList(){
        $file_text = file($this->file);
        $text = '';
        foreach ($file_text as $string){
            $text .= htmlspecialchars($string);
        }
        $this->text = $text;
        
        return $this->applyTags();
    }
    
    private function applyTags(){
        if($this->isTagOpened != 0){
            throw new Exception('Error Tags structure');
        }
        return $this->_openTag() . $this->text . $this->_closeTag();
    }

    private function _openTag(){
        $this->isTagOpened ++;
        return '<' . $this->tag . '>';
    }
    
    private function _closeTag(){
        $this->isTagOpened --;
        if($this->isTagOpened < 0){
            throw new Exception('Error closing tag');
        }
        return '<' . $this->tag . '>';
    }
    
}

$quine = new quine();
echo $quine->showList();