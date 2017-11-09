<?php
namespace Krypton\core;

class Template
{
    private $template;
    /*
    TYPE is DATABASE or STRING
    @return Template
    */
    public function __construct(string $templateID, bool $fromDatabase = true): Template
    {
        if ($fromDatabase) {
            $this->template = Query::T(DB_TEMPLATES)->select('tpl')->where('id = ?')->get([$templateID]);
        } else {
            $this->template = $template;
        }
    }
}
