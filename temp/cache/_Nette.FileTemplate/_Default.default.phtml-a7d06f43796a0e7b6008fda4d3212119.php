<?php //netteCache[01]000403a:2:{s:4:"time";s:21:"0.91230800 1312632487";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:81:"/opt/lampp/htdocs/gui-for-acl-1.0/app/FrontModule/templates/Default/default.phtml";i:2;i:1271678098;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"bf2f6c0 released on 2011-07-13";}}}?><?php

// source file: /opt/lampp/htdocs/gui-for-acl-1.0/app/FrontModule/templates/Default/default.phtml

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'jt4l4wtsw9')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb64afe2404e_content')) { function _lb64afe2404e_content($_l, $_args) { extract($_args)
?>
<h1><?php call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?></h1>

<table cellspacing="0" cellpadding="0">
    <?php if ($user->isAllowed('ceska_sporitelna', 'nahled')): ?><tr><td><b>Česká Spořitelna</b><?php if ($user->isAllowed('ceska_sporitelna', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?></td><td></td><td></td><td></td></tr>
       <?php if ($user->isAllowed('oblast_praha', 'nahled')): ?><tr><td><span class="node-t"></span></td><td>Oblast Praha<?php if ($user->isAllowed('oblast_praha', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td><td></td><td></td></tr><?php endif ?>

       <?php if ($user->isAllowed('oblast_usti', 'nahled')): ?><tr><td><span class="node-t"></span></td><td>Oblast Ústí<?php if ($user->isAllowed('oblast_usti', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td><td></td><td></td></tr><?php endif ?>

       <?php if ($user->isAllowed('oblast_zlin', 'nahled')): ?><tr><td><span class="node-t"></span></td><td>Oblast Zlín<?php if ($user->isAllowed('oblast_zlin', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?></td><td></td><td></td></tr>
          <?php if ($user->isAllowed('kromerizsky_region', 'nahled')): ?><tr><td><span class="node-n"></span></td><td><span class="node-t"></span></td><td>Kroměřížský region<?php if ($user->isAllowed('kromerizsky_region', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td><td></td></tr><?php endif ?>

          <?php if ($user->isAllowed('vsetinsky_region', 'nahled')): ?><tr><td><span class="node-n"></span></td><td><span class="node-t"></span></td><td>Vsetínský region<?php if ($user->isAllowed('vsetinsky_region', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td><td></td></tr><?php endif ?>

          <?php if ($user->isAllowed('zlinsky_region', 'nahled')): ?><tr><td><span class="node-n"></span></td><td><span class="node-l"></span></td><td>Zlínský region<?php if ($user->isAllowed('zlinsky_region', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?></td><td></td></tr>
             <?php if ($user->isAllowed('pobocka_frystak', 'nahled')): ?><tr><td><span class="node-n"></span></td><td></td><td><span class="node-t"></span></td><td>Pobočka Fryšták<?php if ($user->isAllowed('pobocka_frystak', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td></tr><?php endif ?>

             <?php if ($user->isAllowed('pobocka_j_svahy', 'nahled')): ?><tr><td><span class="node-n"></span></td><td></td><td><span class="node-t"></span></td><td>Pobočka Jižní Svahy<?php if ($user->isAllowed('pobocka_j_svahy', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td></tr><?php endif ?>

             <?php if ($user->isAllowed('pobocka_slusovice', 'nahled')): ?><tr><td><span class="node-n"></span></td><td></td><td><span class="node-t"></span></td><td>Pobočka Slušovice<?php if ($user->isAllowed('pobocka_slusovice', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td></tr><?php endif ?>

             <?php if ($user->isAllowed('pobocka_tr_t_bati', 'nahled')): ?><tr><td><span class="node-n"></span></td><td></td><td><span class="node-t"></span></td><td>Pobočka Tř. T. Bati<?php if ($user->isAllowed('pobocka_tr_t_bati', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td></tr><?php endif ?>

             <?php if ($user->isAllowed('pobocka_zarami', 'nahled')): ?><tr><td><span class="node-n"></span></td><td></td><td><span class="node-l"></span></td><td>Pobočka Zarámí<?php if ($user->isAllowed('pobocka_zarami', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td></tr><?php endif ?>

<?php endif ;endif ?>
       <?php if ($user->isAllowed('penzijni_fond', 'nahled')): ?><tr><td><span class="node-t"></span></td><td><b>Penzijní fond ČS<?php if ($user->isAllowed('penzijni_fond', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</b></td><td></td><td></td></tr><?php endif ?>

       <?php if ($user->isAllowed('stavebni_sporitelna', 'nahled')): ?><tr><td><span class="node-t"></span></td><td><b>Stavební Spořitelna</b><?php if ($user->isAllowed('stavebni_sporitelna', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td><td></td><td></td></tr><?php endif ?>

       <?php if ($user->isAllowed('ceska_pojistovna', 'nahled')): ?><tr><td><span class="node-l"></span></td><td><b>Česká pojišťovna</b><?php if ($user->isAllowed('ceska_pojistovna', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?></td><td></td><td></td></tr>
          <?php if ($user->isAllowed('jihomoravsky_kraj', 'nahled')): ?><tr><td></td><td><span class="node-t"></span></td><td>Jihomoravský kraj<?php if ($user->isAllowed('jihomoravsky_kraj', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td><td></td></tr><?php endif ?>

          <?php if ($user->isAllowed('moravskoslezsky_kraj', 'nahled')): ?><tr><td></td><td><span class="node-t"></span></td><td>Moravskoslezský kraj<?php if ($user->isAllowed('moravskoslezsky_kraj', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td><td></td></tr><?php endif ?>

          <?php if ($user->isAllowed('zlinsky_kraj', 'nahled')): ?><tr><td></td><td><span class="node-l"></span></td><td>Zlínský kraj<?php if ($user->isAllowed('zlinsky_kraj', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?></td><td></td></tr>
             <?php if ($user->isAllowed('kromeriz', 'nahled')): ?><tr><td></td><td></td><td><span class="node-t"></span></td><td>Kroměříž<?php if ($user->isAllowed('kromeriz', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td></tr><?php endif ?>

             <?php if ($user->isAllowed('vsetin', 'nahled')): ?><tr><td></td><td></td><td><span class="node-t"></span></td><td>Vsetín<?php if ($user->isAllowed('vsetin', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td></tr><?php endif ?>

             <?php if ($user->isAllowed('zlin', 'nahled')): ?><tr><td></td><td></td><td><span class="node-l"></span></td><td>Zlín<?php if ($user->isAllowed('zlin', 'sprava')): ?>
 <img src="<?php echo htmlSpecialChars($basePath) ?>/images/edit.gif" height="19" width="19" title="Edit" alt="Edit" /><?php endif ?>
</td></tr><?php endif ?>

<?php endif ;endif ;endif ?>
</table>

<h2>Seznam uživatelů a přidělených rolí</h2>
<p>Přihlašovací heslo je totožné se jménem daného uživatele.</p>

<ul>
    <li><b>Admin</b> (<u>Acl Admin</u>)</li>
    <li><b>Ales</b> (IT Technik, Řízení majetku)</li>
    <li><b>Dasa</b> (Finanční řízení)</li>
    <li><b>Honza</b> (Finanční řízení 2)</li>
    <li><b>Ivo</b> (1. náměstek 2)</li>
    <li><b>Jakub</b> (Generální ředitel 2)</li>
    <li><b>Jana</b> </li>
    <li><b>Jirka</b> (Informační technologie)</li>
    <li><b>Karel</b> (Administrátor)</li>
    <li><b>Kristyna</b> (Řízení majetku)</li>
    <li><b>Marek</b> </li>
    <li><b>Martin</b> (IT Technik)</li>
    <li><b>Ota</b> (1. náměstek)</li>
    <li><b>Petr</b> (2. náměstek)</li>
    <li><b>Roman</b> </li>
    <li><b>Tom</b> (<u>Acl Admin</u>, Generální ředitel)</li>
</ul>

<h2>Výchozí role</h2>

<dl>
<dt>Acl Admin</dt>
    <dd>Role, která má přístup do administrace Acl.</dd>
    <dt>Guest</dt>
    <dd>Výchozí role pro nepříhlášeného návštěvníka.</dd>
</dl>

<h3>Role od nejvyšší po nejnižší roli</h3>

<p>Ve struktuře rolí od nejvyšší (role s nejvyššími právy) po nejnižší roli musíme potomku odebrat přislušné práva jeho rodiče. Tím hrozí bezpečnostní riziko, že některá důležitá práva potomku zapomeneme odebrat.</p>

<p>Další úskalí této struktury je (ve většině případů) nutnost více pravidel pro konkrétní roli, abychom dosáhli žádaného oprávnění.</p>

<table cellspacing="0" cellpadding="0">
    <tr><td>Generální ředitel</td><td></td><td></td><td></td><td></td></tr>
    <tr><td><span class="node-t"></span></td><td>1. náměstek</td><td></td><td></td><td></td></tr>
    <tr><td><span class="node-n"></span></td><td><span class="node-t"></span></td><td>Finanční řízení</td><td></td><td></td></tr>
    <tr><td><span class="node-n"></span></td><td><span class="node-l"></span></td><td>Řízení majetku</td><td></td><td></td></tr>
    <tr><td><span class="node-l"></span></td><td>2. náměstek</td><td></td><td></td><td></td></tr>
    <tr><td></td><td><span class="node-t"></span></td><td>Informační technologie</td><td></td><td></td></tr>
    <tr><td></td><td><span class="node-n"></span></td><td><span class="node-l"></span></td><td>Administrátor</td><td></td></tr>
    <tr><td></td><td><span class="node-n"></span></td><td></td><td><span class="node-l"></span></td><td>IT Technik</td></tr>
    <tr><td></td><td><span class="node-t"></span></td><td>Podpora prodeje</td><td></td><td></td></tr>
    <tr><td></td><td><span class="node-l"></span></td><td>Úsek bezpečnosti</td><td></td><td></td></tr>
</table>

<h3>Role od nejnižší po nejvyšší roli</h3>

<p>Bezpečnější metodou dědění oprávnění je struktura rolí od nejnižší role po nejvyšší.</p>

<p>Pokud zapomeneme odebrat některé pravidlo od rodiče (popř. přidat nové pravidlo) nehrozí, že potomek bude mít vyšší oprávnění, něž byl původní záměr. Kdyby jsme i tak zapomněli odebrat/přidat některé pravidlo, tak výsledný potomek bude mít oprávnění nižší, než původní záměr, což je z bezpečnostního hlediska lepší, než kdyby měl práva vyšší. Toto pravidlo platí pouze za předpokladu správně navržené hierarchie rolí.</p>

<table cellspacing="0" cellpadding="0">
    <tr><td>Finanční řízení 2</td><td></td><td></td></tr>
    <tr><td><span class="node-l"></span></td><td>1. náměstek 2</td><td></td></tr>
    <tr><td></td><td><span class="node-l"></span></td><td>Generální ředitel 2</td></tr>
</table><?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbf82df5c6a7_title')) { function _lbf82df5c6a7_title($_l, $_args) { extract($_args)
?>Demonstrační stránka<?php
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
if (!$_l->extends) { call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()); }  
// template extending support
if ($_l->extends) {
	ob_end_clean();
	Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
