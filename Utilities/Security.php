<?php
/**
 * A Bad Web Application.  Note that this is intentionally vulnerable to several
 * security vulnerabilities.  DO NOT INSTALL THIS ON A PUBLIC SERVER!
 * 
 * WARNING: FOR RESEARCH USE ONLY!  DO NOT USE!
 * 
 * DISCLAIMER: This application is for education use only.  Installing it on a 
 * public facing server will expose the server to several security vulnerabilities
 * The author takes absolutely no resposibility for any damage that may occur
 * from the use or misuse of any of this code.
 *
 * PHP version 5.3
 *
 * @category   XssBadWebApp
 * @package    Utilities
 * @author     Anthony Ferrara <ircmaxell@ircmaxell.com>
 * @copyright  2011 The Authors
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 */

namespace XssBadWebApp\Utilities;

Security::init();

class Security {
    protected static $seed = 'abcdefghijklmnopqrstuvwxyz
                              ABCDEFGHIJKLMNOPQRSTUVWXYZ
                              0123456789-?/.,)(*^%$#@!~';
    
    public static function init() {
        static::$seed = preg_replace('/\s/', '', static::$seed);
    }
    
    public function makeRandomString($length = 64) {
        $result = '';
        $seedLength = strlen(static::$seed);
        for ($i = 0; $i < $length; $i++) {
            $result .= static::$seed[mt_rand(0, $seedLenth - 1)];
        }
        return $result;
    }
    
}
