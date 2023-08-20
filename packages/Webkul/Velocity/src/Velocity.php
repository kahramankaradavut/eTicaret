<?php

namespace Webkul\Velocity;

class Velocity
{
    /**
     * Content Type List
     *
     * @var array
     */
	protected $content_type = [
        // 'link'     => 'Link CMS Page',
        // 'product'  => 'Catalog Products',
        // 'static'   => 'Static Content',
        'category' => 'Category Slug',
    ];

    /**
     * Catalog Product Type
     *
     * @var array
     */
	protected $catalog_type = [
        'new'     => 'New Arrival',
        'offer'   => 'Offered Product [Special]',
        'popular' => 'Popular Products',
        'viewed'  => 'Most Viewed',
        'rated'   => 'Most Rated',
        'custom'  => 'Custom Selection',
    ];

    /**
     * @return string
     */
    public function getContentType()
    {
		return $this->content_type;
    }

    /**
     * @return string
     */
    public function getCatalogType()
    {
		return $this->catalog_type;
    }
}