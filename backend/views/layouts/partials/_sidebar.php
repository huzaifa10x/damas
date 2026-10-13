<?php

use common\components\Helpers;
use yii\helpers\Html;
use yii\helpers\Url;

$controler = Yii::$app->controller->id;
$post = Yii::$app->user->identity->id;
?>
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="<?= Yii::$app->homeUrl ?>" class="sidebar-brand">
            Damas
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item <?= Helpers::getActiveMenu('site'); ?>">
                <a href="<?= Yii::$app->homeUrl ?>" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            
            <?php if($post != 2){ ?>
            <li class="nav-item nav-category">Administration</li>
            <li class="nav-item <?= Helpers::getActiveMenu('admin-users'); ?>">
                <a href="<?= Url::to(['admin-users/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('admin-users'); ?>">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Admin Users</span>
                </a>
            </li>
            <li class="nav-item nav-category">Enquiry</li>
            <li class="nav-item <?= Helpers::getActiveMenu('contact-enquiry'); ?>">
                <a href="<?= Url::to(['contact-enquiry/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('contact-enquiry'); ?>">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Contact Enquiry</span>
                </a>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('appointment-enquiry'); ?>">
                <a href="<?= Url::to(['appointment-enquiry/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('appointment-enquiry'); ?>">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Appointment Enquiry</span>
                </a>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('career-enquiry'); ?>">
                <a href="<?= Url::to(['career-enquiry/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('career-enquiry'); ?>">
                    <i class="link-icon" data-feather="columns"></i>
                    <span class="link-title">Career Enquiry</span>
                </a>
            </li>
            
            <li class="nav-item <?= Helpers::getActiveMenu('order-master'); ?>">
                <a href="<?= Url::to(['order-master/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('order-master'); ?>">
                    <i class="link-icon" data-feather="shopping-cart"></i>
                    <span class="link-title">Orders</span>
                </a>
            </li>
            <?php } ?>
            <li class="nav-item nav-category">CMS</li>
            <li class="nav-item <?= Helpers::getActiveMenu('landing-pages'); ?>">
                <a href="<?= Url::to(['landing-pages/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('landing-pages'); ?>">
                    <i class="link-icon" data-feather="plus-circle"></i>
                    <span class="link-title">Landing Pages</span>
                </a>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('home-banner', 'special-offer'); ?>">
                <a class="nav-link <?= Helpers::getActiveMenuCollapsed('home-banner', 'special-offer'); ?>" data-bs-toggle="collapse" href="#home" role="button" aria-expanded="<?= $controler == 'home-banner' ? 'true' : 'false' ?>" aria-controls="emails">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Home page</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse <?= Helpers::getActiveMenuShow('home-banner', 'special-offer'); ?>" id="home">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="<?= Url::to(['home-banner/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('home-banner'); ?>">Banner</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['special-offer/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('special-offer'); ?>">Special Offer</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('about', 'our-history'); ?> ">
                <a class="nav-link <?= Helpers::getActiveMenuCollapsed('about', 'our-history'); ?>" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="<?= Helpers::getAreaExpanded('about', 'our-history'); ?>" aria-controls="advancedUI">
                    <i class="link-icon" data-feather="file-text"></i>
                    <span class="link-title">About Us</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse <?= Helpers::getActiveMenuShow('about', 'our-history'); ?>" id="advancedUI">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="<?= Url::to(['about/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('about'); ?>">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['our-history/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('our-history'); ?>">Our History</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item <?= Helpers::getActiveMenu('departments', 'department-faq', 'department-videos', 'department-treatment-results', 'department-pros-and-cons'); ?>">
                <a class="nav-link <?= Helpers::getActiveMenuCollapsed('departments', 'department-faq', 'department-videos', 'department-treatment-results', 'department-pros-and-cons'); ?>" data-bs-toggle="collapse" href="#department" role="button" aria-expanded="<?= Helpers::getAreaExpanded('departments', 'department-faq'); ?>" aria-controls="department">
                    <i class="link-icon" data-feather="server"></i>
                    <span class="link-title">Departments Page</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse <?= Helpers::getActiveMenuShow('departments', 'department-faq', 'department-videos', 'department-treatment-results', 'department-pros-and-cons'); ?>" id="department">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="<?= Url::to(['departments/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('departments', 'department-videos', 'department-treatment-results', 'department-pros-and-cons'); ?>">Departments</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['department-faq/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('department-faq'); ?>">FAQ</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('services', 'service-faq', 'service-videos', 'service-treatment-results', 'service-pros-and-cons'); ?>">
                <a class="nav-link <?= Helpers::getActiveMenuCollapsed('services', 'service-faq', 'service-videos', 'service-treatment-results', 'service-pros-and-cons'); ?>" data-bs-toggle="collapse" href="#service" role="button" aria-expanded="<?= Helpers::getAreaExpanded('departments', 'department-faq'); ?>" aria-controls="department">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="link-title">Services</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse <?= Helpers::getActiveMenuShow('services', 'service-faq', 'service-videos', 'service-treatment-results', 'service-pros-and-cons'); ?>" id="service">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="<?= Url::to(['services/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('services', 'service-videos', 'service-treatment-results', 'service-pros-and-cons'); ?>">Services</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['service-faq/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('service-faq'); ?>">FAQ</a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item <?= Helpers::getActiveMenu('products', 'benefits-of-treatments', 'product-images', 'product-faq', 'product-terms-and-conditions', 'product-review'); ?>">
                <a class="nav-link <?= Helpers::getActiveMenuCollapsed('products', 'benefits-of-treatments', 'product-images', 'product-faq', 'product-terms-and-conditions', 'product-review'); ?>" data-bs-toggle="collapse" href="#general-pages" role="button" aria-expanded="false" aria-controls="general-pages">
                    <i class="link-icon" data-feather="shopping-cart"></i>
                    <span class="link-title">Offers</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse <?= Helpers::getActiveMenuShow('products', 'benefits-of-treatments', 'product-images', 'product-faq', 'product-terms-and-conditions', 'product-review'); ?>" id="general-pages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="<?= Url::to(['products/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('producta'); ?>">Offers</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['benefits-of-treatments/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('benefits-of-treatments'); ?>">Benefits of the treatment</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['product-images/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('product-images'); ?>">Before & After images</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['product-faq/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('product-faq'); ?>">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['product-terms-and-conditions/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('product-terms-and-conditions'); ?>">Terms & conditions</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['product-review/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('product-review'); ?>">Review</a>
                        </li>
                    </ul>
                </div>
            </li>
             
            
            <li class="nav-item <?= Helpers::getActiveMenu('blogs'); ?>">
                <a href="<?= Url::to(['blogs/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('blogs'); ?>">
                    <i class="link-icon" data-feather="layers"></i>
                    <span class="link-title">Blogs</span>
                </a>
            </li>
             <li class="nav-item <?= Helpers::getActiveMenu('careers'); ?>">
                <a href="<?= Url::to(['careers/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('careers'); ?>">
                    <i class="link-icon" data-feather="slack"></i>
                    <span class="link-title">Careers</span>
                </a>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('faq'); ?>">
                <a href="<?= Url::to(['faq/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('faq'); ?>">
                    <i class="link-icon" data-feather="help-circle"></i>
                    <span class="link-title">FAQ</span>
                </a>
            </li>
            <?php if($post != 2){ ?>
            <li class="nav-item <?= Helpers::getActiveMenu('policies'); ?>">
                <a href="<?= Url::to(['policies/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('policies'); ?>">
                    <i class="link-icon" data-feather="shield"></i>
                    <span class="link-title">Policies</span>
                </a>
            </li>
            
            <li class="nav-item <?= Helpers::getActiveMenu('contact-us'); ?>">
                <a href="<?= Url::to(['contact-us/update', 'id' => 1]); ?>" class="nav-link <?= Helpers::getActiveMenu('contact-us'); ?>">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="link-title">Contact Page</span>
                </a>
            </li>
            <?php } ?>
            <li class="nav-item <?= Helpers::getActiveMenu('languages'); ?>">
                <a href="<?= Url::to(['languages/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('languages'); ?>">
                    <i class="link-icon" data-feather="flag"></i>
                    <span class="link-title">Languages</span>
                </a>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('doctors', 'doctor-gallery'); ?>">
                <a href="<?= Url::to(['doctors/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('doctors', 'doctor-gallery'); ?>">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Doctors</span>
                </a>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('insurance'); ?>">
                <a href="<?= Url::to(['insurance/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('insurance'); ?>">
                    <i class="link-icon" data-feather="command"></i>
                    <span class="link-title">Insurance</span>
                </a>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('testimonials'); ?>">
                <a href="<?= Url::to(['testimonials/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('testimonials'); ?>">
                    <i class="link-icon" data-feather="alert-circle"></i>
                    <span class="link-title">Testimonials</span>
                </a>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('google-reviews'); ?>">
                <a href="<?= Url::to(['google-reviews/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('google-reviews'); ?>">
                    <i class="link-icon" data-feather="inbox"></i>
                    <span class="link-title">Google Reviews</span>
                </a>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('media-gallery', 'media-library', 'media-library-category'); ?>">
                <a class="nav-link <?= Helpers::getActiveMenuCollapsed('media-gallery', 'media-library', 'media-library-category'); ?>" data-bs-toggle="collapse" href="#home" role="button" aria-expanded="<?= $controler == 'home-banner' ? 'true' : 'false' ?>" aria-controls="emails">
                    <i class="link-icon" data-feather="video"></i>
                    <span class="link-title">Media Library</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse <?= Helpers::getActiveMenuShow('media-gallery', 'media-library', 'media-library-category'); ?>" id="home">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="<?= Url::to(['media-library-category/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('media-library-category'); ?>">Category</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['media-library/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('media-library'); ?>">Media Library</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['media-gallery/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('media-gallery'); ?>">Media Gallery</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('banners'); ?>">
                <a href="<?= Url::to(['banners/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('banners'); ?>">
                    <i class="link-icon" data-feather="image"></i>
                    <span class="link-title">Banners</span>
                </a>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('words'); ?>">
                <a href="<?= Url::to(['words/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('words'); ?>">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Words</span>
                </a>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('meta-tags'); ?>">
                <a href="<?= Url::to(['meta-tags/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('meta-tags'); ?>">
                    <i class="link-icon" data-feather="tag"></i>
                    <span class="link-title">Meta Tags</span>
                </a>
            </li>
            <li class="nav-item <?= Helpers::getActiveMenu('gallery', 'treatment-results-gallery'); ?>">
                <a class="nav-link <?= Helpers::getActiveMenuCollapsed('gallery', 'treatment-results-gallery'); ?>" data-bs-toggle="collapse" href="#gallery" role="button" aria-expanded="<?= $controler == 'home-banner' ? 'true' : 'false' ?>" aria-controls="emails">
                    <i class="link-icon" data-feather="image"></i>
                    <span class="link-title">Gallery</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse <?= Helpers::getActiveMenuShow('gallery', 'treatment-results-gallery'); ?>" id="gallery">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="<?= Url::to(['gallery/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('gallery'); ?>">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['treatment-results-gallery/index']); ?>" class="nav-link <?= Helpers::getActiveMenu('treatment-results-gallery'); ?>">Treatment Results</a>
                        </li>

                    </ul>
                </div>
            </li>
            
        </ul>
    </div>
</nav>