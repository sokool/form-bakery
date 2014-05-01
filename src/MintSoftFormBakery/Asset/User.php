<?php
/**
 * Created by PhpStorm.
 * User: sokool
 * Date: 01/05/14
 * Time: 12:07
 */

namespace MintSoftFormBakery\Asset;

use Zend\Form\Annotation as Form;

class User
{
    /**
     * @Form\Exclude()
     */
    protected $id;

    /**
     * @Form\Type("Text")
     * @Form\Validator({"name": "NotEmpty"})
     * @Form\Options({
     *      "label" : "Your full name"
     * })
     */
    protected $name;

    /**
     * @Form\Type("Email")
     * @Form\Options({
     *      "label" : "Email address"
     * })
     *
     * @Form\ErrorMessage("Wrong email address or already exists")
     *
     */
    protected $email;
}