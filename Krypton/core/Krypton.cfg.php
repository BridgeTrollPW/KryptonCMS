<?php
namespace Krypton\core;

//Database Table names
const TABLE_TEMPLATES = 'templates';
const TABLE_PAGES = 'pages';
const TABLE_SYSTEM = 'system';
const TABLE_APPS = 'apps';
const TABLE_ERRORS = 'errors';
const TABLE_CLIENTS = 'clients';
//define(__NAMESPACE__ . '\TABLE_CLIENTS', 'clients');
const TABLE_GROUPS = 'groups';

//Table Keys
const TABLEKEY_ID = 'id';
const TABLEKEY_NAME = 'name';
const TABLEKEY_CONTENT = 'content';
const TABLEKEY_TEMPLATE = 'template';
const TABLEKEY_PERMISSIONS = 'permissions';
const TABLEKEY_GROUPS = 'groups';
const TABLEKEY_PASSWORD = 'password';

//System Table Entries
const SYS_DEFAULTPAGE = 'default_page';
const SYS_VERSION = 'version';
const SYS_UPDATEURI = 'updateURI';

//Url Query names
const URI_PAGEID = 'pageid';

// Error Codes
// E = ERROR | I = INFO | D = DEBUG | W = WARNING
// P = PAGE
// S = SYSTEM
const E_PAGE_IDNOTSET = 'E:P:0';
const E_PAGE_NOTEXISTENT = 'E:P:1';
