<?php
/**
 * Created by PhpStorm.
 * User: sokool
 * Date: 01/05/14
 * Time: 11:19
 */

namespace MintSoftFormBakeryTest;

use MintSoftFormBakery\Asset\User;
use Nette\Diagnostics\Debugger;

require_once __DIR__ . '/../Bootstrap.php';

class FormTest extends \PHPUnit_Framework_TestCase
{
    public function testFormBaked()
    {
        $this->assertTrue(true);
echo PHP_EOL;
        $user = new User();
        $a    = microtime(true);
        Bootstrap::getServiceManager()->get('MintSoftFormBakery\FormBakery')->test($user);
        $ae = microtime(true);

        $b = microtime(true);
        Bootstrap::getServiceManager()->get('MintSoftFormBakery\FormBakery')->test($user);
        $be = microtime(true);

        $c = microtime(true);
        Bootstrap::getServiceManager()->get('MintSoftFormBakery\FormBakery')->test($user);
        $ce = microtime(true);

        echo ($ae - $a) . PHP_EOL;
        echo ($be - $b) . PHP_EOL;
        echo ($ce - $c) . PHP_EOL;
    }
} 