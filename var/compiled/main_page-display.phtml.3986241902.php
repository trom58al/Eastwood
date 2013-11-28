<?php /* This file is generated from /usr/share/nginx/www/eastwood/template/main_page/display.phtml*/?><?php
if(!class_exists('MacroTemplateExecutor9b3496b6eedc2c1c5fa6e97f8c50cf17', false)){
require_once('limb/macro/src/compiler/lmbMacroTemplateExecutor.class.php');
class MacroTemplateExecutor9b3496b6eedc2c1c5fa6e97f8c50cf17 extends lmbMacroTemplateExecutor {
function render($args = array()) {
if($args) extract($args);
$this->_init();
 ?><?php  $this->title = 'Main page'; ?>
<?php $this->__staticInclude1('front_page_layout.phtml', 'content_zone', 'front_page_layout.phtml');
}

function __staticInclude1($file,$into,$file) {
 ?><html>
<head>
    <title><?php echo htmlspecialchars($this->title,3); ?> :: Limb3 shop example application on &#123;&#123;macro&#125;&#125;</title>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <link rel=stylesheet type="text/css" href="/styles/main.css"/>
</head>
<body>
<div id="header">
    <div class="center">
        <img src="/images/logo.limb.gif" width='384' height='46' alt='logo.limb' id='logo'/>
    </div>
</div>

<div id="center">
    <div id="wrapper">

        <div id="container">
            <div id="content">
                <h1><?php echo htmlspecialchars($this->title,3); ?></h1>
                <?php $this->__staticInclude2('flash_box.phtml'); ?>

                <?php if(isset($this->__slot_handlers_content_zone)) {foreach($this->__slot_handlers_content_zone as $__slot_handler_content_zone) {call_user_func_array($__slot_handler_content_zone, array(array()));}}$this->__slotHandler80900bc32dbde5ad83d1f0d7371c5c6e(array()); ?>

            </div>
        </div>

        <div id="sidebar">
            <div id="navigation">
                <ul>
                    <li><a href="/product">Products</a></li>
                    <li><a href="/cart">Your Cart</a></li>

                    <?php  if ($this->toolkit->getSession()->get('user_id')) { ?>
                    <?php  } else { ?>
                        <li><a href="/user/login/">Login please</a></li>
                    <?php  } ?>
                </ul>
            </div>

            <div id="profile">
                <dt>Profile</dt>
                <?php $this->__staticInclude3('user/include/profile_box.phtml'); ?>

            </div>

            <div id="category">
                <dt>Categories</dt>
                <?php $this->__staticInclude4('category.phtml'); ?>

            </div>

        </div>
    </div>
</div>
</div>
</body>
</html><?php 
}

function __staticInclude2($file) {
 ?><?php  $flash_messages = $this->toolkit->getFlashBox()->getUnifiedList(); ?>
<?php $G = 0;$I = $flash_messages;

if(!is_array($I) && !($I instanceof Iterator) && !($I instanceof IteratorAggregate)) {
$I = array();}
$H = $I;
foreach($H as $item) {if($G == 0) { ?>

<?php } ?>

<?php  if ($item['is_error']) { ?>
    <div class="error_border"><b><?php $K='';
$L = $item;
if((is_array($L) || ($L instanceof ArrayAccess)) && isset($L['message'])) { $K = $L['message'];
}else{ $K = '';}
echo htmlspecialchars($K,3); ?></b></div><?php  } ?>
<?php  if ($item['is_message']) { ?>
    <div class="border"><b><?php $M='';
$N = $item;
if((is_array($N) || ($N instanceof ArrayAccess)) && isset($N['message'])) { $M = $N['message'];
}else{ $M = '';}
echo htmlspecialchars($M,3); ?></b></div><?php  } ?>
<?php $G++;}if($G > 0) { ?>

<?php }
}

function __slotHandler80900bc32dbde5ad83d1f0d7371c5c6e($O= array()) {
if($O) extract($O); ?>

Welcome to the Hogwarts!
<?php 
}

function __staticInclude3($file) {
 ?><?php  if ($this->toolkit->getSession()->get('user_id')) { ?>
    <dd>
        <?php 
        echo $this->toolkit->getSession()->get('user_name');
        echo '<br /><a href="/user/logout">logout</a>';
        ?>
    </dd>
<?php 
}
?><?php 
}

function __staticInclude4($file) {
 ?><?php 
$tree = new Tree();
$this->Tree = $tree->getData();
?>

<dd>
    <?php $this->_render_treeaaef2479b0a4f9e4626159ac2818d193($this->Tree, 0,array('kids_prop' => 'childs','prefix' => '1',));
 ?>


</dd><?php 
}

function _render_treeaaef2479b0a4f9e4626159ac2818d193($V,$level,$X= array()) {
if($X) extract($X);$W=0;
foreach($V as $item) {
$counter = $W+1;
if(!$W) {
 ?>

    <ul>
        <?php }
 ?>

        <li>

            <?php $new_prefix = $prefix . ".+++" . $counter; ?>
            <?php if(isset($item["childs"])) {$this->_render_treeaaef2479b0a4f9e4626159ac2818d193($item["childs"], $level + 1, array('prefix' => $new_prefix,));
} ?>

            <a class="category_level<?php $BB='';
$BC = $item;
if((is_array($BC) || ($BC instanceof ArrayAccess)) && isset($BC['level'])) { $BB = $BC['level'];
}else{ $BB = '';}
echo htmlspecialchars($BB,3); ?>" href='/product/products_category/<?php $BD='';
$BE = $item;
if((is_array($BE) || ($BE instanceof ArrayAccess)) && isset($BE['id'])) { $BD = $BE['id'];
}else{ $BD = '';}
echo htmlspecialchars($BD,3); ?>'><?php $BF='';
$BG = $item;
if((is_array($BG) || ($BG instanceof ArrayAccess)) && isset($BG['identifier'])) { $BF = $BG['identifier'];
}else{ $BF = '';}
echo htmlspecialchars($BF,3); ?></a>
        </li>
        <?php $W++;
}
if(count($V) == 0) { ?>

        Категории отсуствуют
        <?php }if($W) {
 ?>


        
    </ul>
    <?php }

}

}
}
$macro_executor_class='MacroTemplateExecutor9b3496b6eedc2c1c5fa6e97f8c50cf17';