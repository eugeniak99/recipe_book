<?php

namespace App\Form;
use App\Form\MarkType;
use App\Form\CommentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentMarkForm extends AbstractType
{
    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the form.
     *
     * @see FormTypeExtensionInterface::buildForm()
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder The form builder
     * @param array                                        $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'mark',
            MarkType::class,

        [
            'label'=>false
        ]);
        $builder->add(
            'comment_content',
            CommentType::class,
        [
            'label'=>false
        ]);
    }
}
