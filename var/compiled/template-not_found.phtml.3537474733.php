<?php /* This file is generated from /usr/share/nginx/www/eastwood/lib//limb/web_app/template/not_found.phtml*/?><?php
if(!class_exists('MacroTemplateExecutor1de6f843e5f0fadf38ad9139f9a46bba', false)){
require_once('limb/macro/src/compiler/lmbMacroTemplateExecutor.class.php');
class MacroTemplateExecutor1de6f843e5f0fadf38ad9139f9a46bba extends lmbMacroTemplateExecutor {
function render($args = array()) {
if($args) extract($args);
$this->_init();
 ?><html>
<head><title>404 Page Not Found Error.</title></head>
<body>

<h3>404 Page Not Found Error.</h3>
<p>Check if such a controller and template exist, and action is valid.</p>

</body>
</html>
<?php 
}

}
}
$macro_executor_class='MacroTemplateExecutor1de6f843e5f0fadf38ad9139f9a46bba';