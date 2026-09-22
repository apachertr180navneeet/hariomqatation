<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    /**
     * Store Homepage with interactive rig configurator hero, budget wizard, and featured hardware.
     */
    public function index(): View
    {
        return view('shop.index', [
            'pageTitle' => 'Hari Om Computer | Western Rajasthan\'s Premier Computer & Technology Store (Jodhpur)',
            'currentPage' => 'home',
            'showPromoStrip' => true,
        ]);
    }

    /**
     * Desktop PCs & Workstations showroom.
     */
    public function computers(): View
    {
        return view('shop.computers', [
            'pageTitle' => 'Desktop PCs, Gaming Rigs & Workstations | Hari Om Computer (Jodhpur)',
            'currentPage' => 'computers',
        ]);
    }

    /**
     * Laptops showroom.
     */
    public function laptops(): View
    {
        return view('shop.laptops', [
            'pageTitle' => 'Brand New Laptops (Dell, HP, Lenovo, ASUS) | Hari Om Computer (Jodhpur)',
            'currentPage' => 'laptops',
        ]);
    }

    /**
     * Components catalog.
     */
    public function components(): View
    {
        return view('shop.components', [
            'pageTitle' => 'Genuine Computer Components (CPU, GPU, RAM, SSD) | Hari Om Computer (Jodhpur)',
            'currentPage' => 'components',
        ]);
    }

    /**
     * Full hardware catalog with faceted filtering.
     */
    public function products(): View
    {
        return view('shop.products', [
            'pageTitle' => 'Products & Hardware Catalog | Hari Om Computer (Jodhpur)',
            'currentPage' => 'products',
        ]);
    }

    /**
     * Detailed product specifications and enquiry view.
     */
    public function productDetails(Request $request): View
    {
        return view('shop.product-details', [
            'pageTitle' => 'Product Details & Specifications | Hari Om Computer',
            'currentPage' => 'products',
            'productId' => $request->query('id', 'PROD-1001'),
        ]);
    }

    /**
     * Interactive Custom PC Builder Tool.
     */
    public function pcBuilder(): View
    {
        return view('shop.pc-builder', [
            'pageTitle' => 'Custom PC Builder Tool & Instant Compatibility Check | Hari Om Computer',
            'currentPage' => 'pc-builder',
        ]);
    }

    /**
     * Enquiry Cart & Quotation Request checkout.
     */
    public function enquiry(): View
    {
        return view('shop.enquiry', [
            'pageTitle' => 'Enquiry Cart & GST Quotation Request | Hari Om Computer',
            'currentPage' => 'enquiry',
        ]);
    }

    /**
     * Quotation Submission Success page.
     */
    public function quotationSuccess(): View
    {
        return view('shop.quotation-success', [
            'pageTitle' => 'Quotation Request Received | Hari Om Computer',
            'currentPage' => 'enquiry',
        ]);
    }

    /**
     * About Hari Om Computer showroom & story.
     */
    public function about(): View
    {
        return view('shop.about', [
            'pageTitle' => 'About Us - 15+ Years Computer Excellence | Hari Om Computer (Jodhpur)',
            'currentPage' => 'about',
        ]);
    }

    /**
     * Contact details, map location, and direct messaging form.
     */
    public function contact(): View
    {
        return view('shop.contact', [
            'pageTitle' => 'Contact & Showroom Location | Hari Om Computer (Jodhpur)',
            'currentPage' => 'contact',
        ]);
    }
}
