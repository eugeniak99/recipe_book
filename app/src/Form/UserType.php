<?php
/**
 * User type.
 */
declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class UserType
 * @package App\Form
 */
class UserType extends AbstractType
{
    /**
     * Function Build Form.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
     public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email',
            EmailType::class,
            [
                'label' => 'Email',
                'required' => true,
                'attr' => ['max_length' => 64],
            ]);
        $builder->add('password', PasswordType::class, [
                'label' => 'Password',
                'required' => true,
                'attr' => ['max_length' => 64],
        ]);
    }
}
