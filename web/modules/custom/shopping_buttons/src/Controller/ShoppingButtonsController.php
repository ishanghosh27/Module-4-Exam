<?php

namespace Drupal\shopping_buttons\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;

/**
 * This class creates a thank you page with product and user details.
 */
class ShoppingButtonsController extends ControllerBase {

  /**
   * This method creates the thank you page with product details and username.
   *
   * @return array
   *   The render array for the page.
   */
  // public function thankYou(Request $request) {
  //   $nid = $request->query->get('nid');
  //   // $user = $this->currentUser->getDisplayName();
  //   $node = \Drupal::entityTypeManager()->getStorage('node')->load($nid);
  //   if ($node && $node->getType() === 'shopping_products') {
  //     $product_title = $node->getTitle();
  //     $thank_you_message = $this->t('Thank You, For Purchasing: @product_title', [
  //       '@product_title' => $product_title,
  //       // '@user' => $user,
  //     ]);
  //     return [
  //       'message' => [
  //         '#markup' => '<h1>' . $thank_you_message . '</h1>',
  //       ],
  //     ];
  //   }
  //   return [
  //     '#markup' => $this->t('An Unexpected Error Occurred. Please Refresh Or Try Again After Sometime.'),
  //   ];
  // }

  /**
   * This method creates the thank you page with product details and username.
   *
   * @return array
   *   The render array for the page.
   */
  public function thankYou(Request $request) {
    $nid = $request->query->get('nid');
    $user_display_name = $request->query->get('user');
    $node = \Drupal::entityTypeManager()->getStorage('node')->load($nid);
    if ($node && $node->getType() === 'shopping_products') {
      $product_title = $node->getTitle();
      $image_markup = '';
      foreach ($node->get('field_product_image') as $image_item) {
        $image_entity = $image_item->entity;
        if ($image_entity) {
          $image_markup .= \Drupal::entityTypeManager()
            ->getViewBuilder('file')
            ->view($image_entity, 'thumbnail');
        }
      }
      $thank_you_message = $this->t('Thank You, @user, For Purchasing: @product_title', [
        '@user' => $user_display_name,
        '@product_title' => $product_title,
      ]);
      return [
        'message' => [
          '#markup' => '<h1>' . $thank_you_message . '</h1>',
        ],
        'images' => [
          '#markup' => '<img src =' . $image_markup . '>',
        ],
      ];
    }
    return [
      '#markup' => $this->t('An Unexpected Error Occurred. Please Refresh Or Try Again After Sometime.'),
    ];
  }

}
