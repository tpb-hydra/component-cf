<?php
namespace Hydra\Component\ContentFixer;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;


class ContentFixer implements ServiceProviderInterface
{
    protected $arrRegEx;
    public function __construct($regEx) {
      $this->arrRegEx = $regEx;
    }

    public function fix($content) {
      foreach ($this->arrRegEx as $key => $regEx){
        if (is_array($regEx)) {
           list($regEx, $replace) = each($regEx);
        }else{
           $replace = '';
        }

        $content = preg_replace($regEx, $replace, $content);
      }
      return $content;
    }

    public function register(Application $app) {
       $app['fixer'] = $this;
    }

    public function boot(Application $app) {
    }
}
?>
