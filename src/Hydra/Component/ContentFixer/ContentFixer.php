<?php
namespace Hydra\Component\ContentFixer;

use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Provides configurable content sanitization and replacement.
 */
class ContentFixer implements ServiceProviderInterface
{
    protected $arrRegEx;

    /**
     * Accepts a multidimentional array of search and replace strings (or regex)
     * @param Array $arrRegEx
     */
    public function __construct(Array $arrRegEx)
    {
      $this->arrRegEx = $arrRegEx;
    }

    /**
     * Sanitizes the string $content
     * @param String $content
     *
     * @return String
     */
    public function fix($content)
    {
      foreach ($this->arrRegEx as $key => $regEx) {
        if (is_array($regEx)) {
           list($regEx, $replace) = each($regEx);
        } else {
           $replace = '';
        }

        $content = preg_replace($regEx, $replace, $content);
      }

      return $content;
    }

    /**
     * Register the component
     * @param Silex\Application $app
     */
    public function register(Application $app)
    {
       $app['fixer'] = $this;
    }

    /**
     * Boots the component
     * @param Silex\Application $app
     */
    public function boot(Application $app)
    {
    }
}
