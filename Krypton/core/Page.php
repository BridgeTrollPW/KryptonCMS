<?php
/*
Get Page id securely
load content and template of page
let template init variables and inits, reference variables from page content if necessary
build the template and add to page
let the page be displayed
*/
namespace Krypton\core;

class Page
{
    private $currentPageID;
    private $injectedURIQueries;
    public function __contruct()
    {
        $injectedURIQueries = '&';
        if (!isset($_GET[URI_PAGEID])) {
            //If no page is specified, you will return to the default page
            $this->currentPageID = System::getDefaultPage();
            $this->injectQuery('error', E_PAGE_IDNOTSET);
        } else {
            if (!$this->exists()) {
                $this->currentPageID = System::getDefaultPage();
                $this->injectQuery('error', E_PAGE_NOTEXISTENT);
            } else {
                $this->currentPageID = $_GET[URI_PAGEID];
            }
        }
    }
    private function load()
    {
        // @IDEA use id, get permission of page
        // @IDEA if permission is granted
        // @IDEA get content and template of page
        // @IDEA if not, only get template but no content or widgets
        // @IDEA test
        $sql = 'SELECT ? FROM ? WHERE ? = ?';
        $result = Database::getInstance()->query($sql, [TABLEKEY_PERMISSIONS,TABLE_PAGES,TABLEKEY_ID,$this->currentPageID])->getSingleColumn();
        //Check if current client can access the page
    }
    private function build()
    {
        // @IDEA init template, assign widgets, blocks and variables as needed
        // @IDEA build the template and echo display to user
    }
    private function exists():bool
    {
        // @IDEA Check if page exsists the client tries to reach
        $sql = 'SELECT TOP 1'.TABLE_PAGES.'.id FROM '.TABLE_PAGES.' WHERE '.TABLE_PAGES.'.id = ?';
        $check = Database::getInstance()->query($sql, [$this->currentPageID])->fetchSingleColumn();

        if ($check || !is_bool($check)) {
            return true;
        }
        return false;
    }
    private function injectQuery($key, $value)
    {
        $this->injectedURIQueries .= $key . '=' . $value . '&';
    }
}
