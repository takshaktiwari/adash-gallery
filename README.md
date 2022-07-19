
#  Introduction
An extension for slider for takshak/adash package to create and manage image and video galleries. Structure of gallery and images are so that, one image can be in multiple galleries and a gallery can contain multiple images.

##  Installation
Require the package with composer

    composer require takshak/adash-gallery

Run the command to setup the table, pages, models and all

    php artisan adash-gallery:install

You can disable install command after setup via config file (site.php). You can set the layout of the gallery and gallery's cover image size.
This packages comes with some frontend pages and components which you can integrate in your app. There are two layouts for gallery 'grid' and 'masonry'. You can set the layout in config file. Default layout is 'grid' you can activate 'masonry' layout by passing layout=masonry parameter in url, eg. `[https://domain.com]/galleries?layout=masonry`.

Available routes for front pages are:

    [https://domain.com]/galleries
    [https://domain.com]/galleries/groups
    [https://domain.com]/galleries/{gallery:slug}

You can use component `<x-agallery-featured-galleries  />` to list featured galleries anywhere in you projects. This component contains following parameters:

* lines (int): to define the number of lines for gallery name.
* items (int): define how many featured images will be listed with this component.
* masonry (bool): to set manually masonry effect.

This package uses **fancybox** lightbox for image galleries. To customize front pages, you need to publish the views and customize as per your need.
