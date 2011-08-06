<?php //netteCache[01]000395a:2:{s:4:"time";s:21:"0.12429900 1312632488";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:73:"/opt/lampp/htdocs/gui-for-acl-1.0/app/FrontModule/templates/@layout.phtml";i:2;i:1312557107;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"bf2f6c0 released on 2011-07-13";}}}?><?php

// source file: /opt/lampp/htdocs/gui-for-acl-1.0/app/FrontModule/templates/@layout.phtml

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '2afb1x2ibl')
;//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb6c9be35579_title')) { function _lb6c9be35579_title($_l, $_args) { extract($_args)
;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extends) ? FALSE : $template->_extends; unset($_extends, $template->_extends);


if ($_l->extends) {
	ob_start();
} elseif (!empty($control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="copyright" content="Copyright (c) 2010 Tomas Marcanik, e-mail: tomas.marcanik@gmail.com" />
	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo htmlSpecialChars($basePath) ?>/css/screen.css" type="text/css" />
	<title><?php if (!$_l->extends) { call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars()); } ?></title>
</head>
<body>
    <div id="content">

<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($flashes) as $flash): ?>
            <div class="flash <?php echo htmlSpecialChars($flash->type) ?>"><?php echo Nette\Templating\DefaultHelpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>

        <div id="user-info">
            <h3>Uživatelský panel</h3>
            <p>
                <b>Uživatel:</b> <?php if (isset($identity)): echo Nette\Templating\DefaultHelpers::escapeHtml($identity->name, ENT_NOQUOTES) ;else: ?>
<i>Nepřihlášen</i><?php endif ?><br />
                <b>Role:</b>
                <ul>
<?php if (isset($identity->roles)): $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($identity->roles) as $role): ?>
                    <li><?php echo Nette\Templating\DefaultHelpers::escapeHtml($role, ENT_NOQUOTES) ?></li>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;else: ?>
                    <li><?php echo Nette\Templating\DefaultHelpers::escapeHtml($user->guestRole, ENT_NOQUOTES) ?></li>
<?php endif ?>
                </ul>
            </p>

            <b>Rychlá navigace</b>
            <div>
                <?php if ($user->isLoggedIn() AND $user->isAllowed(ACL_RESOURCE, ACL_PRIVILEGE)): ?>
<a href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($control->link(":Acl:Users:")) ?>
">GUI for Acl</a><br /><?php endif ?>

                <?php if ($user->isLoggedIn()): ?><a href="<?php echo htmlSpecialChars($presenter->link("Login:logout")) ?>">Odhlásit</a>
                <?php else: ?><a href="<?php echo htmlSpecialChars($presenter->link("Login:")) ?>
">Přihlásit</a><?php endif ?>

            </div>
        </div>
        
<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParams()) ?>
        <div class="cleaner"></div>
    </div>
</body>
</html><?php 
// template extending support
if ($_l->extends) {
	ob_end_clean();
	Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
