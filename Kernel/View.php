<?php
/**
 * Classe représentant la vue.
 */
class View {
    private string $html;
    private string $footer;
    private string $header;
    private string $head;
    
    /**
     * Fonctions mutatrices des composants de la vue.
     */
    public function setMain(string $html):self
    {
        $this->html = 'Views/'.$html;
        return $this;
    }

    public function setHead(string $headHtml):self 
    {
        $this->head = 'Views/Template/'.$headHtml;
        return $this;
    }

    public function setHeader(string $headerHtml):self 
    {
        $this->header = 'Views/Template/'.$headerHtml;
        return $this;
    }

    public function setFooter(string $footerHtml):self 
    {
        $this->footer = 'Views/Template/'.$footerHtml;
        return $this;
    }

    /**
     * Fonction qui affiche la vue.
     * @Param : $vars : tableau associatif contenant les variables 
     * accessibles par la vue html.
     */
    public function render(array $vars)
    {        
        extract($vars);
        include(dirname(__FILE__)."/../".$this->head);
        include(dirname(__FILE__)."/../".$this->header);
        include(dirname(__FILE__)."/../".$this->html);
        include(dirname(__FILE__)."/../".$this->footer);
    }
}
?>