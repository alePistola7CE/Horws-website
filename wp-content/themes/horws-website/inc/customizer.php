<?php
  function wpb_customize_register($wp_customize){
    //showcase section
    $wp_customize->add_section('showcase', array(
      'title'   => __('Showcase', 'horws-website'),
      'description' => sprintf(__('Options for showcase', 'horws-website')),
      'priority' => 130
    ));

    $wp_customize-> add_setting('showcase_image', array(
      'default' =>  get_bloginfo('template_directory').'/images/mountains.jpg',
      'type'    => 'theme_mod'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'showcase_image', array(
      'label' => __('Immagine di sfondo', 'horws-website'),
      'section' => 'showcase',
      'settings' => 'showcase_image',
      'priority' => 1
    )));

    $wp_customize-> add_setting('showcase_heading', array(
      'default' =>  _x("HELLO!", "horws-website"),
      'type'    => 'theme_mod'
    ));

    $wp_customize->add_control('showcase_heading', array(
      'label' => __('Titolo principale parte 1', 'horws-website'),
      'section' => 'showcase',
      'priority' => 2
    ));

    $wp_customize-> add_setting('showcase_heading2', array(
      'default' =>  _x(" I'M HORWS", "horws-website"),
      'type'    => 'theme_mod'
    ));

    $wp_customize->add_control('showcase_heading2', array(
      'label' => __('Titolo principale parte 2', 'horws-website'),
      'section' => 'showcase',
      'priority' => 2
    ));

  $wp_customize-> add_setting('showcase_text', array(
    'default' =>  _x("I love to travel all around the world and shot beautiful landscapes", "horws-website"),
    'type'    => 'theme_mod'
  ));

  $wp_customize->add_control('showcase_text', array(
    'label' => __('Descrizione', 'horws-website'),
    'section' => 'showcase',
    'priority' => 3
  ));

  $wp_customize-> add_setting('showcase_link_insta', array(
    'default' =>  _x("https://www.instagram.com/__horws/", "horws-website"),
    'type'    => 'theme_mod'
  ));

  $wp_customize->add_control('showcase_link_insta', array(
    'label' => __('Link instagram', 'horws-website'),
    'section' => 'showcase',
    'priority' => 4
  ));

  $wp_customize-> add_setting('showcase_email', array(
    'default' =>  _x("horws.photography@gmail.com", "horws-website"),
    'type'    => 'theme_mod'
  ));

  $wp_customize->add_control('showcase_email', array(
    'label' => __('Email di contatto', 'horws-website'),
    'section' => 'showcase',
    'priority' => 5
  ));


}


  add_action('customize_register', 'wpb_customize_register');

 ?>
