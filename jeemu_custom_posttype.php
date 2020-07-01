<?php

    function jeemu_custom_posttype()
    {
        $fruitLabels = array(
            'name'                  => _x( 'Fruits', 'Post type general name', 'fruit' ),
            'singular_name'         => _x( 'Fruit', 'Post type singular name', 'fruit' ),
            'menu_name'             => _x( 'Fruits', 'Admin Menu text', 'fruit' ),
            'name_admin_bar'        => _x( 'Fruit', 'Add New on Toolbar', 'fruit' ),
            'add_new'               => __( 'Add New', 'fruit' ),
            'add_new_item'          => __( 'Add New Fruit', 'fruit' ),
            'new_item'              => __( 'New Fruit', 'fruit' ),
            'edit_item'             => __( 'Edit Fruit', 'fruit' ),
            'view_item'             => __( 'View Fruit', 'fruit' ),
            'all_items'             => __( 'All Fruits', 'fruit' ),
            'search_items'          => __( 'Search fruits', 'fruit' ),
            'parent_item_colon'     => __( 'Parent fruits:', 'fruit' ),
            'not_found'             => __( 'No fruits found.', 'fruit' ),
            'not_found_in_trash'    => __( 'No fruits found in Trash.', 'fruit' ),
            'featured_image'        => _x( 'Fruit Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'fruit' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'fruit' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'fruit' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'fruit' ),
            'archives'              => _x( 'Fruit archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'fruit' ),
            'insert_into_item'      => _x( 'Insert into fruit', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'fruit' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this fruit', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'fruit' ),
            'filter_items_list'     => _x( 'Filter fruits list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'fruit' ),
            'items_list_navigation' => _x( 'Fruits list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'fruit' ),
            'items_list'            => _x( 'Fruits list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'fruit' ),
        );
        $cptArgs = array(
            'labels' => $fruitLabels,
            'description' => 'Fruit custom post type.',
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => false,
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 5,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail' ),
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-carrot',
        );

        register_post_type('fruit', $cptArgs);
    }
    add_action('init', 'jeemu_custom_posttype');
