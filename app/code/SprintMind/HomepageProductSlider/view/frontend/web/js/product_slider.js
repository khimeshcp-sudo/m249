require(['jquery', 'Magento_Catalog/js/view/product/list'], function ($, ProductList) {
    'use strict';

    $.widget('sprintmind.productSlider', {
        options: {
            maxProducts: 5,
            productSkus: []
        },

        _create: function () {
            this._fetchProducts();
        },

        _fetchProducts: function () {
            var self = this;
            $.ajax({
                url: '/rest/V1/products?skus=' + this.options.productSkus.join(','),
                method: 'GET',
                dataType: 'json'
            }).done(function (data) {
                self._renderProducts(data);
            }).fail(function () {
                console.error('Failed to fetch products.');
            });
        },

        _renderProducts: function (products) {
            var productCount = 0;
            var $sliderContainer = this.element;

            products.forEach(function (product) {
                if (productCount < this.options.maxProducts && product.stock_status === 'IN_STOCK') {
                    var productHtml = '<div class="product-item">' +
                        '<img src="' + product.image + '" alt="' + product.name + '" />' +
                        '<h2>' + this._escapeHtml(product.name) + '</h2>' +
                        '<p class="price">' + product.price + '</p>' +
                        '<button class="add-to-cart" data-sku="' + product.sku + '">Add to Cart</button>' +
                        '</div>';
                    $sliderContainer.append(productHtml);
                    productCount++;
                }
            }, this);
        },

        _escapeHtml: function (string) {
            return string.replace(/&/g, '&amp;')
                         .replace(/</g, '&lt;')
                         .replace(/>/g, '&gt;')
                         .replace(/"/g, '&quot;')
                         .replace(/'/g, '&#039;');
        }
    });

    return $.sprintmind.productSlider;
});