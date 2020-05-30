<?php
/**
 * Recipe type.
 */

namespace App\Form;

use App\Entity\Category;
use App\Entity\Recipe;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RecipeType.
 */
class RecipeType extends AbstractType
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
            'recipe_name',
            TextType::class,
            [
                'label' => 'Nazwa przepisu',
                'required' => true,
                'attr' => ['max_length' => 64],
            ]
        );
        $builder->add(
            'category',
            EntityType::class,
            [
                'class' => Category::class,
                'choice_label' => function ($category) {
                    return $category->getCategoryName();
                },
                'label' => 'Kategoria',
                'placeholder' => '--------',
                'required' => true,
            ]
        );
        $builder->add(
            'recipe_description',
            TextType::class,
            [
                'label' => 'Opis przepisu',
                'required' => true,
                'attr' => ['max_length' => 255],
            ]
        );
        $builder->add(
            'rating',
            TextType::class,
            [
                'label' => 'Ranking',
                'required' => true,
                'attr' => ['max_length' => 2],
            ]
        );
        $builder->add(
            'tags',
            EntityType::class,
            [
                'class' => Tag::class,
                'choice_label' => function ($tag) {
                    return $tag->getTagName();
                },
                'label' => 'Tagi',
                'placeholder' => 'label_none',
                'required' => false,
                'expanded' => true,
                'multiple' => true,
            ]
        );
    }

    /**
     * Configures the options for this type.
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver The resolver for the options
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Recipe::class]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     *
     * @return string The prefix of the template block name
     */
    public function getBlockPrefix(): string
    {
        return 'recipe';
    }
}
